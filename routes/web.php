<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index');

// 公告
Route::get('notices.html', 'ArticleController@articles')->defaults('type', 'notice');
Route::get('notice/{id}.html', 'ArticleController@article')->defaults('type', 'notice');

// 文章
Route::get('articles.html', 'ArticleController@articles')->defaults('type', 'article');
Route::get('article/{id}.html', 'ArticleController@article')->defaults('type', 'article');

// 博客
Route::any('blogs.html', 'BlogController@blogs');
Route::get('blog/{id}.html', 'BlogController@blog');
Route::post('blogs', 'BlogController@items');

// RSS
Route::any('feeds.html', 'FeedController@feeds');
Route::any('feeds/no-rss-list.html', 'FeedController@blogs');


// 申请加入
Route::any('join.html', 'BlogController@join');

// 随机跳转
Route::any('go.html', 'BlogController@random');

// 评论
Route::post('comment/article', 'CommentController@article')->middleware("throttle:40,1");
Route::post('comment/blog', 'CommentController@blog')->middleware("throttle:40,1");

// Profile
Route::get('profile/login.html', 'ProfileController@login');
Route::post('profile/login.html', 'ProfileController@login')->middleware("throttle:20,1");
Route::post('profile/send_code', 'ProfileController@sendCodeMail');
Route::middleware('auth')->group(function () {
    Route::any('profile.html', 'ProfileController@index');
    Route::post('profile/check_feed_link', 'ProfileController@checkFeedLink');
    Route::post('profile/dateline/submit', 'ProfileController@submitDateline');
    Route::post('profile/feedlink/submit', 'ProfileController@submitFeedLink');
    Route::post('profile/blog/change', 'ProfileController@blogChange');
});


Route::get('{key?}.html', 'PageController@detail');
