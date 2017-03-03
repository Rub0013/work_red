<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RedditHelper;
use App\User;
use App\Models\ArchivePosts;

class UpdateArchivePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive_posts:update';

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
        $posts = ArchivePosts::select('name','id')->get();
        foreach ($posts as $post) {
            $name = $post->name;
            $response = $redditHelper->getContent($access_token,$name);
            if(isset($response->data)){
                $current = $response->data->children[0]->data;
                $db_post = ArchivePosts::find($post->id);
                $db_post->likes = $current->likes;
                $db_post->ups = $current->ups;
                $db_post->downs = $current->downs;
                if($current->over_18 == 'true'){
                    $db_post->over_18 = 1;
                }
                $db_post->save();
            }
        }
    }
}
