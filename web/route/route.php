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

Route::get('/api/:ver/index/banner', 'api/:ver.index/banner');
Route::get('/api/:ver/index/broadcast', 'api/:ver.index/broadcast');
Route::get('/api/:ver/index/hot_news', 'api/:ver.index/hotNews');
Route::get('/api/:ver/index/news_column', 'api/:ver.index/newsColumn');

Route::get('/api/:ver/news/list', 'api/:ver.news/index');
Route::get('/api/:ver/news/item', 'api/:ver.news/item');
Route::get('/api/:ver/news/comment', 'api/:ver.news/comment');
Route::get('/api/:ver/news/add_comment', 'api/:ver.news/addComment');

Route::get('/api/:ver/forum/list', 'api/:ver.forum/index');
Route::get('/api/:ver/forum/item', 'api/:ver.forum/item');
Route::get('/api/:ver/forum/comment', 'api/:ver.forum/comment');
Route::get('/api/:ver/forum/add_comment', 'api/:ver.forum/addComment');

Route::get('/api/:ver/search', 'api/:ver.search/index');

Route::get('/api/:ver/login', 'api/:ver.login/index');

Route::get('/api/:ver/time', 'api/:ver.time/index');







