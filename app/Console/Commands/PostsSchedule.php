<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JD\Laradit\Facades\Laradit;
use JD\Laradit\Facades\LaraditAuth;
use App\Providers\RedditHelperProvider;
use App\Services\RedditHelper;

class PostsSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:schedule';

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
        $start = new \DateTime('now');
        $start->modify(/*'-3 hours'*/'-10 minutes')->format('dd-mm-YY H:i:s');
        $end = new \DateTime('now');
        $end->format('dd-mm-YY H:i:s');

        $posts = Post::with('user')
            ->whereBetween('publish_date', array($start, $end))
            ->where('is_published', '=', 0)
            ->get();
        $result = [];
        foreach($posts as $post){
            $title = $post->title;
            $link = $post->url;
            $subreddit = $post->sub_reddit;

            $redditHelper = new RedditHelper();
            $redditHelper->refreshToken($post->user->refresh_token);
            $query = $redditHelper->createStory($title, $link, $subreddit);
            if($query->success){
                $post->is_published = 1;
                $post->published_message = 'The post successfully published';
            }else{
                $lengthOfResponseArray = count($query->jquery);
                $published_message = $query->jquery[$lengthOfResponseArray-3][3][0];
                $post->published_message = $published_message;
            }
            $post->save();
            $result[] = $query;
        }
    }
}
