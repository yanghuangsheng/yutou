<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//PC
Route::rule('/','www/Index/index');
Route::rule('/404','www/Error/index');
Route::rule('/search','www/Search/index');
Route::rule('/news/item', 'www/News/item');

Route::rule('/forum/item', 'www/Forum/item');
Route::rule('/forum', 'www/Forum/index');

Route::rule('/user/remind', 'www/User/remind');
Route::rule('/user/collection', 'www/User/collection');
Route::rule('/user/info', 'www/User/info');
Route::rule('/user/bindphone', 'www/User/bindPhone');
Route::rule('/user/publishpost', 'www/User/publishPost');
Route::rule('/user/sendsms', 'www/User/sendSms');
Route::rule('/user/uploadcontentimage', 'www/User/uploadContentImage');
Route::rule('/user/uploadavatarimage', 'www/User/uploadAvatarImage');
Route::rule('/user/uploadcoverimage', 'www/User/uploadcoverimage');



Route::rule('/user/login', 'www/User/login');
Route::rule('/user/register', 'www/User/register');
Route::rule('/user/logout', 'www/User/logout');

Route::rule('/user/jump', 'www/User/jump');
Route::rule('/user/callback', 'www/User/callback');


Route::rule('/user', 'www/User/index');



//API
Route::group('api', function () {
    Route::get(':ver/index/all', 'api/:ver.index/all');

    Route::get(':ver/news/list', 'api/:ver.news/index');
    Route::get(':ver/news/item', 'api/:ver.news/item');

    Route::get(':ver/news/comment', 'api/:ver.news/comment');
    Route::get(':ver/news/add_comment', 'api/:ver.news/addComment');

    Route::get(':ver/forum/all', 'api/:ver.forum/index');
    Route::get(':ver/forum/list', 'api/:ver.forum/loadList');

    Route::get(':ver/forum/item', 'api/:ver.forum/item');
    Route::get(':ver/forum/comment', 'api/:ver.forum/comment');
    Route::get(':ver/forum/add_comment', 'api/:ver.forum/addComment');

    Route::get(':ver/lottery/list', 'api/:ver.lottery/index');
    Route::get(':ver/lottery/one_list', 'api/:ver.lottery/oneList');

    Route::get(':ver/search', 'api/:ver.search/index');
    Route::get(':ver/search/list', 'api/:ver.search/loadList');

    Route::get(':ver/login', 'api/:ver.user/login');
    Route::get(':ver/register', 'api/:ver.user/register');
    Route::get(':ver/send_sms', 'api/:ver.user/sendSms');


    Route::get(':ver/time', 'api/:ver.time/index');
})
    ->header('Access-Control-Allow-Origin','*')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->header('Access-Control-Allow-Headers','token,app-type,sign')
    ->allowCrossDomain();








