<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubredditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subreddit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name')->unique();
            $table->string('title')->unique();
            $table->string('url')->unique();
            $table->longText('description');
            $table->string('subreddit_type')->nullable();
            $table->string('submission_type')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subreddit');
    }
}
