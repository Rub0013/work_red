<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsArchiveSubredditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive_subreddits', function ($table) {
            $table->integer('dislikes')->after('subscribers')->nullable();
            $table->integer('likes')->after('dislikes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archive_subreddits', function ($table) {
            $table->dropColumn('dislikes');
            $table->dropColumn('likes');
        });
    }
}
