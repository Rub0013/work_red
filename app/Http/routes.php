<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['auth', 'authReddit']], function () {

    Route::get('/', function () {
        return redirect('schedules');
    });

    Route::get('/schedules', 'PostsController@create')->name('schedules');
    Route::get('/research', 'SchedulesController@research')->name('research');
    Route::get('/archive-browser-extension', 'SchedulesController@archiveBrowserExtension')->name('archive-browser-extension');
    Route::get('/analytics', 'SchedulesController@analytics')->name('analytics');
    Route::get('/ignore', 'InfluencerController@ignore')->name('ignore');
    Route::post('/timeResearchBySubreddit', 'SchedulesController@timeResearchBySubreddit')->name('timeResearchBySubreddit');
    Route::post('/timeResearchByHour', 'SchedulesController@timeResearchByHour')->name('timeResearchByHour');
    Route::post('/timeResearchByDay', 'SchedulesController@timeResearchByDay')->name('timeResearchByDay');
    Route::post('/serachSubreddit', 'PostsController@serachSubreddit')->name('serachSubreddit');
    Route::post('/delete-archive-post', 'PostsController@deleteArchivePost')->name('deleteArchivePost');

    // Users...
    Route::get('/account', 'UserController@account_view')->name('account');
    Route::post('/update_country', 'UserController@country_update');
    Route::post('/update_name', 'UserController@name_update');
    Route::get('/get_countries', 'UserController@get_countries');
    Route::post('/update_pass', 'UserController@update_pass')->name('update_pass');

    // Order subreddits in archive
    Route::post('/order_subs', 'SchedulesController@orderSubs')->name('orderSubreddit');

    // Update post list by...
    Route::post('/update_posts_list', 'SchedulesController@updateList')->name('updateList');

    //Generating reports
    Route::post('/generate_reports', 'SchedulesController@reports')->name('generateReports');

    Route::get('posts/store', 'PostsController@store');
    Route::post('posts/store', 'PostsController@store');

    // Show posts routes...
    Route::get('posts/show/{id}', 'PostsController@show');
    Route::post('posts/show/{id}', 'PostsController@show');

    // Edit posts routes...
    Route::get('posts/edit/{id}', 'PostsController@edit');
    Route::post('posts/edit/{id}', 'PostsController@edit');

//    // Delete posts routes...
//    Route::get('posts/destroy/{id}', 'PostsController@destroy');
//    Route::post('posts/destroy/{id}', 'PostsController@destroy');

    // Update posts routes...
    Route::get('posts/{id}', 'PostsController@update');
    Route::post('posts/{id}', 'PostsController@update');


    Route::resource('posts', 'PostsController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('auth/redditLogin', 'Auth\AuthController@redditLogin')->name('redditLogin');
});
Route::group(['prefix' => 'api/v1','middleware' => 'cors'], function () {
    Route::group(['middleware' => 'authApi'], function () {
        Route::post('add-post', 'Api\ApiController@addPostToApplication')->name('addPostToApplication');
        Route::post('add-subreddit', 'Api\ApiController@addSubredditToApplication')->name('addSubredditToApplication');
        Route::post('remove-post', 'Api\ApiController@removePostFromApplication')->name('removePostFromApplication');
        Route::post('remove-subreddit', 'Api\ApiController@removeSubredditFromApplication')->name('removeSubredditFromApplication');
    });
    Route::get('check-user', 'Api\ApiController@checkUser')->name('checkUser');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login');
Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/redditLogin', 'Auth\AuthController@redditLogin')->name('redditLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister')->name('register');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('auth/exist', 'Auth\AuthController@userExist')->name('exist');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail')->name('resetPassword');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

