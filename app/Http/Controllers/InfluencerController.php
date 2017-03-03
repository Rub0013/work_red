<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreatePostRequest;
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

class InfluencerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ignore() {

        $redditHelper = new RedditHelper();

        $access_token = $redditHelper->refreshToken(Auth::user()->refresh_token)->access_token;

        $subredditResponse = $redditHelper->getAllSubs($access_token,'default',100);

        $viewData['subreddit']['choose_subreddit'] = 'Choose Subreddit';

        if(!empty($subredditResponse)){

            $subreddit = $subredditResponse->data->children;

            $subredditAll = array();

            if(!empty($subreddit)){
                /*start section of sorting SubReddit array*/
                foreach($subreddit as $key => $value){
                    $subredditAll[$key]['key'] = $value->data->display_name;
                    $subredditAll[$key]['value'] = strtoupper($value->data->display_name);
                }
                $collection = collect($subredditAll);

                $sorted = $collection->sortBy('value');

                $sorted->values()->all();

                /*end section of sorting SubReddit array*/

                foreach($sorted as $sorted_value){
                    $viewData['subreddit'][$sorted_value['key']] = $sorted_value['value'];
                }
            }
        }
        return view('influencer.ignore',$viewData);
    }
}
