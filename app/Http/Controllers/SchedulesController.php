<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Requests\GetPostRequest;
use App\User;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Services\RedditHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ArchivePosts;
use App\Models\UsersPosts;
use App\Models\ArchiveSubreddit;


class SchedulesController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('posts.create');
    }

    public function create() {

//        return View::make('user.createOrUpdate');
//        $user = User::find($id);
//        // Load user/createOrUpdate.blade.php view
//        return View::make('user.createOrUpdate')->with('user', $user);
    }

    public function research() {

        $viewData['subreddit']['choose_subreddit'] = 'Choose Subreddit';

        $subredditAll = array();

        $subreddit = DB::table('subreddit')
            ->select('*')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('display_name', 'desc')
            ->get();
        if (!empty($subreddit)) {
            /*start section of sorting SubReddit array*/
            foreach ($subreddit as $key => $value) {
                $subredditAll[$key]['key'] = $value->display_name;
                $subredditAll[$key]['value'] = $value->display_name;
            }
            $collection = collect($subredditAll);

            $sorted = $collection->sortBy('value');

            $sorted->values()->all();

            /*end section of sorting SubReddit array*/

            foreach ($sorted as $sorted_value) {
                $viewData['subreddit'][$sorted_value['key']] = $sorted_value['value'];
            }
        }

        $viewData['selected_subreddit'] = $viewData['subreddit']['choose_subreddit'];
        $viewData['response'] = json_encode(array());

        return view('schedules.research',$viewData);
    }
    public function timeResearchBySubreddit(GetPostRequest $request) {
        $subreddit = $request->input('subreddit');
        $response = $this->getTopPostsBySubreddit($subreddit);
        return json_encode($response);
    }
    public function timeResearchByHour(GetPostRequest $request) {
        $subreddit = $request->input('subreddit');
        $hour = $request->input('time');
        $response = $this->getTopPostsByHour($subreddit,$hour);
        return json_encode($response);
    }
    public function timeResearchByDay(GetPostRequest $request) {
        $subreddit = $request->input('subreddit');
        $day = $request->input('time');
        $response = $this->getTopPostsByDay($subreddit,$day);
        return json_encode($response);
    }
    private function getTopPostsBySubreddit($subreddit){
        $user_refresh_token = Auth::user()->refresh_token;
        $redditHelper = new RedditHelper();
        $access_token = $redditHelper->refreshToken($user_refresh_token)->access_token;
        $topPostsResponse = $redditHelper->getTopPostsBySubreddit($access_token,$subreddit,'all');
        $response = array();
        if(!empty($topPostsResponse)){
            if(isset($topPostsResponse->data) && !empty($topPostsResponse->data)){
                $response =array(
                    0 => array("Element", "Density", ["role" => "style"])
                );
                if(!empty($topPostsResponse->data->children)){
                    //dd($topPostsResponse->data->children);
                    foreach($topPostsResponse->data->children as $key => $value){
                        if($value->data->ups < 1000)
                            $chartColor = "green";
                        else if($value->data->ups > 1000 && $value->data->ups < 10000)
                            $chartColor = "blue";
                        else if($value->data->ups > 10000&& $value->data->ups < 50000)
                            $chartColor = "red";
                        else
                            $chartColor = "gold";
                        $response[$key+1] = array(
                            //   0 =>addslashes($value->data->title),
                            0 =>$value->data->domain,
                            1 =>$value->data->ups,
                            2 =>$chartColor
                        );
                    }
                }
            }else if($topPostsResponse->error){
                $response = $topPostsResponse->error;
            }else{
                $response = $topPostsResponse;
            }
        }
        return $response;
    }
    private function getTopPostsByHour($subreddit,$hour){
        $user_refresh_token = Auth::user()->refresh_token;
        $redditHelper = new RedditHelper();
        $access_token = $redditHelper->refreshToken($user_refresh_token)->access_token;
        $topPostsResponse = $redditHelper->getTopPostsBySubreddit($access_token,$subreddit,'day',100);
        $response = array();
        if(!empty($topPostsResponse)){
            if(isset($topPostsResponse->data) && !empty($topPostsResponse->data)){
                $response =array(
                    0 => array("Element", "Density", ["role" => "style"])
                );
                $start = new \DateTime('now');
                $start = $start->modify("-$hour hours")->format('d-m-Y H:i:s');
                $end = new \DateTime('now');
                $end = $end->format('d-m-Y H:i:s');
                if(!empty($topPostsResponse->data->children)){
                    $count = 0;
                    foreach($topPostsResponse->data->children as $key => $value){
                        $post_created = $value->data->created_utc;
                        if($post_created > strtotime($start) && $post_created < strtotime($end)){
                            $count++;
                            if($value->data->ups < 1000)
                                $chartColor = "green";
                            else if($value->data->ups > 1000 && $value->data->ups < 10000)
                                $chartColor = "blue";
                            else if($value->data->ups > 10000&& $value->data->ups < 50000)
                                $chartColor = "red";
                            else
                                $chartColor = "gold";
                            $response[$count] = array(
                                0 =>$value->data->domain,
                                1 =>$value->data->ups,
                                2 =>$chartColor
                            );
                        }
                    }
                }
            }else if($topPostsResponse->error){
                $response = $topPostsResponse->error;
            }else{
                $response = $topPostsResponse;
            }
        }
        return $response;
    }
    private function getTopPostsByDay($subreddit,$day){
        $user_refresh_token = Auth::user()->refresh_token;
        $redditHelper = new RedditHelper();
        $access_token = $redditHelper->refreshToken($user_refresh_token)->access_token;
        $topPostsResponse = $redditHelper->getTopPostsBySubreddit($access_token,$subreddit,'month',100);
        $response = array();
        if(!empty($topPostsResponse)){
            if(isset($topPostsResponse->data) && !empty($topPostsResponse->data)){
                $response =array(
                    0 => array("Element", "Density", ["role" => "style"])
                );
                $start = new \DateTime('now');
                $start = $start->modify("-$day days")->format('d-m-Y H:i:s');
                $end = new \DateTime('now');
                $end = $end->format('d-m-Y H:i:s');

                if(!empty($topPostsResponse->data->children)){
                    $count = 0;

                    foreach($topPostsResponse->data->children as $key => $value){
                        $post_created = $value->data->created_utc;
                        if($post_created > strtotime($start) && $post_created < strtotime($end)){
                            $count++;
                            if($value->data->ups < 1000)
                                $chartColor = "green";
                            else if($value->data->ups > 1000 && $value->data->ups < 10000)
                                $chartColor = "blue";
                            else if($value->data->ups > 10000&& $value->data->ups < 50000)
                                $chartColor = "red";
                            else
                                $chartColor = "gold";
                            $response[$count] = array(
                                //   0 =>addslashes($value->data->title),
                                0 =>$value->data->domain,
                                1 =>$value->data->ups,
                                2 =>$chartColor
                            );
                        }
                    }
                }
            }else if($topPostsResponse->error){
                $response = $topPostsResponse->error;
            }else{
                $response = $topPostsResponse;
            }
        }
        return $response;
    }

    public function archiveBrowserExtension(GetPostRequest $request) {
        $user = User::with('UsersToSubreddits')->find(Auth::user()->id);
        $timezone = $user->timezone;
        $all_subs = $user['relations']['UsersToSubreddits'];
        $defaultSubreddits = array();
        $dataView = array();
        if(!empty($all_subs)){
            foreach($all_subs as $key => $value){
                $defaultSubreddits[$key]['name'] = $value->display_name;
                $defaultSubreddits[$key]['url'] = $value->url;
                $defaultSubreddits[$key]['subscribers'] = $value->subscribers;
                if($value->publish_date){
                    $date_utc = Carbon::createFromTimestamp($value->publish_date)->toDateString();
                    $defaultSubreddits[$key]['date_added'] = convertTimeToUSERzone($date_utc,$timezone);
                }
                else{
                    $defaultSubreddits[$key]['date_added'] = '';
                }
            }

        }
        $dataView['defaultSubreddits'] = $defaultSubreddits;
        return view('schedules.archive',$dataView);
    }
    public function updateList(GetPostRequest $request){
        if ($request->has('subreddit')){
            $subreddit = $request->input('subreddit');
            $user = User::with('UsersToPosts')->find(Auth::user()->id);
            $users_posts = $user->UsersToPosts()->select('post_hint','url','data_id','author','archive_posts.id')
                ->where('subreddit', 'like', '%'.preg_quote($subreddit).'%')
                ->get();
            if(count($users_posts) != 0){
                foreach($users_posts as $key => $value){
                    $defaultPosts['posts'][$key]['user'] = $value->author;
                    $defaultPosts['posts'][$key]['id'] = $value->id;
                    $defaultPosts['posts'][$key]['url'] = $value->url;
                    $defaultPosts['posts'][$key]['data_id'] = $value->data_id;
                    $defaultPosts['posts'][$key]['type'] = (isset($value->post_hint) && !empty($value->post_hint))?$value->post_hint:'';
                    if(isset($value->author) && !empty($value->author)){
                        if(isset($defaultPosts['author']) && !in_array($value->author, $defaultPosts['author'])){
                            $defaultPosts['author'][$key] = $value->author;
                        }
                        if (!isset($defaultPosts['author'])){
                            $defaultPosts['author'][$key] = $value->author;
                        }
                    }
                    if(isset($value->post_hint) && !empty($value->post_hint)){
                        if (isset($defaultPosts['type']) && !in_array($value->post_hint, $defaultPosts['type'])) {
                            $defaultPosts['type'][$key] = $value->post_hint;
                        }
                        if (!isset($defaultPosts['type'])){
                            $defaultPosts['type'][$key] = $value->post_hint;
                        }
                    }
                }
                return json_encode($defaultPosts);
            }
            else{
                return 0;
            }
        }
    }
    public function analytics() {
        return view('schedules.analytics');
    }
    public function reports(GetPostRequest $request){
        $name = 't3_5xac6f';
        $user_refresh_token = Auth::user()->refresh_token;
        $redditHelper = new RedditHelper();
        $access_token = $redditHelper->refreshToken($user_refresh_token)->access_token;
//        $topPostsResponse = $redditHelper->getContent($access_token,$name);
        $karma = $redditHelper->getKarma();
        $user = $redditHelper->getUser();
        dd($user);
//        dd($topPostsResponse->data->children[0]->data);
        dump($request->input('show_post_karma_by'));
        dump($request->input('show_comment_karma_by'));
    }

    public function orderSubs(GetPostRequest $request){
        if ($request->has('val')) {
            $user =  Auth::user();
            $user_refresh_token = $user->refresh_token;
            $redditHelper = new RedditHelper();
            $access_token = $redditHelper->refreshToken($user_refresh_token)->access_token;
            $subredditResponse = $redditHelper->getAllSubs($access_token,$request['val'], 100);
            $Subreddits = array();
            if(!empty($subredditResponse->data->children)){
                foreach($subredditResponse->data->children as $key => $value){
                    $Subreddits[$key]['name'] = $value->data->display_name;
                    $Subreddits[$key]['url'] = $value->data->url;
                    $Subreddits[$key]['subscribers'] = $value->data->subscribers;
                }
            }
            return $Subreddits;
        }
    }
}