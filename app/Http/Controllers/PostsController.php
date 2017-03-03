<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\GetPostRequest;
use App\Models\Post;
use App\Providers\RedditHelperProvider;
use App\Services\RedditHelper;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use JD\Laradit\Facades\Laradit;
use JD\Laradit\Facades\LaraditAuth;
use JD\Laradit\LaraditResourceServiceProvider;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Illuminate\Support\Str;
use App\Models\ArchivePosts;
use App\Models\ArchiveSubreddit;
use App\User;
use App\Models\UsersPosts;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = DB::table('posts')
            ->select('id', 'title', 'body', 'url', 'imageUrl', 'is_published', 'publish_date', 'is_link_post', 'sub_reddit', 'created_at', 'published_message', 'timezone')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $viewData = array();
        if(!empty($posts)){
            foreach($posts as $post)
                $post->body = Str::limit($post->body, 100);
        }
        $viewData['posts'] = $posts;

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

        return view('posts.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post_type = $request->input('post_type');
        if ($post_type == 'text') {
            $body = $request->input('body');
            $url = '';
            $imageUrl = '';
            $isLinkPost = 0;
        } else {
            $body = '';
            $url = $request->input('url');
            $isLinkPost = 1;
            $file = $request->file('image');
            $image_name = time() . "-" . $file->getClientOriginalName();
            $file->move('uploads', $image_name);
            $imageUrl = $image_name;
        }
        $subReddit = $request->input('subreddit');

        $offset = $request->input('timezone');
        $getUserTimeZoneName = getTimeZoneNameByOffset($offset);
        $publishDate = convertTimeToUTCzone($request->input('date'), $getUserTimeZoneName);
        $title = $request->input('title');
        $user_id = Auth::user()->id;

        $start = new \DateTime($publishDate);
        $start->modify('-10 minutes')->format('dd-mm-YY H:i:s');
        $end = new \DateTime($publishDate);
        $end->format('dd-mm-YY H:i:s');

        $posts = Post::with('user')
            ->whereBetween('publish_date', array($start, $end))
            ->where('user_id', '=', Auth::user()->id)
            ->where('is_published', '=', 0)
            ->get();
        if (!$posts->count()) {
            $post = new Post();
            $post->title = $title;
            $post->body = $body;
            $post->url = $url;
            $post->imageUrl = $imageUrl;
            $post->publish_date = $publishDate;
            $post->timezone = $getUserTimeZoneName;
            $post->is_link_post = $isLinkPost;
            $post->sub_reddit = $subReddit;
            $post->is_published = 0;
            $post->user_id = $user_id;
            $post->created_at = new \DateTime();
            $post->updated_at = new \DateTime();
            $post->save();
            return redirect()->route('schedules')->with('message', 'Post created successfully');
        } else {
            return redirect()->route('schedules')->withErrors('Please scedule your post after 10 minute')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('user')
            ->where('id', '=', $id)
            ->limit(1)
            ->get();
        $viewData['post'] = $post[0];
        return view('posts.show', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = DB::table('posts')
            ->select('id', 'title', 'body', 'url', 'imageUrl', 'is_published', 'publish_date', 'is_link_post', 'sub_reddit', 'created_at', 'published_message', 'timezone')
            ->where('user_id', '=', Auth::user()->id)
            ->where('id', '=', $id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        $viewData = array();

        $viewData['post'] = $post[0];

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


        return view('posts.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, $id)
    {
        $post_type = $request->input('post_type');
        $uploaded_file = false;
        if ($post_type == 'text') {
            $body = $request->input('body');
            $url = '';
            $imageUrl = '';
        } else {
            $body = '';
            $url = $request->input('url');
            $file = $request->file('image_edit');
            if ($file !== null) {
                $uploaded_file = true;
                $image_name = time() . "-" . $file->getClientOriginalName();
                $file->move('uploads', $image_name);
                $imageUrl = $image_name;
            }
        }
        $subReddit = $request->input('subreddit');

        $offset = $request->input('timezone');

        $getUserTimeZoneName = getTimeZoneNameByOffset($offset);
        $publishDate = convertTimeToUTCzone($request->input('date'), $getUserTimeZoneName);
        $title = $request->input('title');
        $start = new \DateTime($publishDate);
        $start->modify('-10 minutes')->format('dd-mm-YY H:i:s');
        $end = new \DateTime($publishDate);
        $end->format('dd-mm-YY H:i:s');

        $post = Post::find($id);

        $post->title = $title;
        $post->body = $body;
        $post->url = $url;

        if ($uploaded_file)
            $post->imageUrl = $imageUrl;
        $post->publish_date = $publishDate;
        $post->sub_reddit = $subReddit;
        $post->updated_at = new \DateTime();
        $post->save();
        return redirect()->route('schedules')->with('message', 'The post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('posts')->where('id',$id)->delete();
        return redirect()->route('schedules')->with('message', 'Post successfully deleted!');;
    }
    public function serachSubreddit(GetPostRequest $request){
        $query = $request->input('query');
        if($request->has('sub_arch')){
            $user = User::with('UsersToSubreddits')->find(Auth::user()->id);
            $all_subs = $user->UsersToSubreddits()->select('display_name','url','subscribers','publish_date')
                ->where('display_name', 'like', '%'.preg_quote($query).'%')
                ->get();
            if(count($all_subs) != 0){
                foreach($all_subs as $key => $value){
                    $result[$key] = strtoupper($value->display_name);
                }
                return json_encode($result);
            }
            else{
                $result[0] = 'NO MATCHING FOUND !';
                return json_encode($result);
            }
        }
        else{
            $user = Auth::user();
            $user_refresh_token = $user->refresh_token;
            $redditHelper = new RedditHelper();
            $access_token = $redditHelper->refreshToken($user_refresh_token)->access_token;
            $user->access_token = $access_token;
            $user->save();
            $response = $redditHelper->search_subreddits($access_token, $query,100);
            $result = array();
            if(!empty($response->data->children)){
                foreach($response->data->children as $key => $value){
                    $result[$key] = strtoupper($value->data->display_name);
                }
            }
            return json_encode($result);
        }
    }
    public function deleteArchivePost(GetPostRequest $request) {
         $deletePost = UsersPosts::where('user_id',Auth::user()->id)
             ->where('post_id',$request->input('id'))
             ->delete();
        if($deletePost){
            return response()->json([
                'data' => [],
                'error'=>false,
                'success'=>true,
                'message'=>'Post is successfully deleted']);
        }
        return response()->json([
                'data' => [],
                'error'=>true,
                'success'=>false,
                'message'=>'Something went wrong']);
    }
}
