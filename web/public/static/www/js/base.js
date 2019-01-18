/**
 * Created by YANG on 2018/12/19.
 */
$(function($) {
    //console.log(isLogin(1));
    indexJS();
    newsItemJs();
    forumJs();
    forumItemJs();
    searchJs();
    userJs();

    /**
     * 发贴弹窗
     */
    $("#publishForum a").on('click', function () {
        if(isLogin() == false){
            return;
        }
        var url = $(this).data('url');
        commonWindow(url, 740, 600);
    });

    /**
     * 上传图片 forum 封面
     */
    uploadFile('uploadForumImg',{
        'FilesAdded': function (up, files) {
            var imageList = $("#uploadForumImg").prev();
            if(imageList.find('li').length < 3){
                up.start();
            }else{
                layer.msg('最多只能上传3个');
                //up.destroy();
            }
        },
        'FileUploaded': function (up, file, info) {
            var data = $.parseJSON(info.response);
            var imageList = $("#uploadForumImg").prev();
            var oLi = imageList.find('li').last();
            imageList.append(oLi.clone());
            oLi = imageList.find('li').last();
            data = data.data;
            oLi.find('img').attr('src', data.image_url);
            oLi.find('input').val(data.image_url);
            oLi.show();
            oLi.removeClass('box-hide');
            imageList.find('li.box-hide').remove();
        }
    });
    /**
     * 删除图片
     */
    $("#publishForum-box .images-list").on('click', 'a.del', function () {
        var oThis = $(this).parent();
        if($("#publishForum-box .images-list li").length == 1){
            oThis.hide();
            return;
        }
        oThis.remove();
    });
    /**
     * 发布帖子
     */
    $("#publishForum-box button.submit").on('click', function () {
        var oThis = $(this);
        var imageList = true;
        var oStatus = oThis.data('status');
        var oForm = $('#publishForum-box form');
        var content = $('#summernote').summernote('code');
        //oForm.find('textarea').val(content);
        var data = oForm.serializeObject();
        console.log(data);
        if(oStatus == '1'){
            return;
        }
        oForm.find('.images-list li.box-hide input[name="image_url[]"]').each(function () {
            imageList = false;
        });
        if(imageList == false){
            layer.msg('请上传封面图');
            return;
        }
        if(data.title == ''){
            layer.msg('未填写标题');
            return;
        }
        if(data.content == ''){
            layer.msg('未填写内容');
            return;
        }
        data._format_ = 'pub_post';
        oThis.data('status', 1);
        ajax(self.location.href, {
            'data': data,
            'success': function (data) {
                oThis.data('status', 0)
                if(data.code == 0){
                    parent.location.reload();
                    return;
                }
                layer.msg(data.msg);
            }

        });

    });


    /**
     * 登陆按钮事件
     */
    $("#login-btn").on('click', function () {
        loginPopup();
    });

    /**
     * 注册按钮事件
     */
    $("#register-btn").on('click', function () {
        registerPopup();
    });

    /**
     * 退出
     */
    $("#logout-btn").on('click', function () {
        var oThis = $(this);
        var url = oThis.data('url');
        ajax(url, {
            'success': function (data) {
                if(data.code == 0){
                    //parent.location.reload();
                    top.location='/';
                    return;
                }
                layer.msg(data.msg);
            }

        });
    });
    
    /**
     * 发送验证码
     */
    $("#sendVerification,#sendVerification-updatePass").on('click', function () {
        var oThis = $(this);
        var oForm = oThis.parent().parent();
        var mobile = oForm.find('input[name=\'phone\']').val();
        var url = oThis.data('url');
        if(!mobile || !telMatch(mobile)){
            oForm.find('input[name=\'phone\']').focus();
            return;
        }
        if(oThis.data('send') == '1'){
            return;
        }
        ajax(url, {
            'data': {'mobile': mobile},
            'success': function (data) {
                if(data.code == 0){
                    countDown(oThis, 60);
                    return;
                }

                layer.msg(data.msg);

            }

        });

    });

    /**
     * 登陆注册
     */
    $("#login-register-btn").on('click', function () {
        var oThis = $(this);
        var oForm = oThis.parent().parent();
        var mobile = oForm.find('input[name=\'phone\']').val();
        var code = oForm.find('input[name=\'code\']').val();
        if(!mobile || !telMatch(mobile)){
            oForm.find('input[name=\'phone\']').focus();
            return;
        }
        if(code == ''){
            oForm.find('input[name=\'code\']').focus();
            return;
        }

        ajax(self.location.href, {
            'data': {'mobile': mobile, 'code': code},
            'success': function (data) {
                if(data.code == 0){
                    parent.location.reload();
                    return;
                }

                layer.msg(data.msg);
            }

        });
        
    });

    /**
     * 基本资料
     */
    $("#infoForm button").on('click', function () {
        var oThis = $(this);
        var oForm = $("#infoForm form");
        var data = oForm.serializeObject();
        /** 一系列验证 **/
        if(data.name == ''){
            oForm.find('input[name="name"]').focus();
            return;
        }

        ajax(self.location.href, {
            'data': data,
            'success': function (data) {
                if(data.code == 0){
                    layer.msg('保存成功');
                    return;
                }

                layer.msg(data.msg);
            }

        });
    });

    /**
     * 绑定手机
     */
    $("#bindPhoneForm button").on('click', function () {
        var oThis = $(this);
        var oForm = $("#bindPhoneForm form");
        var data = oForm.serializeObject();
        if(data.phone == '' || !telMatch(data.phone)){
            oForm.find('input[name="phone"]').focus();
            return;
        }
        if(data.code == ''){
            oForm.find('input[name="code"]').focus();
            return;
        }

        ajax(self.location.href, {
            'data': {'mobile':data.phone, 'code':data.code},
            'success': function (data) {
                if(data.code == 0){
                    layer.msg('绑定成功');
                    return;
                }

                layer.msg(data.msg);
            }

        });

    });

    /**
     * 上传头像
     */
    uploadFile('uploadAvatarImg',{
        'FileUploaded': function (up, file, info) {
            var data = $.parseJSON(info.response);
            $("#uploadAvatarImg").prev('img').attr('src', data.data.image_url);
            $("#headUserAvatarImage").attr('src', data.data.image_url);
        }
    });

    /**
     * 搜索事件
     */
    $("#searchBtn").on('click', function () {
        var oThis = $(this);
        var qVal = oThis.parent().find('input[name="q"]').val();
        var oUrl = oThis.data('url');

        if(qVal){
            qVal = encodeURIComponent(qVal);
            window.location.href = oUrl + '?q=' + qVal;
        }

    });
    /**
     * 用户展示
     */
    var showUserOut;
    $(".showUserInfo").hover(function () {
        var oThis = $(this);
        var offset = oThis.offset();
        var oId = oThis.data('id');
        var oHome = oThis.data('home');
        clearTimeout(showUserOut);
        $("#showUserBox").remove();
        ajax(getHttpUrl(),{
            'data': {'id':oId, '_format_':'show_user'},
            'success': function (data) {
                if(data.code == 0){
                    var data = data.data;
                    var active = '';
                    var active_txt = '+关注';
                    if(data.is_fans){
                        active = 'active';
                        active_txt = '已关注';
                    }
                    $('body').append('<div id="showUserBox">' +
                        '<div class="flex-start flex-align-start user-box">' +
                            '<div class="user-avatar"><a href="'+ oHome +'"><img src="'+ data.avatar[50] +'"></a></div>' +
                            '<div class="user-name"><p class="name"><a href="'+ oHome +'">'+ data.name +'</a></p><p class="synopsis">'+ data.synopsis +'</p></div>' +
                        '</div>' +
                        '<div class="flex-center flex-align-center content-box">' +
                            '<div class="inline"><p class="name">ta粉丝</p><p class="num">'+ data.fans_num +'</p></div>' +
                            '<div class="inline"><p class="name">ta关注</p><p class="num">'+ data.follow_num +'</p></div>' +
                        '</div>' +
                        '<a class="followBtn '+ active +'" href="javascript:void(0);" data-status="'+ data.is_fans +'" data-id="'+ data.id +'">'+ active_txt +'</a>' +
                        '</div>');
                    $("#showUserBox").offset({top:offset.top + oThis.height() + 8, left:offset.left});
                    $("#showUserBox").hover(function () {
                        clearTimeout(showUserOut);
                    },function () {
                        showUserOut = setTimeout(function(){
                            $("#showUserBox").remove();
                        },2000);
                    });
                    //关注
                    $("#showUserBox  a.followBtn").on('click', function () {
                        var oThis = $(this);
                        var oStatus = oThis.data('status');
                        var oId = oThis.data('id');
                        if(isLogin() == false || oStatus == '1'){
                            return;
                        }
                        if(oId == isLogin(1).id){
                            return;
                        }
                        oThis.data('status',1);
                        ajax(getHttpUrl(), {
                            'data': {'user_id':oId, '_format_':'fans'},
                            'success': function (data) {
                                if(data.code == 0){
                                    oThis.text('已关注');
                                    oThis.addClass('active');
                                    return;
                                }
                                oThis.data('status',0);
                            }
                        })
                    });
                    return;
                }
            }
        });
    },function () {
        showUserOut = setTimeout(function(){
            $("#showUserBox").remove();
        },1000);

    });

    /**
     * 分享
     */
    $(".user-share").share();

});

