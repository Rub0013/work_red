<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivePosts extends Model
{
    protected $table = 'archive_posts';
    protected $fillable = [
        'author',
        'data_id',
        'over_18',
        'post_hint',
        'likes',
        'subreddit',
        'title',
        'name',
        'downs',
        'ups',
        'url',
        'publish_date',
        'created_at',
        'updated_at'];

    public function ArchiveToPosts()
    {
        return $this->belongsToMany('App\Models\User', 'users_posts', 'post_id', 'user_id');
    }
}