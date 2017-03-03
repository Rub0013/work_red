<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UsersPosts extends Model
{
    protected $table = 'users_posts';

    protected $fillable = [
        'user_id',
        'post_id',
        'created_at',
        'updated_at'
    ];
}