/**
 * 首页
 */
function indexJS(){

    /**新闻列表 tab**/
    var indexNews = $("#indexNewsList");
    indexNews.find('.news-tab li').on('click', function () {
        var oThis = $(this);
        var oIndex = oThis.index();
        oThis.addClass('child');
        oThis.siblings().removeClass('child');

        indexNews.find('.news-content .news-list').eq(oIndex).show().siblings().hide();
    });

    /**新闻加载**/
    var loadNewsList = $("#newsContentBox");
    loadNewsList.find('a.loadNewsBtn').on('click', function () {
        var oThis = $(this);
        var oPage = parseInt(oThis.data('page')) + 1;
        var oStatus = oThis.data('status');
        var oStartId = oThis.data('start');
        var oCategory = oThis.data('category');

        var thisParent = oThis.parent().parent();

        var cloneLiBox = thisParent.find('li').last();

        if(oStatus == '1'){
            return;
        }
        oThis.data('status', 1);
        oThis.prev().show();

        setTimeout(function(){
            ajax( getHttpUrl(),{
                'data': {page:oPage, start_id:oStartId,category_id:oCategory,'_format_':'news'},
                'type': 'GET',
                'success': function (data) {
                    //console.log(data);
                    oThis.data('status', 0);
                    oThis.data('page', oPage);
                    oThis.prev().hide();
                    if(data.code == 0){
                        data = data.data;
                        $.each(data, function (i, n) {
                            thisParent.find('ul').append(cloneLiBox.clone());
                            var oLi = thisParent.find('li').last();
                            var oUrl = oLi.find('.image a').attr('href');
                            var oId = oUrl.match(/\d+\b/);
                            oUrl = oUrl.replace(oId, n.id);
                            oLi.find('.image a').attr('href', oUrl);
                            oLi.find('p.title a').attr('href', oUrl);
                            oLi.find('.image img').attr('src', n.image_url);
                            oLi.find('p.title a').html(n.title);
                            oLi.find('p.description').html(n.description);
                            oLi.find('p.author-name').html(n.author ? n.author : n.source_name);
                            oLi.find('.read span').text(n.browse_num ? n.browse_num : '0');
                            oLi.find('.comment span').text(n.comment_num ? n.comment_num : '0');
                            oLi.find('.collection span').text(n.collect_num ? n.collect_num : '0');
                        })
                    }
                },
                'error': function () {

                }

            });
        }, 1000);

    })

}

function searchJs() {
    /**新闻加载**/
    var loadList = $("#searchContentBox");
    loadList.find('a.loadSearchBtn').on('click', function () {
        var oThis = $(this);
        var oPage = parseInt(oThis.data('page')) + 1;
        var oQ = oThis.data('q');
        var oStatus = oThis.data('status');
        var oStartId = oThis.data('start');

        var thisParent = oThis.parent().parent();

        var cloneLiBox = thisParent.find('li').last();

        if(oStatus == '1'){
            return;
        }
        oThis.data('status', 1);
        oThis.prev().show();

        setTimeout(function(){
            ajax( getHttpUrl(),{
                'data': {page:oPage, start_id:oStartId, q:oQ, '_format_':'json'},
                'type': 'GET',
                'success': function (data) {
                    //console.log(data);
                    oThis.data('status', 0);
                    oThis.data('page', oPage);
                    oThis.prev().hide();
                    if(data.code == 0){
                        data = data.data;
                        $.each(data, function (i, n) {
                            thisParent.find('ul').append(cloneLiBox.clone());
                            var oLi = thisParent.find('li').last();
                            var oUrl = oLi.find('.image a').attr('href');
                            var oId = oUrl.match(/\d+\b/);
                            oUrl = oUrl.replace(oId, n.id);
                            oLi.find('.image a').attr('href', oUrl);
                            oLi.find('p.title a').attr('href', oUrl);
                            oLi.find('.image img').attr('src', n.image_url);
                            oLi.find('p.title a').html(n.title);
                            oLi.find('p.description').html(n.description);
                            oLi.find('p.author-name').html(n.author ? n.author : n.source_name);
                            oLi.find('.read span').text(n.browse_num ? n.browse_num : '0');
                            oLi.find('.comment span').text(n.comment_num ? n.comment_num : '0');
                            oLi.find('.collection span').text(n.collect_num ? n.collect_num : '0');
                        })
                    }
                },
                'error': function () {

                }

            });
        }, 1000);

    })
}

/**
 * 新闻详情交互
 */
