<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiveSubreddit extends Model
{
    protected $table = 'archive_subreddits';
    protected $fillable = [
        'display_name',
        'title',
        'url',
        'description',
        'subreddit_id',
        'over_18',
        'subreddit_type',
        'submission_type',
        'publish_date',
        'subscribers',
        'created_at',
        'updated_at'
    ];

    public function ArchiveToSubreddit()
    {
        return $this->belongsToMany('App\Models\User', 'users_subreddits', 'subreddit_id', 'user_id');
    }
}
