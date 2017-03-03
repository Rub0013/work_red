<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subreddit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subreddit';

    protected $fillable = ['display_name', 'title','url','description', 'subreddit_type', 'submission_type','user_id','created_at', 'updated_at'];

    protected $visible = ['id', 'display_name', 'title','url', 'description', 'subreddit_type', 'submission_type','user_id','created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
