<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RedditHelper;
use App\User;
use App\Models\ArchiveSubreddit;

class UpdateArchiveSubreddits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive_subreddits:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $test_user = User::where('reddit_username','=','test_cron0013')->first();
        $user_refresh_token = $test_user->refresh_token;
        $redditHelper = new RedditHelper();
        $access_token = $redditHelper->refreshToken($user_refresh_token)->access_token;
        $test_user->access_token = $access_token;
        $test_user->save();
        $subreddits = ArchiveSubreddit::select('display_name','id','subreddit_id')->get();
        foreach ($subreddits as $subreddit) {
            $query = $subreddit->display_name;
            $response = $redditHelper->getSub($query);
            if(isset($response->data)){
                $sub_rsp = $response->data;
                if($sub_rsp->id == $subreddit->subreddit_id){
                    $sub = ArchiveSubreddit::find($subreddit->id);
                    $sub->subscribers = $sub_rsp->subscribers;
                    if($sub_rsp->over18 == 'true'){
                        $sub->over_18 = 1;
                    }
                    $sub->save();
                }
            }
        }
    }
}
