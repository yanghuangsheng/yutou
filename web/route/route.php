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
    //主页
    Route::get(':ver/index/all', 'api/:ver.index/all');
    Route::get(':ver/news/list', 'api/:ver.news/index'); //加载更多
    //新闻详情
    Route::get(':ver/news/item', 'api/:ver.news/item');
    Route::post(':ver/news/praise', 'api/:ver.news/praise'); //点赞
    Route::post(':ver/news/praise_comment', 'api/:ver.news/praiseComment'); //点赞评论
    Route::get(':ver/news/more_comment', 'api/:ver.news/moreComment'); //加载更多评论
    Route::get(':ver/news/look_comment', 'api/:ver.news/lookComment'); //加载更多评论
    Route::post(':ver/news/submit_comment', 'api/:ver.news/submitComment'); //评论
    //社区
    Route::get(':ver/forum/all', 'api/:ver.forum/index');
    Route::get(':ver/forum/list', 'api/:ver.forum/loadList');
    //帖子详情
    Route::get(':ver/forum/item', 'api/:ver.forum/item');
    Route::post(':ver/forum/praise', 'api/:ver.forum/praise'); //点赞
    Route::post(':ver/forum/praise_comment', 'api/:ver.forum/praiseComment'); //点赞
    Route::get(':ver/forum/more_comment', 'api/:ver.forum/moreComment'); //加载更多评论
    Route::get(':ver/forum/look_comment', 'api/:ver.forum/lookComment'); //查看评论
    Route::post(':ver/forum/submit_comment', 'api/:ver.forum/submitComment'); //评论
    //彩票
    Route::get(':ver/lottery/list', 'api/:ver.lottery/index');
    Route::get(':ver/lottery/one_list', 'api/:ver.lottery/oneList');
    //搜索
    Route::get(':ver/search', 'api/:ver.search/index');
    Route::get(':ver/search/list', 'api/:ver.search/loadList');

    //用户相关
    Route::get(':ver/user/info', 'api/:ver.user/info'); //用户信息
    Route::get(':ver/user/arr', 'api/:ver.user/arr'); //属性
    Route::post(':ver/user/fans', 'api/:ver.user/fans'); //关注用户
    Route::post(':ver/user/bind_phone', 'api/:ver.user/bindPhone'); //绑定手机

    //登陆
    Route::post(':ver/login', 'api/:ver.user/login');
    Route::post(':ver/register', 'api/:ver.user/register');
    Route::post(':ver/send_sms', 'api/:ver.user/sendSms');

    //获取时间
    Route::get(':ver/time', 'api/:ver.time/index');
})
    ->header('Access-Control-Allow-Origin','*')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->header('Access-Control-Allow-Methods', 'GET,POST')
    ->header('Access-Control-Allow-Headers','token,app-type,content-type,sign')
    ->allowCrossDomain();