function newsItemJs(){
    /**点赞**/
    $("#newsPraiseBtn").on('click', function () {
        var oThis = $(this);
        var oStatus = oThis.data('status');
        var oNum = oThis.find('.number').text();
        oNum = oNum?parseInt(oNum):0;
        if(isLogin() == false){
            return;
        }
        if(oStatus == '1'){
            return;
        }
        oThis.data('status', 1);

        ajax( getHttpUrl(),{
            'data': {'_format_':'praise'},
            'success': function (data) {
                oThis.data('status', 0);
                if(data.code == 0){
                    oThis.find('.number').text(oNum + 1);
                     layer.tips('谢谢，你的点赞!!!', oThis, {
                        tips: [1, '#0FA6D8'] //还可配置颜色
                    });
                    return;
                }
                layer.tips(data.msg, oThis, {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
            }
        });

    });
    /**评论内容**/
    $("#commentTextBtn").on('focus', function () {
        if(isLogin() == false){
            return;
        }
    });
    /**评论登陆**/
    $("#commentLoginBtn").on('click', function () {
        isLogin();
    });
    /**提交评论**/
    $("#commentSubmitBtn").on('click', function () {
        if(isLogin() == false){
            return;
        }
        var oThis = $(this);
        var thisParent = oThis.parent().parent().parent();
        var oStatus = oThis.data('status');
        var thisTextArea = thisParent.find('textarea');
        var oContent =  thisTextArea.val();
        if(oStatus == '1'){
            return;
        }
        if(oContent == ''){
            thisTextArea.focus();
            return;
        }
        oThis.data('status', 1);
        ajax( getHttpUrl(),{
            'data': {'content': oContent, '_format_':'comment'},
            'success': function (data) {
                oThis.data('status', 0);
                if(data.code == 0){
                    layer.msg('评论成功');
                    thisTextArea.val('');
                    var thisListBox = $("#commentListBox");
                    var thisInline = thisListBox.find('.comment-list-inline').first();
                    thisListBox.prepend(thisInline.clone());
                    thisInline = thisListBox.find('.comment-list-inline').first();
                    var thisMain = thisInline.find('.content-main');
                    var userData = isLogin(1);
                    thisMain.find('.user-avatar img').attr('src', userData.avatar['50']);
                    thisMain.find('.user-name').text(userData.name);
                    thisMain.find('.to-day').text('刚刚');
                    thisMain.find('.top-num').text('');
                    thisMain.find('.tread-num').text('');
                    thisMain.find('.comment-content').html(oContent);
                    thisMain.find('a.comment-reply').data('reply', userData.id);
                    thisMain.find('a.comment-reply').data('reply-name', userData.name);


                    thisInline.removeClass('box-hide');
                    thisInline.show();
                    thisListBox.find('.comment-list-inline.box-hide').remove();
                    thisInline.find('.comment-reply-list li.content-list-inline').first().addClass('box-hide').siblings('li.content-list-inline').remove();
                    thisInline.find('.comment-reply-list').hide();

                    var newsComment = $("#newsCommentListBox");
                    var countNum = newsComment.find('.comment-count').text();
                    newsComment.find('.comment-count').text(parseInt(countNum) + 1);
                    newsComment.show();
                }
            }
        });

    });

    /**
     * 回复窗块
     */
    $(".news-item-comment").on('click', 'a.comment-reply', function () {
        if(isLogin() == false){
            return;
        }
        var oThis = $(this);
        var replyUserid = oThis.data('reply');
        var replyUserName = oThis.data('reply-name');
        var parentId = oThis.data('parent');
        var thisReplyComment = $('#reply-comment-post');
        if(isLogin(1).id == replyUserid){
            layer.tips('不允许回复自己的哦！', oThis, {
                tips: [1, '#0FA6D8'] //还可配置颜色
            });
            return;
        }
        var replyBox = '<div class="flex-between flex-align-stretch flex-align-center" id="reply-comment-post">' +
                '<div class="flex-between flex-align-stretch flex-align-center input">' +
                    '<input type="text" name="content" placeholder="回复：'+ replyUserName +'">' +
                    '<a href="javascript:void(0);" class="flex-center flex-align-center expr"><i class="b-img"></i></a>' +
                '</div>' +
                '<div class="submit">' +
                    '<a href="javascript:void(0);" data-status="0" data-parent="'+ parentId +'" data-reply="'+ replyUserid +'"  data-reply-name="'+ replyUserName +'">发布</a>' +
                '</div>' +
            '</div>';
        thisReplyComment.remove();
        oThis.after(replyBox);

        $("#reply-comment-post .submit a").on('click', function () {
            if(isLogin() == false){
                return;
            }
            var oThis = $(this);
            var thisReplyContent = oThis.parent().parent().find('input[name="content"]');
            var replyUserid = oThis.data('reply');
            var replyUserName = oThis.data('reply-name');
            var parentId = oThis.data('parent');
            var oStatus = oThis.data('status');
            var content = thisReplyContent.val();
            if(oStatus == '1'){
                return;
            }
            if(content == ''){
                thisReplyContent.focus();
                return;
            }
            oThis.data('status', 1);
            ajax( getHttpUrl(),{
                'data': {'content':content, 'parent':parentId, 'reply_id':replyUserid,  '_format_':'reply_comment'},
                'success': function (data) {
                    oThis.data('status', 0);
                    if(data.code == 0){
                        layer.msg('回复评论成功');
                        thisReplyContent.val('');
                        var topThis = oThis.parent().parent().parent().parent().parent();
                        $("#reply-comment-post").remove();
                        console.log(topThis.html());
                        var oListBox = topThis.find('.comment-reply-list');
                        var oInline = oListBox.find('li.content-list-inline').first();

                        oListBox.prepend(oInline.clone());
                        oInline = oListBox.find('li.content-list-inline').first();

                        var userData = isLogin(1);
                        oInline.find('.user-avatar img').attr('src', userData.avatar['50']);
                        oInline.find('.user-name.main').text(userData.name);
                        oInline.find('.user-name.reply-user-name').text(userData.replyUserName);
                        oInline.find('.to-day').text('刚刚');
                        oInline.find('.top-num').text('');
                        oInline.find('.tread-num').text('');
                        oInline.find('.comment-content').html(content);
                        oInline.find('a.comment-reply').data('reply', userData.id);
                        oInline.find('a.comment-reply').data('reply-name', userData.name);

                        oInline.removeClass('box-hide');
                        oInline.show();
                        oListBox.show();
                        oListBox.find('li.content-list-inline.box-hide').remove();
                    }
                }
            });
        });
    });
    /**
     * 评论赞
     */
    $(".news-item-comment").on('click', 'a.comment-praise', function () {
        if(isLogin() == false){
            return;
        }
        var oThis = $(this);
        var oStatus = oThis.data('status');
        var oComment = oThis.data('id');
        var oUser = oThis.data('user');
        var thisNum = oThis.find('.num');
        var oNum = thisNum.text();
        var userData = isLogin(1);
        oNum = oNum?parseInt(oNum):0;
        if(oUser == '' || userData.id == oUser || oStatus == '1'){
            return ;
        }

        oThis.data('status', 1);
        ajax( getHttpUrl(), {
            'data': {'id': oComment, '_format_': 'comment_praise'},
            'success': function (data) {
                oThis.data('status', 0);
                if (data.code == 0) {
                    thisNum.text(oNum + 1);
                }
            }
        });

    });
    /**
     * 评论踏
     */
    $(".news-item-comment").on('click', 'a.comment-tread', function () {
        if(isLogin() == false){
            return;
        }
        var oThis = $(this);
        var oStatus = oThis.data('status');
        var oComment = oThis.data('id');
        var oUser = oThis.data('user');
        var thisNum = oThis.find('.num');
        var oNum = thisNum.text();
        var userData = isLogin(1);
        oNum = oNum?parseInt(oNum):0;
        if(oUser == '' || userData.id == oUser || oStatus == '1'){
            return ;
        }

        oThis.data('status', 1);
        ajax( getHttpUrl(), {
            'data': {'id': oComment, '_format_': 'comment_tread'},
            'success': function (data) {
                oThis.data('status', 0);
                if (data.code == 0) {
                    thisNum.text(oNum + 1);
                }
            }
        });

    });



}

/**
 * 论坛JS
 */
function forumJs() {
    /**帖子列表 tab**/
    var indexForum = $("#indexForumList");
    indexForum.find('.list-tab li').on('click', function () {
        var oThis = $(this);
        var oIndex = oThis.index();
        oThis.addClass('child');
        oThis.siblings().removeClass('child');

        indexForum.find('.content-list .list-inline').eq(oIndex).show().siblings().hide();
    });

    /**帖子加载**/
    var loadForumList = $("#forumContentBox");
    loadForumList.find('a.loadForumBtn').on('click', function () {
        var oThis = $(this);
        var oPage = parseInt(oThis.data('page')) + 1;
        var oStatus = oThis.data('status');
        var oStartId = oThis.data('start');
        var oType = oThis.data('type');

        var thisParent = oThis.parent().parent();

        var cloneLiBox = thisParent.find('li').last();

        if(oStatus == '1'){
            return;
        }
        oThis.data('status', 1);
        oThis.prev().show();

        setTimeout(function(){
            ajax( getHttpUrl(),{
                'data': {page:oPage, start_id:oStartId,type:oType,'_format_':'post'},
                'type': 'GET',
                'success': function (data) {
                    //console.log(data);
                    oThis.data('status', 0);
                    oThis.data('page', oPage);
                    oThis.prev().hide();
                    if(data.code == 0){
                        data = data.data;
                        $.each(data, function (i, n) {
                            thisParent.find('ul').append(cloneLiBox.clone());
                            var oLi = thisParent.find('li').last();
                            var oUrl = oLi.find('.title a').attr('href');
                            var oId = oUrl.match(/\d+\b/);
                            oUrl = oUrl.replace(oId, n.id);

                            oLi.find('.content-all').hide();
                            oLi.find('.content-all').siblings().show();
                            oLi.find('.content-body').html('');
                            oLi.find('.content-all-end date').text('发布于 '+ n.create_time);
                            oLi.find('.look-all').attr('data-id', n.id);

                            oLi.find('a.link').attr('href', oUrl);
                            oLi.find('.title a').html(n.title);
                            oLi.find('.read span').text(n.browse_num ? n.browse_num : '0');
                            oLi.find('.content-images').html('');
                            oLi.find('.description').html(n.description);
                            $.each(n.image_url, function (i, d) {
                                oLi.find('.content-images').append('<p>'+
                                        '<a href="'+ oUrl +'" class="link">'+
                                            '<img src="'+ d +'" alt="">'+
                                        '</a>'+
                                    '</p>');
                            });

                            oLi.find('.fabulous span').text(n.praise_num ? n.praise_num : '0');
                            oLi.find('.comment span').text(n.comment_num ? n.comment_num : '0');
                            oLi.find('.collection span').text(n.collect_num ? n.collect_num : '0');

                            oLi.find('.user-avatar img').attr('src', n.user_avatar[50]);
                            oLi.find('.user-name').text(n.user_name);

                            oLi.find('.showUserInfo').attr('data-id', n.user_id);
                            var homeUrl = oLi.find('.showUserInfo').attr('data-home');
                            oLi.find('.showUserInfo').attr('data-home', homeUrl.replace(homeUrl.match(/\d+\b/),n.user_id));

                            oLi.find('.user-share').attr('data-tile',n.title).attr('data-link',oUrl).share();
                        })
                    }
                },
                'error': function () {

                }

            });
        }, 1000);

    })

    /**阅读全文**/
    loadForumList.on('click', 'a.look-all', function () {
        var oThis = $(this);
        var postId = oThis.data('id');
        var oParent = oThis.parent().parent().find('.content-all');
        if(oParent.find('.content-body').html() == ''){
            ajax(getHttpUrl(), {
                'data': {id:postId, '_format_':'item'},
                'type': 'GET',
                'success': function (data) {
                    if(data.code == 0){
                        oParent.find('.content-body').html(data.data);
                    }
                }
            });
        }
        oParent.toggle();
        oParent.siblings().toggle();
    });
    /**收起全文**/
    loadForumList.on('click', 'a.look-no', function () {
        var oThis = $(this);
        var oParent = oThis.parent().parent();
        oParent.toggle();
        oParent.siblings().toggle();
    })
}

/**
 * 用户交互
 */
function userJs() {
    /**用户帖子加载**/
    var loadForumList = $("#userForumContentBox");
    loadForumList.find('a.loadUserForumBtn').on('click', function () {
        var oThis = $(this);
        var oPage = parseInt(oThis.data('page')) + 1;
        var oStatus = oThis.data('status');
        var oStartId = oThis.data('start');

        var thisParent = oThis.parent().parent();

        var cloneLiBox = thisParent.find('li').last();

        if(oStatus == '1'){
            return;
        }
        oThis.data('status', 1);
        oThis.prev().show();

        setTimeout(function(){
            ajax( getHttpUrl(),{
                'data': {page:oPage, start_id:oStartId,'_format_':'post_list'},
                'type': 'GET',
                'success': function (data) {
                    //console.log(data);
                    oThis.data('status', 0);
                    oThis.data('page', oPage);
                    oThis.prev().hide();
                    if(data.code == 0){
                        data = data.data;
                        $.each(data, function (i, n) {
                            thisParent.find('ul').append(cloneLiBox.clone());
                            var oLi = thisParent.find('li').last();
                            var oUrl = oLi.find('.title a').attr('href');
                            var oId = oUrl.match(/\d+\b/);
                            oUrl = oUrl.replace(oId, n.id);

                            oLi.find('.content-all').hide();
                            oLi.find('.content-all').siblings().show();
                            oLi.find('.content-body').html('');
                            oLi.find('.content-all-end date').text('发布于 '+ n.create_time);
                            oLi.find('.look-all').attr('data-id', n.id);

                            oLi.find('a.link').attr('href', oUrl);
                            oLi.find('.title a').html(n.title);
                            oLi.find('.read span').text(n.browse_num ? n.browse_num : '0');
                            oLi.find('.content-images').html('');
                            oLi.find('.description').html(n.description);
                            $.each(n.image_url, function (i, d) {
                                oLi.find('.content-images').append('<p>'+
                                    '<a href="'+ oUrl +'" class="link">'+
                                    '<img src="'+ d +'" alt="">'+
                                    '</a>'+
                                    '</p>');
                            });

                            oLi.find('.fabulous span').text(n.praise_num ? n.praise_num : '0');
                            oLi.find('.comment span').text(n.comment_num ? n.comment_num : '0');
                            oLi.find('.collection span').text(n.collect_num ? n.collect_num : '0');

                            oLi.find('.user-avatar img').attr('src', n.user_avatar[50]);
                            oLi.find('.user-name').text(n.user_name);
                        })
                    }
                },
                'error': function () {

                }

            });
        }, 1000);

    });

    /**我的帖子阅读全文**/
    loadForumList.on('click', 'a.look-all', function () {
        var oThis = $(this);
        var postId = oThis.data('id');
        var oUrl = oThis.data('url');
        var oParent = oThis.parent().parent().find('.content-all');
        if(oParent.find('.content-body').html() == ''){
            ajax(oUrl, {
                'data': {id:postId, '_format_':'item'},
                'type': 'GET',
                'success': function (data) {
                    if(data.code == 0){
                        oParent.find('.content-body').html(data.data);
                    }
                }
            });
        }
        oParent.toggle();
        oParent.siblings().toggle();
    });
    /**我的帖子收起全文**/
    loadForumList.on('click', 'a.look-no', function () {
        var oThis = $(this);
        var oParent = oThis.parent().parent();
        oParent.toggle();
        oParent.siblings().toggle();
    });


    /**我的收藏 tab**/
    var userCollect = $("#userCollectList");
    userCollect.find('.collect-tab li').on('click', function () {
        var oThis = $(this);
        var oIndex = oThis.index();
        oThis.addClass('child');
        oThis.siblings().removeClass('child');

        userCollect.find('.collect-content .list-inline').eq(oIndex).show().siblings().hide();
    });
    /**删除帖子**/
    userCollect.on('click', 'a.delBtn', function () {
        var oThis = $(this);
        var oType = oThis.data('type');
        var oId = oThis.data('id');
        var oStatus = oThis.data('status');
        if(oStatus == '1'){
            return;
        }
        layer.confirm('确定删除吗？',{icon: 3, title:false, closeBtn:false}, function (index) {
            oThis.data('status', 1);
            ajax(getHttpUrl(), {
                'data': {id: oId, '_format_': 'del_collect'},
                'type': 'GET',
                'success': function (data) {
                    oThis.data('status', 0);
                    if (data.code == 0) {
                        if (oType == 'news') {
                            oThis.parent().parent().remove();
                            layer.close(index);
                            return;
                        }
                        oThis.parent().remove();
                        layer.close(index);
                        return;
                    }
                }
            });
        });
    });
    /**收藏新闻加载**/
    userCollect.find('a.loadCollectNewsBtn').on('click', function () {
        var oThis = $(this);
        var oPage = parseInt(oThis.data('page')) + 1;
        var oStatus = oThis.data('status');
        var oStartId = oThis.data('start');
        var oUser = oThis.data('user');

        var thisParent = oThis.parent().parent();

        var cloneLiBox = thisParent.find('li').last();

        if(oStatus == '1'){
            return;
        }
        oThis.data('status', 1);
        oThis.prev().show();

        setTimeout(function(){
            ajax( getHttpUrl(),{
                'data': {page:oPage, start_id:oStartId, user_id:oUser, '_format_':'news_list'},
                'type': 'GET',
                'success': function (data) {
                    //console.log(data);
                    oThis.data('status', 0);
                    oThis.data('page', oPage);
                    oThis.prev().hide();
                    if(data.code == 0){
                        data = data.data;
                        $.each(data, function (i, n) {
                            thisParent.find('ul').append(cloneLiBox.clone());
                            var oLi = thisParent.find('li').last();
                            var oUrl = oLi.find('.image a').attr('href');
                            var oId = oUrl.match(/\d+\b/);
                            oUrl = oUrl.replace(oId, n.id);
                            oLi.find('.image a').attr('href', oUrl);
                            oLi.find('p.title a').attr('href', oUrl);
                            oLi.find('.image img').attr('src', n.image_url);
                            oLi.find('p.title a').html(n.title);
                            oLi.find('p.description').html(n.description);
                            //oLi.find('p.author-name').html(n.author ? n.author : n.source_name);

                            oLi.find('.date').text(n.create_time + ' 收藏');
                            oLi.find('a.delBtn').attr('data-id', n.id);

                            oLi.find('.read span').text(n.browse_num ? n.browse_num : '0');
                            oLi.find('.comment span').text(n.comment_num ? n.comment_num : '0');
                            oLi.find('.collection span').text(n.collect_num ? n.collect_num : '0');
                        })
                    }
                },
                'error': function () {

                }

            });
        }, 1000);

    });
    /**
     * 收藏帖子加载
     */
    userCollect.find('a.loadCollectPostBtn').on('click', function () {
        var oThis = $(this);
        var oPage = parseInt(oThis.data('page')) + 1;
        var oStatus = oThis.data('status');
        var oStartId = oThis.data('start');
        var oUser = oThis.data('user');

        var thisParent = oThis.parent().parent();

        var cloneLiBox = thisParent.find('li').last();

        if(oStatus == '1'){
            return;
        }
        oThis.data('status', 1);
        oThis.prev().show();

        setTimeout(function(){
            ajax( getHttpUrl(),{
                'data': {page:oPage, start_id:oStartId,user_id:oUser,'_format_':'post_list'},
                'type': 'GET',
                'success': function (data) {
                    //console.log(data);
                    oThis.data('status', 0);
                    oThis.data('page', oPage);
                    oThis.prev().hide();
                    if(data.code == 0){
                        data = data.data;
                        $.each(data, function (i, n) {
                            thisParent.find('ul').append(cloneLiBox.clone());
                            var oLi = thisParent.find('li').last();
                            var oUrl = oLi.find('.title a').attr('href');
                            var oId = oUrl.match(/\d+\b/);
                            oUrl = oUrl.replace(oId, n.id);

                            oLi.find('.content-all').hide();
                            oLi.find('.content-all').siblings().show();
                            oLi.find('.content-body').html('');
                            oLi.find('.content-all-end date').text('发布于 '+ n.create_time);
                            oLi.find('.look-all').attr('data-id', n.id);

                            oLi.find('a.link').attr('href', oUrl);
                            oLi.find('.title a').html(n.title);
                            oLi.find('.read span').text(n.browse_num ? n.browse_num : '0');
                            oLi.find('.content-images').html('');
                            oLi.find('.description').html(n.description);
                            $.each(n.image_url, function (i, d) {
                                oLi.find('.content-images').append('<p>'+
                                    '<a href="'+ oUrl +'" class="link">'+
                                    '<img src="'+ d +'" alt="">'+
                                    '</a>'+
                                    '</p>');
                            });

                            oLi.find('.fabulous span').text(n.praise_num ? n.praise_num : '0');
                            oLi.find('.comment span').text(n.comment_num ? n.comment_num : '0');
                            oLi.find('.collection span').text(n.collect_num ? n.collect_num : '0');

                            oLi.find('.date').text(n.create_time + ' 收藏');
                            oLi.find('a.delBtn').attr('data-id', n.id);
                            oLi.find('.user-avatar img').attr('src', n.user_avatar[50]);
                            oLi.find('.user-name').text(n.user_name);

                            oLi.find('.showUserInfo').attr('data-id', n.user_id);
                            var homeUrl = oLi.find('.showUserInfo').attr('data-home');
                            oLi.find('.showUserInfo').attr('data-home', homeUrl.replace(homeUrl.match(/\d+\b/),n.user_id));

                        })
                    }
                },
                'error': function () {

                }

            });
        }, 1000);

    });

    /**收藏帖子阅读全文**/
    userCollect.on('click', 'a.look-all', function () {
        var oThis = $(this);
        var postId = oThis.data('id');
        var oUrl = oThis.data('url');
        var oParent = oThis.parent().parent().find('.content-all');
        if(oParent.find('.content-body').html() == ''){
            ajax(oUrl, {
                'data': {id:postId, '_format_':'item'},
                'type': 'GET',
                'success': function (data) {
                    if(data.code == 0){
                        oParent.find('.content-body').html(data.data);
                    }
                }
            });
        }
        oParent.toggle();
        oParent.siblings().toggle();
    });
    /**收藏帖子收起全文**/
    userCollect.on('click', 'a.look-no', function () {
        var oThis = $(this);
        var oParent = oThis.parent().parent();
        oParent.toggle();
        oParent.siblings().toggle();
    });


    /**我的消息 tab**/
    var userRemind = $("#userRemindBox");
    userRemind.find('.remind-tab li').on('click', function () {
        var oThis = $(this);
        var oIndex = oThis.index();
        oThis.addClass('child');
        oThis.siblings().removeClass('child');

        userRemind.find('.remind-content .list-inline').eq(oIndex).show().siblings().hide();
    });

    /**标记系统信息已读事件**/
    $("#clearSystemBtn").on('click', function () {
        var oThis = $(this);
        var startId = oThis.data('start');
        ajax(getHttpUrl(), {
            'data':{'start_id':startId, '_format_':'clear_system'},
            'success': function (data) {
                if(data.code == 0){
                    oThis.find('span.num-tips').remove();
                }
            }
        })
    });
    /**标记互动信息已读事件**/
    $("#clearInteractionBtn").on('click', function () {
        var oThis = $(this);
        var startId = oThis.data('start');
        ajax(getHttpUrl(), {
            'data':{'start_id':startId, '_format_':'clear_interaction'},
            'success': function (data) {
                if(data.code == 0){
                    $("#userRemindBox .remind-tab li:first-child").find('span.num').remove();
                    $("#userRemindBox .interaction-list").find('i.tips').hide();
                }
            }
        })
    });
    /**加载更多互动消息**/
    userRemind.find('a.loadInteractionBtn').on('click', function () {
        var oThis = $(this);
        var oPage = parseInt(oThis.data('page')) + 1;
        var oStatus = oThis.data('status');
        var oStartId = oThis.data('start');

        var thisParent = oThis.parent().parent();

        var cloneLiBox = thisParent.find('li').last();

        if(oStatus == '1'){
            return;
        }
        oThis.data('status', 1);
        oThis.prev().show();

        setTimeout(function(){
            ajax( getHttpUrl(), {
                'data': {page: oPage, start_id: oStartId, '_format_': 'interaction_list'},
                'type': 'GET',
                'success': function (data) {
                    //console.log(data);
                    oThis.data('status', 0);
                    oThis.data('page', oPage);
                    oThis.prev().hide();
                    if (data.code == 0) {
                        data = data.data;
                        $.each(data, function (i, n) {
                            thisParent.find('ul').append(cloneLiBox.clone());
                            var oLi = thisParent.find('li').last();
                            if(n.status) {oLi.find('i.tips').hide();} else{oLi.find('i.tips').show();}
                            oLi.find('.user-avatar img').attr('src', n.user_avatar['50']);
                            oLi.find('.user-name').text(n.user_name);
                            oLi.find('.link-txt').text(n.link_txt);
                            oLi.find('.link-ext').html(n.link_ext);
                            if(n.parent.praise_num){oLi.find('.praise').show().find('span').text(n.parent.praise_num);}else{oLi.find('.praise').hide().find('span').text('0');}
                            if(n.parent.tread_num){oLi.find('.tread').show().find('span').text(n.parent.tread_num);}else{oLi.find('.tread').hide().find('span').text('0');}
                            if(n.parent.title){oLi.find('.parent-title').show().text(n.parent.title);}else{oLi.find('.parent-title').hide().text('');}
                            if(n.parent.content){oLi.find('.parent-content').show().find('span.content-text').text(n.parent.title);}else{oLi.find('.parent-content').hide().find('span.content-text').text('');}
                            if(n.content){oLi.find('.user-content-body').show().html(n.content);}else{oLi.find('.user-content-body').hide().html('');}
                            var lookUrl = oLi.find('a.look-btn').attr('href');
                            var oId = lookUrl.match(/\d+\b/);
                            lookUrl = lookUrl.replace(oId, n.parent.post_id);
                            oLi.find('a.look-btn').attr('href', lookUrl);
                            oLi.find('.date').text(n.create_time);
                        });
                    }
                }
            });
        });

    });
    /**加载更多系统消息**/
    userRemind.find('a.loadSystemBtn').on('click', function () {
        var oThis = $(this);
        var oPage = parseInt(oThis.data('page')) + 1;
        var oStatus = oThis.data('status');
        var oStartId = oThis.data('start');

        var thisParent = oThis.parent().parent();

        var cloneLiBox = thisParent.find('li').last();

        if(oStatus == '1'){
            return;
        }
        oThis.data('status', 1);
        oThis.prev().show();

        setTimeout(function(){
            ajax( getHttpUrl(), {
                'data': {page: oPage, start_id: oStartId, '_format_': 'system_list'},
                'type': 'GET',
                'success': function (data) {
                    //console.log(data);
                    oThis.data('status', 0);
                    oThis.data('page', oPage);
                    oThis.prev().hide();
                    if (data.code == 0) {
                        data = data.data;
                        $.each(data, function (i, n) {
                            //console.log(n);
                            thisParent.find('ul').append(cloneLiBox.clone());
                            var oLi = thisParent.find('li').last();
                            oLi.find('.date').text(n.create_time);
                            oLi.find('.content').html(n.content);


                        });
                    }
                }
            });
        });

    });
}

/**
 * 论坛详情交互
 */
function forumItemJs(){
    /**关注用户**/
    $(".follow-btn a").on('click', function () {
        var oThis = $(this);
        var oStatus = oThis.data('status');
        var userId = oThis.data('user');
        if(isLogin() == false || oStatus == '1'){
            return;
        }

        oThis.data('status', 1);
        ajax(getHttpUrl(), {
            'data': {'user_id':userId, '_format_':'fans'},
            'success': function (data) {
                oThis.data('status', 0);
                if(data.code == 0){
                    oThis.addClass('active').text('已关注');
                    return;
                }
                layer.tips(data.msg, oThis, {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
            }


        })


    });
    /**点赞**/
    $("#forumPraiseBtn").on('click', function () {
        var oThis = $(this);
        var oStatus = oThis.data('status');
        var oNum = oThis.find('.number').text();
        oNum = oNum?parseInt(oNum):0;
        if(isLogin() == false || oStatus == '1'){
            return;
        }
        oThis.data('status', 1);

        ajax( getHttpUrl(),{
            'data': {'_format_':'praise'},
            'success': function (data) {
                oThis.data('status', 0);
                if(data.code == 0){
                    oThis.find('.number').text(oNum + 1);
                    layer.tips('谢谢，你的点赞!!!', oThis, {
                        tips: [1, '#0FA6D8'] //还可配置颜色
                    });
                    return;
                }
                layer.tips(data.msg, oThis, {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
            }
        });

    });
    /**收藏**/
    $(".collectionBtn").on('click', function () {
        var oThis = $(this);
        var oId = oThis.data('id');
        var oStatus = oThis.data('status');
        if(isLogin() == false || oStatus == '1'){
            return;
        }
        ajax(getHttpUrl(), {
            'data': {'id':oId, '_format_':'collect'},
            'success': function (data) {
                oThis.data('status', 0);
                if(data.code == 0){
                    layer.tips(data.msg, oThis, {
                        tips: [1, '#0FA6D8'] //还可配置颜色
                    });
                    return;
                }
                layer.tips(data.msg, oThis, {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
            }
        });
    });
    /**评论内容**/
    $("#forumCommentTextBtn").on('focus', function () {
        if(isLogin() == false){
            return;
        }
    });
    /**提交评论**/
    $("#forumCommentSubmitBtn").on('click', function () {
        if(isLogin() == false){
            return;
        }
        var oThis = $(this);
        var thisParent = oThis.parent().parent();
        var oStatus = oThis.data('status');
        var thisTextArea = thisParent.find('input[name="content"]');
        var oContent =  thisTextArea.val();
        if(oStatus == '1'){
            return;
        }
        if(oContent == ''){
            thisTextArea.focus();
            return;
        }
        oThis.data('status', 1);
        ajax( getHttpUrl(),{
            'data': {'content': oContent, '_format_':'comment'},
            'success': function (data) {
                oThis.data('status', 0);
                if(data.code == 0){
                    layer.msg('评论成功');
                    thisTextArea.val('');
                    var thisListBox = $("#commentListBox");
                    var thisInline = thisListBox.find('.comment-list-inline').first();
                    thisListBox.prepend(thisInline.clone());
                    thisInline = thisListBox.find('.comment-list-inline').first();
                    var thisMain = thisInline.find('.content-main');
                    var userData = isLogin(1);
                    thisMain.find('.user-avatar img').attr('src', userData.avatar['50']);
                    thisMain.find('.user-name').text(userData.name);
                    thisMain.find('.to-day').text('刚刚');
                    thisMain.find('.top-num').text('');
                    thisMain.find('.tread-num').text('');
                    thisMain.find('.comment-content').html(oContent);
                    thisMain.find('a.comment-reply').data('reply', userData.id);
                    thisMain.find('a.comment-reply').data('reply-name', userData.name);


                    thisInline.removeClass('box-hide');
                    thisInline.show();
                    thisListBox.find('.comment-list-inline.box-hide').remove();
                    thisInline.find('.comment-reply-list li.content-list-inline').first().addClass('box-hide').siblings('li.content-list-inline').remove();
                    thisInline.find('.comment-reply-list').hide();

                    var newsComment = $("#newsCommentListBox");
                    var countNum = newsComment.find('.comment-count').text();
                    newsComment.find('.comment-count').text(parseInt(countNum) + 1);
                    newsComment.show();
                }
            }
        });

    });

    /**
     * 回复窗块
     */
    $(".forum-item-comment").on('click', 'a.comment-reply', function () {
        if(isLogin() == false){
            return;
        }
        var oThis = $(this);
        var replyUserid = oThis.data('reply');
        var replyUserName = oThis.data('reply-name');
        var parentId = oThis.data('parent');
        var thisReplyComment = $('#reply-comment-post');
        if(isLogin(1).id == replyUserid){
            layer.tips('不允许回复自己的哦！', oThis, {
                tips: [1, '#0FA6D8'] //还可配置颜色
            });
            return;
        }
        var replyBox = '<div class="flex-between flex-align-stretch flex-align-center" id="reply-comment-post">' +
            '<div class="flex-between flex-align-stretch flex-align-center input">' +
            '<input type="text" name="content" placeholder="回复：'+ replyUserName +'">' +
            '<a href="javascript:void(0);" class="flex-center flex-align-center expr"><i class="b-img"></i></a>' +
            '</div>' +
            '<div class="submit">' +
            '<a href="javascript:void(0);" data-status="0" data-parent="'+ parentId +'" data-reply="'+ replyUserid +'"  data-reply-name="'+ replyUserName +'">发布</a>' +
            '</div>' +
            '</div>';
        thisReplyComment.remove();
        oThis.after(replyBox);

        $("#reply-comment-post .submit a").on('click', function () {
            if(isLogin() == false){
                return;
            }
            var oThis = $(this);
            var thisReplyContent = oThis.parent().parent().find('input[name="content"]');
            var replyUserid = oThis.data('reply');
            var replyUserName = oThis.data('reply-name');
            var parentId = oThis.data('parent');
            var oStatus = oThis.data('status');
            var content = thisReplyContent.val();
            if(oStatus == '1'){
                return;
            }
            if(content == ''){
                thisReplyContent.focus();
                return;
            }
            oThis.data('status', 1);
            ajax( getHttpUrl(),{
                'data': {'content':content, 'parent':parentId, 'reply_id':replyUserid,  '_format_':'reply_comment'},
                'success': function (data) {
                    oThis.data('status', 0);
                    if(data.code == 0){
                        layer.msg('回复评论成功');
                        thisReplyContent.val('');
                        var topThis = oThis.parent().parent().parent().parent().parent();
                        $("#reply-comment-post").remove();
                        console.log(topThis.html());
                        var oListBox = topThis.find('.comment-reply-list');
                        var oInline = oListBox.find('li.content-list-inline').first();

                        oListBox.prepend(oInline.clone());
                        oInline = oListBox.find('li.content-list-inline').first();

                        var userData = isLogin(1);
                        oInline.find('.user-avatar img').attr('src', userData.avatar['50']);
                        oInline.find('.user-name.main').text(userData.name);
                        oInline.find('.user-name.reply-user-name').text(userData.replyUserName);
                        oInline.find('.to-day').text('刚刚');
                        oInline.find('.top-num').text('');
                        oInline.find('.tread-num').text('');
                        oInline.find('.comment-content').html(content);
                        oInline.find('a.comment-reply').data('reply', userData.id);
                        oInline.find('a.comment-reply').data('reply-name', userData.name);

                        oInline.removeClass('box-hide');
                        oInline.show();
                        oListBox.show();
                        oListBox.find('li.content-list-inline.box-hide').remove();
                    }
                }
            });
        });
    });
    /**
     * 评论赞
     */
    $(".forum-item-comment").on('click', 'a.comment-praise', function () {
        if(isLogin() == false){
            return;
        }
        var oThis = $(this);
        var oStatus = oThis.data('status');
        var oComment = oThis.data('id');
        var oUser = oThis.data('user');
        var thisNum = oThis.find('.num');
        var oNum = thisNum.text();
        var userData = isLogin(1);
        oNum = oNum?parseInt(oNum):0;
        if(oUser == '' || userData.id == oUser || oStatus == '1'){
            return ;
        }

        oThis.data('status', 1);
        ajax( getHttpUrl(), {
            'data': {'id': oComment, '_format_': 'comment_praise'},
            'success': function (data) {
                oThis.data('status', 0);
                if (data.code == 0) {
                    thisNum.text(oNum + 1);
                }
            }
        });

    });
    /**
     * 评论踏
     */
    $(".forum-item-comment").on('click', 'a.comment-tread', function () {
        if(isLogin() == false){
            return;
        }
        var oThis = $(this);
        var oStatus = oThis.data('status');
        var oComment = oThis.data('id');
        var oUser = oThis.data('user');
        var thisNum = oThis.find('.num');
        var oNum = thisNum.text();
        var userData = isLogin(1);
        oNum = oNum?parseInt(oNum):0;
        if(oUser == '' || userData.id == oUser || oStatus == '1'){
            return ;
        }

        oThis.data('status', 1);
        ajax( getHttpUrl(), {
            'data': {'id': oComment, '_format_': 'comment_tread'},
            'success': function (data) {
                oThis.data('status', 0);
                if (data.code == 0) {
                    thisNum.text(oNum + 1);
                }
            }
        });

    });



}




/**
 * 登陆弹窗
 */
function loginPopup() {
    var url = $('#login_url').val();
    commonWindow(url, 400, 500);
}

/**
 * 注册弹窗
 */
function registerPopup() {
    var url = $('#register_url').val();
    commonWindow(url, 400, 400);
}

/**
 * 窗口
 * @param url
 */
function commonWindow(url, wWidth, wHeight) {
    layer.open({
        type: 2,
        area: [wWidth + 'px', wHeight + 'px'],
        title: false,
        content: [url, 'no'],
        scrollbar: false,
    });
}

/**
 * 倒计时
 * @param  obj  放置倒计时的元素
 * @param  time  时间
 */
function countDown(obj, time){
    var t = time,
        timer = null,
        text = obj.text();
    clearInterval(timer);
    timer = setInterval(function(){
        if(t == 0){
            clearInterval(timer);
            obj.data('send', 0);
            obj.text(text);
            t = time;
        }else{
            obj.data('send', 1);
            obj.text(t + 's');
            t--;
        }
    },1000);
}

/**
 * 发送请求
 * @param url
 * @param parameter
 */
function ajax(url, parameter) {
    var parameter_defaults = {
        'data': {},
        'type': 'POST',
        'process': true,
        'content': 'application/x-www-form-urlencoded',
        'beforeSend': function () {

        },
        'dataFilter': function () {
            
        },
        'success': function (data) {
            console.log(data);
        },
        'error': function () {
            
        },
        'dataType':'json'
    };
    var config = $.extend({}, parameter_defaults, parameter);

    $.ajax({
        type: config.type,
        url: url,
        data: config.data,
        cache: false,
        contentType: config.content,
        processData: config.process,
        dataType: config.dataType,
        success: function(data){
            config.success(data);
        }
    });
}

/**
 * 当前URL
 * @returns {string}
 */
function getHttpUrl() {
    return self.location.href;
}

/**
 * 检测登陆状态
 * @param result
 */
function isLogin(result) {
    var data = $.cookie('yutou_www_user');
    //console.log(data);
    data = data?$.parseJSON(data):'';
    if(result){
        return data;
    }
    if(!data.id){
        loginPopup();
        return false;
    }
    else{
        return true;
    }
}

/**
 * 上传文件
 * @param btn
 * @param obj
 */
function uploadFile(btn, obj){
    //console.log('uploadFile');
    var oThis =  $('#' + btn);
    var obj_defaults = {
        'url': '',
        'size': 1,
        'files': 'files',
        'ext': 'jpg,png,gif,ico',
        'repeat' : false,
        'ctrl': false,
        'FilesAdded': function (up, files) {
            uploader.start();
        },
        'UploadProgress': function (up, file) {

        },
        'FileUploaded': function (up, file, info) {
            console.log(info);
        },
        'Error': function (up, err) {
            layer.msg(err.message);
        }
    };
    var config = $.extend({}, obj_defaults, obj);
    if (config.url == ''){
        config.url = oThis.data('url');
    }
    var uploader = new plupload.Uploader({
        runtimes: 'html5,flash,silverlight,html4',
        browse_button: btn,
        url: config.url,
        flash_swf_url: '/static/www/js/extend/plupload/Moxie.swf',
        silverlight_xap_url: '/static/www/js/extend/plupload/Moxie.xap',
        filters: {
            max_file_size: config.size * 1024 + 'kb',
            prevent_duplicates : config.repeat,
            mime_types: [
                {title: config.files, extensions: config.ext}
            ]
        },
        multi_selection: config.ctrl,
        init: {
            FilesAdded: function(up, files) {
                config.FilesAdded(up, files);
            },
            UploadProgress: function(up, file) {
                config.UploadProgress(up, file);
            },
            FileUploaded: function(up, file, info) {
                config.FileUploaded(up, file, info);
            },
            Error: function(up, err) {
                config.Error(up, err);
            }
        }
    });

    uploader.init();
}

/**
 * 上传帖子内容图片
 * @param summernote
 * @param file
 * @param loadUrl
 */
function sendForumImage(summernote, file, loadUrl) {
    var formData = new FormData();
    formData.append("file", file);
    ajax(loadUrl,{
        'data':formData,
        'content': false,
        'process': false,
        'success': function (data) {
            if(data.code == 0){
                data = data.data;
                summernote.summernote('insertImage', data.image_url, function ($image) {
                    $image.attr('src', data.image_url);
                });
                return;
            }
            layer.msg(data.msg);
        }
    });
}
/**
 * 验证手机
 * @param input
 * @returns {boolean}
 */
function telMatch(input) {
    var regex = /^((\+)?86|((\+)?86)?)0?1[3458]\d{9}$|^(((0\d2|0\d{2})[- ]?)?\d{8}|((0\d3|0\d{3})[- ]?)?\d{7})(-\d{3})?$/;
    if (input.match(regex)) {
        console.log('true');
        return true;
    } else {
        console.log('false');
        return false;
    }
}


$.fn.serializeObject = function(){
    var hasOwnProperty = Object.prototype.hasOwnProperty;
    return this.serializeArray().reduce(function(data,pair){
        if(!hasOwnProperty.call(data,pair.name)){
            data[pair.name]=pair.value;
        }
        return data;
    },{});
};

$.fn.share = function (){
    var oThis = $(this);
    var options = {};
    options['title'] = oThis.data('title');
    options['url'] = oThis.data('link');
    options['pic'] = oThis.data('img');

    var api = {};
    api['sina'] = 'http://service.weibo.com/share/share.php?url={url}&title={title}&pic={pic}&searchPic=false';
    api['qq'] = 'https://connect.qq.com/widget/shareqq/iframe_index.html?url={url}&showcount=0&desc={content}&summary=&title={title}&pics={pic}&style=203&width=19&height=22';
    api['douban'] = 'http://www.douban.com/share/service?href={url}&name={title}&text={content}&image={pic}';

    var defaults = {
        url: window.location.href,
        title: document.title,
        content: '',
        pic: ''
    };

    oThis.on('click', 'a', function () {
        var aThis = $(this);
        var oType = aThis.data('type');
        var aTitle = aThis.parent().data('title');
        var aLink = aThis.parent().data('link');
        var aImg = aThis.parent().data('img');
        if(aTitle){
            options['title'] = aTitle;
            options['url'] = 'http://' + document.domain + aLink;
            options['pic'] = aImg;
        }
        //console.log(oType);
        switch(oType)
        {
            case 'sina':
                var _shareUrl = replaceAPI(api['sina']);
                winOpen(_shareUrl, 230+490, 512);
                break;
            case 'douban':
                var _shareUrl = replaceAPI(api['douban']);
                winOpen(_shareUrl, 230+490, 512);
                break;
            case 'qq':
                var _shareUrl = replaceAPI(api['qq']);
                commonWindow(_shareUrl, 230+490, 512);
                break;

            case 'wechat':
                if($('#qrcodeShow').length == 0){
                    $('body').append('<div id="qrcodeShow" style="display: none;padding:15px;text-align: center;">' +
                        '<div id="qrcodeShowImg"></div>' +
                        '<div style="margin-top:15px;font-size: 14px;">微信扫一扫 右上角"..."分享</div></div>');
                }else{
                    $("#qrcodeShowImg").html('');
                }
                var qrcode = new QRCode('qrcodeShowImg', {
                    text: options['url'],
                    width: 256,
                    height: 256,
                    colorDark: '#000000',
                    colorLight: '#ffffff',
                    correctLevel: QRCode.CorrectLevel.L
                });
                layer.open({
                    type: 1,
                    //shade: true,
                    title: false, //不显示标题
                    content: $('#qrcodeShow'),
                    scrollbar: false,
                    cancel: function(){}
                });
                break;
            default: ;
        }

    });

    //打开分享窗口
    function winOpen(urlApi, iWidth, iHeight) {
        var iTop = (window.screen.availHeight - 30 - iHeight) / 2;
        //获得窗口的水平位置
        var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;
        window.open(urlApi, '_blank', 'height='+iHeight+', width='+iWidth+',top = '+iTop+',left ='+iLeft+', toolbar=no,scrollbars=no,menubar=no,status=no');
    }

    function replaceAPI (api) {
        resultOptions();
        api = api.replace('{url}', encodeURIComponent(options.url));
        api = api.replace('{title}', encodeURIComponent(options.title));
        api = api.replace('{content}', encodeURIComponent(options.content));
        api = api.replace('{pic}', encodeURIComponent(options.pic));

        return api;
    }

    function resultOptions() {
        $.each(['url','title','content','pic'], function (i,n) {
            if(!options[n]){
                options[n] = defaults[n];
            }
        });
    }


};