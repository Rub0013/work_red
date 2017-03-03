<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedditUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reddit_users';

    protected $fillable = ['name', 'reddit_id', 'access_token', 'token_type', 'refresh_token'];

    protected $visible = ['id', 'name', 'reddit_id', 'access_token', 'token_type', 'refresh_token'];
}
