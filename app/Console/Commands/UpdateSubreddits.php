<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Subreddit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JD\Laradit\Facades\Laradit;
use JD\Laradit\Facades\LaraditAuth;
use App\Providers\RedditHelperProvider;
use App\Services\RedditHelper;

class UpdateSubreddits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subreddits:update';

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
        $users = DB::table('users')
            ->select('id', 'refresh_token')
            ->get();

        if (!empty($users)) {
            foreach ($users as $key =>$value) {
                $user_refresh_token = $value->refresh_token;
                $user_id = $value->id;
                $redditHelper = new RedditHelper();
                $access_token = $redditHelper->refreshToken($user_refresh_token)->access_token;
                $subredditResponse = $redditHelper->getAllSubs($access_token, 'default', 100);
                if (!empty($subredditResponse)) {
                    $subredditData = $subredditResponse->data->children;
                    if (!empty($subredditData))
                    {
                        foreach ($subredditData as $key => $value) {
                            $subreddit = new Subreddit();
                            $subreddit->display_name = strtoupper($value->data->display_name);
                            $subreddit->title = $value->data->title;
                            $subreddit->url = $value->data->url;
                            $subreddit->description = $value->data->description;
                            $subreddit->subreddit_type = $value->data->subreddit_type;
                            $subreddit->submission_type = $value->data->submission_type;
                            $subreddit->user_id = $user_id;
                            $subreddit->created_at = new \DateTime();
                            $subreddit->updated_at = new \DateTime();
                            $subreddit->save();
                        }
                    }
                }
            }
        }


    }
}
