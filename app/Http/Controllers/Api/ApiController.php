<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\GetPostRequest;
use App\Models\Post;
use App\Providers\RedditHelperProvider;
use App\Services\RedditHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use JD\Laradit\Facades\Laradit;
use JD\Laradit\Facades\LaraditAuth;
use JD\Laradit\LaraditResourceServiceProvider;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Illuminate\Support\Str;
use App\Models\UsersSubreddits;
use App\Models\ArchiveSubreddit;
use App\Models\ArchivePosts;
use App\Models\UsersPosts;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function addPostToApplication(Request $request){
        $userId = $request->input('user_id');
        $user = User::where(['reddit_id' => $userId])->first();
        if($user){
            $postId = $request->input('fullname');
            $post = ArchivePosts::where(['data_id'=>$postId])->first();
            if(!$post){
                $post = new ArchivePosts();
                $post->created_at = time();
            }
            $namesOfPosts = $postId;
            $redditHelper = new RedditHelper();
            $access_token = $redditHelper->refreshToken($user->refresh_token)->access_token;
            $user->access_token = $access_token;
            $user->save();

            $postReddits = $redditHelper->getContent($access_token,$namesOfPosts);

            if(!empty($postReddits->data) && !empty($postReddits->data->children)){
                $postReddit = $postReddits->data->children[0]->data;

                $fullname =             (isset($postReddit->subreddit_id)) ? $postReddit->subreddit_id : null;
                $subredditName =        (isset($postReddit->subreddit)) ? strtolower($postReddit->subreddit) : null;

                $post->author =         (isset($postReddit->author)) ? $postReddit->author : null;
                $post->data_id =        (isset($postReddit->name)) ? $postReddit->name : null;
                $post->over_18 =        (isset($postReddit->over_18) && $postReddit->over_18) ? 1 : 0;
                $post->post_hint =      (isset($postReddit->post_hint)) ? $postReddit->post_hint : 'any';
                $post->likes =          (isset($postReddit->likes)) ? $postReddit->likes : null;
                $post->subreddit =      (isset($postReddit->subreddit))? $postReddit->subreddit : null;
                $post->title =          (isset($postReddit->title))? $postReddit->title : null;
                $post->name =           (isset($postReddit->title))? $postReddit->title : null;
                $post->downs =          (isset($postReddit->downs))? $postReddit->downs : null;
                $post->ups =            (isset($postReddit->ups))? $postReddit->ups : null;
                $post->url =            (isset($postReddit->url))? $postReddit->url : null;
                $post->publish_date =   $postReddit->created_utc;
                $post->updated_at =     time();
                $post->save();

                $postId = $post->id;

                /*add the relation for users and posts*/

                $usersPosts = UsersPosts::where(['user_id'=>$user->id,'post_id'=>$postId])->first();
                if(!$usersPosts){
                    $usersPosts = new UsersPosts();
                    $usersPosts->user_id =      $user->id;
                    $usersPosts->post_id =      $postId;
                    $usersPosts->created_at =   time();
                    $usersPosts->updated_at =   time();
                    $usersPosts->save();
                }
                if(!empty($fullname) && !empty($subredditName)){

                    $redditHelper = new RedditHelper();
                    $access_token = $redditHelper->refreshToken($user->refresh_token)->access_token;
                    $user->access_token = $access_token;
                    $user->save();

                    $subreddits = $redditHelper->search_subreddits($access_token,$subredditName,1);

                    if(!empty($subreddits->data) && !empty($subreddits->data->children && !empty($subreddits->data->children[0]->data))){

                        $subreddit = $subreddits->data->children[0]->data;

                        $archiveSubreddits = ArchiveSubreddit::where(['subreddit_id' => $fullname])->first();

                        if(empty($archiveSubreddits))
                        {
                            $archiveSubreddits = new ArchiveSubreddit();
                            $archiveSubreddits->created_at = time();
                        }
                        if(isset($subreddit->name) && $subreddit->name == $fullname){

                            $archiveSubreddits->display_name =      (isset($subreddit->display_name)) ? $subreddit->display_name : null;
                            $archiveSubreddits->title =             (isset($subreddit->title)) ? $subreddit->title : null;
                            $archiveSubreddits->url =               (isset($subreddit->url)) ? 'https://www.reddit.com'.$subreddit->url : null;
                            $archiveSubreddits->description =       (isset($subreddit->public_description)) ? $subreddit->public_description : null;
                            $archiveSubreddits->subreddit_id =      (isset($subreddit->name)) ? $subreddit->name : null;
                            $archiveSubreddits->over_18 =           (isset($subreddit->over18) && $subreddit->over18) ? 1 : 0;
                            $archiveSubreddits->subreddit_type =    (isset($subreddit->display_name)) ? $subreddit->display_name : null;
                            $archiveSubreddits->submission_type =   (isset($subreddit->submission_type)) ? $subreddit->submission_type : null;
                            $archiveSubreddits->publish_date =      (isset($subreddit->created_utc)) ? $subreddit->created_utc : null;
                            $archiveSubreddits->subscribers =       (isset($subreddit->subscribers)) ? $subreddit->subscribers : null;
                            $archiveSubreddits->dislikes =          0;
                            $archiveSubreddits->likes =             0;
                            $archiveSubreddits->updated_at =        time();
                            $archiveSubreddits->save();

                            $subredditId = $archiveSubreddits->id;

                            $usersSubreddits = UsersSubreddits::where(['user_id'=>$user->id, 'subreddit_id'=>$subredditId])->first();
                            if(empty($usersSubreddits)){
                                $usersSubreddits = new UsersSubreddits();
                                $usersSubreddits->user_id =         $user->id;
                                $usersSubreddits->subreddit_id =    $subredditId;
                                $usersSubreddits->created_at =      time();
                                $usersSubreddits->updated_at =      time();
                                $usersSubreddits->save();
                            }
                        }
                    }
                }
                return response()->json([
                    "data" => $user,
                    "error" => false,
                    "success" => true,
                    "message" => "successfuly",
                ], 200);

            }else{
                return response()->json([
                    "data" => [],
                    "error" => true,
                    "success" => false,
                    "message" => "The post not found",
                ], 200);
            }
        }else{
            return response()->json([
                "data" => [],
                "error" => true,
                "success" => false,
                "message" => "The user not exist in application",
            ], 200);
        }
    }
    public function addSubredditToApplication(Request $request){

        $userId = $request->input('user_id');

        $user = User::where(['reddit_id' => $userId])->first();
        if($user){

            $fullname = (!empty($request->input('fullname')))?$request->input('fullname') : null;

            $subredditName = (!empty($request->input('display_name')))? strtolower($request->input('display_name')) : null;

            if(!empty($fullname) && !empty($subredditName)){

                $redditHelper = new RedditHelper();
                $access_token = $redditHelper->refreshToken($user->refresh_token)->access_token;
                $user->access_token = $access_token;
                $user->save();

                $subreddits = $redditHelper->search_subreddits($access_token,$subredditName,1);

                if(!empty($subreddits->data) && !empty($subreddits->data->children && !empty($subreddits->data->children[0]->data))){

                    $subreddit = $subreddits->data->children[0]->data;

                    $archiveSubreddits = ArchiveSubreddit::where(['subreddit_id' => $fullname])->first();

                    if(empty($archiveSubreddits))
                    {
                        $archiveSubreddits = new ArchiveSubreddit();
                        $archiveSubreddits->created_at = time();
                    }
                    if(isset($subreddit->name) && $subreddit->name == $fullname){

                        $archiveSubreddits->display_name =      (isset($subreddit->display_name)) ? $subreddit->display_name : null;
                        $archiveSubreddits->title =             (isset($subreddit->title)) ? $subreddit->title : null;
                        $archiveSubreddits->url =               (isset($subreddit->url)) ? 'https://www.reddit.com'.$subreddit->url : null;
                        $archiveSubreddits->description =       (isset($subreddit->public_description)) ? $subreddit->public_description : null;
                        $archiveSubreddits->subreddit_id =      (isset($subreddit->name)) ? $subreddit->name : null;
                        $archiveSubreddits->over_18 =           (isset($subreddit->over18) && $subreddit->over18) ? 1 : 0;
                        $archiveSubreddits->subreddit_type =    (isset($subreddit->display_name)) ? $subreddit->display_name : null;
                        $archiveSubreddits->submission_type =   (isset($subreddit->submission_type)) ? $subreddit->submission_type : null;
                        $archiveSubreddits->publish_date =      (isset($subreddit->created_utc)) ? $subreddit->created_utc : null;
                        $archiveSubreddits->subscribers =       (isset($subreddit->subscribers)) ? $subreddit->subscribers : null;
                        $archiveSubreddits->dislikes =          0;
                        $archiveSubreddits->likes =             0;
                        $archiveSubreddits->updated_at =        time();
                        $archiveSubreddits->save();

                        $subredditId = $archiveSubreddits->id;

                        $usersSubreddits = UsersSubreddits::where(['user_id'=>$user->id, 'subreddit_id'=>$subredditId])->first();
                        if(empty($usersSubreddits)){
                            $usersSubreddits = new UsersSubreddits();
                            $usersSubreddits->user_id =         $user->id;
                            $usersSubreddits->subreddit_id =    $subredditId;
                            $usersSubreddits->created_at =      time();
                            $usersSubreddits->updated_at =      time();
                            $usersSubreddits->save();
                        }
                    }
                }
            }

            return response()->json([
                "data" => $user,
                "error" => false,
                "success" => true,
                "message" => "successfuly",
            ], 200);
        }else{
            return response()->json([
                "data" => [],
                "error" => true,
                "success" => false,
                "message" => "The user not exist in application",
            ], 200);
        }

    }
    public function removePostFromApplication(Request $request){
        $postId = $request->input('postId');
        $userId = $request->input('user_id');
        $user = User::where(['reddit_id' => $userId])->first();
        $archivePosts = ArchivePosts::where(['data_id' => $postId])->first();
        $removedPost = false;
        if($user){
            $removedPost = UsersPosts::where(['user_id' => $user->id,'post_id' => $archivePosts->id])->delete();
        }
        if($removedPost){
            return response()->json([
                "data" => $user,
                "error" => false,
                "success" => true,
                "message" => "successfuly",
            ], 200);
        }else{
            return response()->json([
                "data" => [],
                "error" => true,
                "success" => false,
                "message" => "something went wrong",
            ], 200);
        }
    }
    public function removeSubredditFromApplication(Request $request){
        $subredditId = $request->input('subredditId');
        $userId = $request->input('user_id');
        $user = User::where(['reddit_id' => $userId])->first();
        $archiveSubreddits = ArchiveSubreddit::where(['subreddit_id' => $subredditId])->first();
        $removedSubreddit = false;
        if($user){
            $removedSubreddit = UsersSubreddits::where(['user_id' => $user->id,'subreddit_id' => $archiveSubreddits->id])->delete();
        }
        if($removedSubreddit){
            return response()->json([
                "data" => $user,
                "error" => false,
                "success" => true,
                "message" => "successfuly",
            ], 200);
        }else{
            return response()->json([
                "data" => [],
                "error" => true,
                "success" => false,
                "message" => "something went wrong",
            ], 200);
        }
    }
    public function checkUser(Request $request){

        $user_id = $request->input('user_id');
        $user_name = $request->input('user_name');
        $user = User::where(['reddit_id' => $user_id, 'reddit_username'=>$user_name])->first();
        $user['subreddits'] = [];
        $user['posts'] = [];
        if($user){
            $redditUsersSubreddits = User::with('UsersToSubreddits')->find($user->id);
            $userAllSubreddits = $redditUsersSubreddits['relations']['UsersToSubreddits'];
            if(!empty($userAllSubreddits)){
                $subreddits = [];
                foreach($userAllSubreddits as $key => $value){
                    $subreddits[] = $value->subreddit_id;
                }
                $user['subreddits'] = $subreddits;
            }
            $redditUsersPosts = User::with('UsersToPosts')->find($user->id);
            $userAllPosts = $redditUsersPosts['relations']['UsersToPosts'];
            if(!empty($userAllPosts)){
                $posts = [];
                foreach($userAllPosts as $key => $value){
                    $posts[] = $value->data_id;
                }
                $user['posts'] = $posts;
            }
            return response()->json([
                "data" => $user,
                "error" => false,
                "success" => true,
                "message" => "successfuly",
            ], 200);
        }else{
            return response()->json([
                "data" => [],
                "error" => true,
                "success" => false,
                "message" => "The user not exist in application",
            ], 200);
        }
    }
}
