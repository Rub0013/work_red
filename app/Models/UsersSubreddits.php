<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSubreddits extends Model
{
    protected $table = 'users_subreddits';

    protected $fillable = [
        'user_id',
        'subreddit_id',
        'created_at',
        'updated_at'
    ];
}