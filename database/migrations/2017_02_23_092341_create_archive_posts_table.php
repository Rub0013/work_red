<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->string('data_id');
            $table->boolean('over_18')->default(0);
            $table->string('post_hint')->nullable();
            $table->string('likes')->nullable();
            $table->string('subreddit')->nullable();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->integer('downs');
            $table->integer('ups');
            $table->string('url');
            $table->string('publish_date',15);
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
        Schema::dropIfExists('archive_posts');
    }
}
