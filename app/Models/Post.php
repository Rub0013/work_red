<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $fillable = ['title', 'body', 'url', 'imageUrl', 'publish_date', 'is_link_post', 'is_published', 'user_id', 'sub_reddit', 'created_at', 'updated_at','published_message','timezone'];

    protected $visible = ['id', 'title', 'body', 'url', 'imageUrl', 'publish_date', 'is_link_post', 'is_published', 'user_id', 'sub_reddit', 'created_at', 'updated_at','published_message','timezone'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
