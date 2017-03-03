<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveSubredditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_subreddits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name');
            $table->string('title');
            $table->string('url');
            $table->longText('description');
            $table->string('subreddit_id');
            $table->boolean('over_18')->default(0);
            $table->string('subreddit_type')->nullable();
            $table->string('submission_type')->nullable();
            $table->string('publish_date',15);
            $table->integer('subscribers');
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
        Schema::dropIfExists('archive_subreddits');
    }
}
