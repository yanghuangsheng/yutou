function indexJS(){var b,a=$("#indexNewsList");a.find(".news-tab li").on("click",function(){var b=$(this),c=b.index();b.addClass("child"),b.siblings().removeClass("child"),a.find(".news-content .news-list").eq(c).show().siblings().hide()}),b=$("#newsContentBox"),b.find("a.loadNewsBtn").on("click",function(){var a=$(this),b=parseInt(a.data("page"))+1,c=a.data("status"),d=a.data("start"),e=a.data("category"),f=a.parent().parent(),g=f.find("li").last();"1"!=c&&(a.data("status",1),a.prev().show(),setTimeout(function(){ajax(getHttpUrl(),{data:{page:b,start_id:d,category_id:e,_format_:"news"},type:"GET",success:function(c){a.data("status",0),a.data("page",b),a.prev().hide(),0==c.code&&(c=c.data,$.each(c,function(a,b){var c,d,e;f.find("ul").append(g.clone()),c=f.find("li").last(),d=c.find(".image a").attr("href"),e=d.match(/\d+\b/),d=d.replace(e,b.id),c.find(".image a").attr("href",d),c.find("p.title a").attr("href",d),c.find(".image img").attr("src",b.image_url),c.find("p.title a").html(b.title),c.find("p.description").html(b.description),c.find("p.author-name").html(b.author?b.author:b.source_name),c.find(".read span").text(b.browse_num?b.browse_num:"0"),c.find(".comment span").text(b.comment_num?b.comment_num:"0"),c.find(".collection span").text(b.collect_num?b.collect_num:"0")}))},error:function(){}})},1e3))})}function searchJs(){var a=$("#searchContentBox");a.find("a.loadSearchBtn").on("click",function(){var a=$(this),b=parseInt(a.data("page"))+1,c=a.data("q"),d=a.data("status"),e=a.data("start"),f=a.parent().parent(),g=f.find("li").last();"1"!=d&&(a.data("status",1),a.prev().show(),setTimeout(function(){ajax(getHttpUrl(),{data:{page:b,start_id:e,q:c,_format_:"json"},type:"GET",success:function(c){a.data("status",0),a.data("page",b),a.prev().hide(),0==c.code&&(c=c.data,$.each(c,function(a,b){var c,d,e;f.find("ul").append(g.clone()),c=f.find("li").last(),d=c.find(".image a").attr("href"),e=d.match(/\d+\b/),d=d.replace(e,b.id),c.find(".image a").attr("href",d),c.find("p.title a").attr("href",d),c.find(".image img").attr("src",b.image_url),c.find("p.title a").html(b.title),c.find("p.description").html(b.description),c.find("p.author-name").html(b.author?b.author:b.source_name),c.find(".read span").text(b.browse_num?b.browse_num:"0"),c.find(".comment span").text(b.comment_num?b.comment_num:"0"),c.find(".collection span").text(b.collect_num?b.collect_num:"0")}))},error:function(){}})},1e3))})}function newsItemJs(){$("#newsPraiseBtn").on("click",function(){var a=$(this),b=a.data("status"),c=a.find(".number").text();c=c?parseInt(c):0,0!=isLogin()&&"1"!=b&&(a.data("status",1),ajax(getHttpUrl(),{data:{_format_:"praise"},success:function(b){return a.data("status",0),0==b.code?(a.find(".number").text(c+1),layer.tips("谢谢，你的点赞!!!",a,{tips:[1,"#0FA6D8"]}),void 0):(layer.tips(b.msg,a,{tips:[1,"#0FA6D8"]}),void 0)}}))}),$("#commentTextBtn").on("focus",function(){0==isLogin()}),$("#commentLoginBtn").on("click",function(){isLogin()}),$("#commentSubmitBtn").on("click",function(){var a,b,c,d,e;if(0!=isLogin()&&(a=$(this),b=a.parent().parent().parent(),c=a.data("status"),d=b.find("textarea"),e=d.val(),"1"!=c)){if(""==e)return d.focus(),void 0;a.data("status",1),ajax(getHttpUrl(),{data:{content:e,_format_:"comment"},success:function(b){var c,f,g,h,i,j;a.data("status",0),0==b.code&&(layer.msg("评论成功"),d.val(""),c=$("#commentListBox"),f=c.find(".comment-list-inline").first(),c.prepend(f.clone()),f=c.find(".comment-list-inline").first(),g=f.find(".content-main"),h=isLogin(1),g.find(".user-avatar img").attr("src",h.avatar["50"]),g.find(".user-name").text(h.name),g.find(".to-day").text("刚刚"),g.find(".top-num").text(""),g.find(".tread-num").text(""),g.find(".comment-content").html(e),g.find("a.comment-reply").data("reply",h.id),g.find("a.comment-reply").data("reply-name",h.name),f.removeClass("box-hide"),f.show(),c.find(".comment-list-inline.box-hide").remove(),f.find(".comment-reply-list li.content-list-inline").first().addClass("box-hide").siblings("li.content-list-inline").remove(),f.find(".comment-reply-list").hide(),i=$("#newsCommentListBox"),j=i.find(".comment-count").text(),i.find(".comment-count").text(parseInt(j)+1),i.show())}})}}),$(".news-item-comment").on("click","a.comment-reply",function(){var a,b,c,d,e,f;if(0!=isLogin()){if(a=$(this),b=a.data("reply"),c=a.data("reply-name"),d=a.data("parent"),e=$("#reply-comment-post"),isLogin(1).id==b)return layer.tips("不允许回复自己的哦！",a,{tips:[1,"#0FA6D8"]}),void 0;f='<div class="flex-between flex-align-stretch flex-align-center" id="reply-comment-post"><div class="flex-between flex-align-stretch flex-align-center input"><input type="text" name="content" placeholder="回复：'+c+'">'+'<a href="javascript:void(0);" class="flex-center flex-align-center expr"><i></i></a>'+"</div>"+'<div class="submit">'+'<a href="javascript:void(0);" data-status="0" data-parent="'+d+'" data-reply="'+b+'"  data-reply-name="'+c+'">发布</a>'+"</div>"+"</div>",e.remove(),a.after(f),$("#reply-comment-post .submit a").on("click",function(){var a,b,c,e,f,g;if(0!=isLogin()&&(a=$(this),b=a.parent().parent().find('input[name="content"]'),c=a.data("reply"),a.data("reply-name"),e=a.data("parent"),f=a.data("status"),g=b.val(),"1"!=f)){if(""==g)return b.focus(),void 0;a.data("status",1),ajax(getHttpUrl(),{data:{content:g,parent:e,reply_id:c,_format_:"reply_comment"},success:function(c){var d,e,f,h;a.data("status",0),0==c.code&&(layer.msg("回复评论成功"),b.val(""),d=a.parent().parent().parent().parent().parent(),$("#reply-comment-post").remove(),console.log(d.html()),e=d.find(".comment-reply-list"),f=e.find("li.content-list-inline").first(),e.prepend(f.clone()),f=e.find("li.content-list-inline").first(),h=isLogin(1),f.find(".user-avatar img").attr("src",h.avatar["50"]),f.find(".user-name.main").text(h.name),f.find(".user-name.reply-user-name").text(h.replyUserName),f.find(".to-day").text("刚刚"),f.find(".top-num").text(""),f.find(".tread-num").text(""),f.find(".comment-content").html(g),f.find("a.comment-reply").data("reply",h.id),f.find("a.comment-reply").data("reply-name",h.name),f.removeClass("box-hide"),f.show(),e.show(),e.find("li.content-list-inline.box-hide").remove())}})}})}}),$(".news-item-comment").on("click","a.comment-praise",function(){var a,b,c,d,e,f,g;0!=isLogin()&&(a=$(this),b=a.data("status"),c=a.data("id"),d=a.data("user"),e=a.find(".num"),f=e.text(),g=isLogin(1),f=f?parseInt(f):0,""!=d&&g.id!=d&&"1"!=b&&(a.data("status",1),ajax(getHttpUrl(),{data:{id:c,_format_:"comment_praise"},success:function(b){a.data("status",0),0==b.code&&e.text(f+1)}})))}),$(".news-item-comment").on("click","a.comment-tread",function(){var a,b,c,d,e,f,g;0!=isLogin()&&(a=$(this),b=a.data("status"),c=a.data("id"),d=a.data("user"),e=a.find(".num"),f=e.text(),g=isLogin(1),f=f?parseInt(f):0,""!=d&&g.id!=d&&"1"!=b&&(a.data("status",1),ajax(getHttpUrl(),{data:{id:c,_format_:"comment_tread"},success:function(b){a.data("status",0),0==b.code&&e.text(f+1)}})))})}function forumJs(){var b,a=$("#indexForumList");a.find(".list-tab li").on("click",function(){var b=$(this),c=b.index();b.addClass("child"),b.siblings().removeClass("child"),a.find(".content-list .list-inline").eq(c).show().siblings().hide()}),b=$("#forumContentBox"),b.find("a.loadForumBtn").on("click",function(){var a=$(this),b=parseInt(a.data("page"))+0,c=a.data("status"),d=a.data("start"),e=a.data("type"),f=a.parent().parent(),g=f.find("li").last();"1"!=c&&(a.data("status",1),a.prev().show(),setTimeout(function(){ajax(getHttpUrl(),{data:{page:b,start_id:d,type:e,_format_:"post"},type:"GET",success:function(c){a.data("status",0),a.data("page",b),a.prev().hide(),0==c.code&&(c=c.data,$.each(c,function(a,b){var c,d,e,h;f.find("ul").append(g.clone()),c=f.find("li").last(),d=c.find(".title a").attr("href"),e=d.match(/\d+\b/),d=d.replace(e,b.id),c.find(".content-all").hide(),c.find(".content-all").siblings().show(),c.find(".content-body").html(""),c.find(".content-all-end date").text("发布于 "+b.create_time),c.find(".look-all").attr("data-id",b.id),c.find("a.link").attr("href",d),c.find(".title a").html(b.title),c.find(".read span").text(b.browse_num?b.browse_num:"0"),c.find(".content-images").html(""),c.find(".description").html(b.description),$.each(b.image_url,function(a,b){c.find(".content-images").append('<p><a href="'+d+'" class="link">'+'<img src="'+b+'" alt="">'+"</a>"+"</p>")}),c.find(".fabulous span").text(b.praise_num?b.praise_num:"0"),c.find(".comment span").text(b.comment_num?b.comment_num:"0"),c.find(".collection span").text(b.collect_num?b.collect_num:"0"),c.find(".user-avatar img").attr("src",b.user_avatar[50]),c.find(".user-name").text(b.user_name),c.find(".showUserInfo").attr("data-id",b.user_id),h=c.find(".showUserInfo").attr("data-home"),c.find(".showUserInfo").attr("data-home",h.replace(h.match(/\d+\b/),b.user_id)),c.find(".user-share").attr("data-tile",b.title).attr("data-link",d).share()}))},error:function(){}})},1e3))}),b.on("click","a.look-all",function(){var a=$(this),b=a.data("id"),c=a.parent().parent().find(".content-all");""==c.find(".content-body").html()&&ajax(getHttpUrl(),{data:{id:b,_format_:"item"},type:"GET",success:function(a){0==a.code&&c.find(".content-body").html(a.data)}}),c.toggle(),c.siblings().toggle()}),b.on("click","a.look-no",function(){var a=$(this),b=a.parent().parent();b.toggle(),b.siblings().toggle()})}function userJs(){var b,c,a=$("#userForumContentBox");a.find("a.loadUserForumBtn").on("click",function(){var a=$(this),b=parseInt(a.data("page"))+1,c=a.data("status"),d=a.data("start"),e=a.parent().parent(),f=e.find("li").last();"1"!=c&&(a.data("status",1),a.prev().show(),setTimeout(function(){ajax(getHttpUrl(),{data:{page:b,start_id:d,_format_:"post_list"},type:"GET",success:function(c){a.data("status",0),a.data("page",b),a.prev().hide(),0==c.code&&(c=c.data,$.each(c,function(a,b){var c,d,g;e.find("ul").append(f.clone()),c=e.find("li").last(),d=c.find(".title a").attr("href"),g=d.match(/\d+\b/),d=d.replace(g,b.id),c.find(".content-all").hide(),c.find(".content-all").siblings().show(),c.find(".content-body").html(""),c.find(".content-all-end date").text("发布于 "+b.create_time),c.find(".look-all").attr("data-id",b.id),c.find("a.link").attr("href",d),c.find(".title a").html(b.title),c.find(".read span").text(b.browse_num?b.browse_num:"0"),c.find(".content-images").html(""),c.find(".description").html(b.description),$.each(b.image_url,function(a,b){c.find(".content-images").append('<p><a href="'+d+'" class="link">'+'<img src="'+b+'" alt="">'+"</a>"+"</p>")}),c.find(".fabulous span").text(b.praise_num?b.praise_num:"0"),c.find(".comment span").text(b.comment_num?b.comment_num:"0"),c.find(".collection span").text(b.collect_num?b.collect_num:"0"),c.find(".user-avatar img").attr("src",b.user_avatar[50]),c.find(".user-name").text(b.user_name)}))},error:function(){}})},1e3))}),a.on("click","a.look-all",function(){var a=$(this),b=a.data("id"),c=a.data("url"),d=a.parent().parent().find(".content-all");""==d.find(".content-body").html()&&ajax(c,{data:{id:b,_format_:"item"},type:"GET",success:function(a){0==a.code&&d.find(".content-body").html(a.data)}}),d.toggle(),d.siblings().toggle()}),a.on("click","a.look-no",function(){var a=$(this),b=a.parent().parent();b.toggle(),b.siblings().toggle()}),b=$("#userCollectList"),b.find(".collect-tab li").on("click",function(){var a=$(this),c=a.index();a.addClass("child"),a.siblings().removeClass("child"),b.find(".collect-content .list-inline").eq(c).show().siblings().hide()}),b.on("click","a.delBtn",function(){var a=$(this),b=a.data("type"),c=a.data("id"),d=a.data("status");"1"!=d&&layer.confirm("确定删除吗？",{icon:3,title:!1,closeBtn:!1},function(d){a.data("status",1),ajax(getHttpUrl(),{data:{id:c,_format_:"del_collect"},type:"GET",success:function(c){return a.data("status",0),0==c.code?"news"==b?(a.parent().parent().remove(),layer.close(d),void 0):(a.parent().remove(),layer.close(d),void 0):void 0}})})}),b.find("a.loadCollectNewsBtn").on("click",function(){var a=$(this),b=parseInt(a.data("page"))+1,c=a.data("status"),d=a.data("start"),e=a.data("user"),f=a.parent().parent(),g=f.find("li").last();"1"!=c&&(a.data("status",1),a.prev().show(),setTimeout(function(){ajax(getHttpUrl(),{data:{page:b,start_id:d,user_id:e,_format_:"news_list"},type:"GET",success:function(c){a.data("status",0),a.data("page",b),a.prev().hide(),0==c.code&&(c=c.data,$.each(c,function(a,b){var c,d,e;f.find("ul").append(g.clone()),c=f.find("li").last(),d=c.find(".image a").attr("href"),e=d.match(/\d+\b/),d=d.replace(e,b.id),c.find(".image a").attr("href",d),c.find("p.title a").attr("href",d),c.find(".image img").attr("src",b.image_url),c.find("p.title a").html(b.title),c.find("p.description").html(b.description),c.find(".date").text(b.create_time+" 收藏"),c.find("a.delBtn").attr("data-id",b.id),c.find(".read span").text(b.browse_num?b.browse_num:"0"),c.find(".comment span").text(b.comment_num?b.comment_num:"0"),c.find(".collection span").text(b.collect_num?b.collect_num:"0")}))},error:function(){}})},1e3))}),b.find("a.loadCollectPostBtn").on("click",function(){var a=$(this),b=parseInt(a.data("page"))+1,c=a.data("status"),d=a.data("start"),e=a.data("user"),f=a.parent().parent(),g=f.find("li").last();"1"!=c&&(a.data("status",1),a.prev().show(),setTimeout(function(){ajax(getHttpUrl(),{data:{page:b,start_id:d,user_id:e,_format_:"post_list"},type:"GET",success:function(c){a.data("status",0),a.data("page",b),a.prev().hide(),0==c.code&&(c=c.data,$.each(c,function(a,b){var c,d,e,h;f.find("ul").append(g.clone()),c=f.find("li").last(),d=c.find(".title a").attr("href"),e=d.match(/\d+\b/),d=d.replace(e,b.id),c.find(".content-all").hide(),c.find(".content-all").siblings().show(),c.find(".content-body").html(""),c.find(".content-all-end date").text("发布于 "+b.create_time),c.find(".look-all").attr("data-id",b.id),c.find("a.link").attr("href",d),c.find(".title a").html(b.title),c.find(".read span").text(b.browse_num?b.browse_num:"0"),c.find(".content-images").html(""),c.find(".description").html(b.description),$.each(b.image_url,function(a,b){c.find(".content-images").append('<p><a href="'+d+'" class="link">'+'<img src="'+b+'" alt="">'+"</a>"+"</p>")}),c.find(".fabulous span").text(b.praise_num?b.praise_num:"0"),c.find(".comment span").text(b.comment_num?b.comment_num:"0"),c.find(".collection span").text(b.collect_num?b.collect_num:"0"),c.find(".date").text(b.create_time+" 收藏"),c.find("a.delBtn").attr("data-id",b.id),c.find(".user-avatar img").attr("src",b.user_avatar[50]),c.find(".user-name").text(b.user_name),c.find(".showUserInfo").attr("data-id",b.user_id),h=c.find(".showUserInfo").attr("data-home"),c.find(".showUserInfo").attr("data-home",h.replace(h.match(/\d+\b/),b.user_id))}))},error:function(){}})},1e3))}),b.on("click","a.look-all",function(){var a=$(this),b=a.data("id"),c=a.data("url"),d=a.parent().parent().find(".content-all");""==d.find(".content-body").html()&&ajax(c,{data:{id:b,_format_:"item"},type:"GET",success:function(a){0==a.code&&d.find(".content-body").html(a.data)}}),d.toggle(),d.siblings().toggle()}),b.on("click","a.look-no",function(){var a=$(this),b=a.parent().parent();b.toggle(),b.siblings().toggle()}),c=$("#userRemindBox"),c.find(".remind-tab li").on("click",function(){var a=$(this),b=a.index();a.addClass("child"),a.siblings().removeClass("child"),c.find(".remind-content .list-inline").eq(b).show().siblings().hide()}),$("#clearSystemBtn").on("click",function(){var a=$(this),b=a.data("start");ajax(getHttpUrl(),{data:{start_id:b,_format_:"clear_system"},success:function(b){0==b.code&&a.find("span.num-tips").remove()}})}),$("#clearInteractionBtn").on("click",function(){var a=$(this),b=a.data("start");ajax(getHttpUrl(),{data:{start_id:b,_format_:"clear_interaction"},success:function(a){0==a.code&&($("#userRemindBox .remind-tab li:first-child").find("span.num").remove(),$("#userRemindBox .interaction-list").find("i.tips").hide())}})}),c.find("a.loadInteractionBtn").on("click",function(){var a=$(this),b=parseInt(a.data("page"))+1,c=a.data("status"),d=a.data("start"),e=a.parent().parent(),f=e.find("li").last();"1"!=c&&(a.data("status",1),a.prev().show(),setTimeout(function(){ajax(getHttpUrl(),{data:{page:b,start_id:d,_format_:"interaction_list"},type:"GET",success:function(c){a.data("status",0),a.data("page",b),a.prev().hide(),0==c.code&&(c=c.data,$.each(c,function(a,b){var c,d,g;e.find("ul").append(f.clone()),c=e.find("li").last(),b.status?c.find("i.tips").hide():c.find("i.tips").show(),c.find(".user-avatar img").attr("src",b.user_avatar["50"]),c.find(".user-name").text(b.user_name),c.find(".link-txt").text(b.link_txt),c.find(".link-ext").html(b.link_ext),b.parent.praise_num?c.find(".praise").show().find("span").text(b.parent.praise_num):c.find(".praise").hide().find("span").text("0"),b.parent.tread_num?c.find(".tread").show().find("span").text(b.parent.tread_num):c.find(".tread").hide().find("span").text("0"),b.parent.title?c.find(".parent-title").show().text(b.parent.title):c.find(".parent-title").hide().text(""),b.parent.content?c.find(".parent-content").show().find("span.content-text").text(b.parent.title):c.find(".parent-content").hide().find("span.content-text").text(""),b.content?c.find(".user-content-body").show().html(b.content):c.find(".user-content-body").hide().html(""),d=c.find("a.look-btn").attr("href"),g=d.match(/\d+\b/),d=d.replace(g,b.parent.post_id),c.find("a.look-btn").attr("href",d),c.find(".date").text(b.create_time)}))}})}))}),c.find("a.loadSystemBtn").on("click",function(){var a=$(this),b=parseInt(a.data("page"))+1,c=a.data("status"),d=a.data("start"),e=a.parent().parent(),f=e.find("li").last();"1"!=c&&(a.data("status",1),a.prev().show(),setTimeout(function(){ajax(getHttpUrl(),{data:{page:b,start_id:d,_format_:"system_list"},type:"GET",success:function(c){a.data("status",0),a.data("page",b),a.prev().hide(),0==c.code&&(c=c.data,$.each(c,function(a,b){e.find("ul").append(f.clone());var c=e.find("li").last();c.find(".date").text(b.create_time),c.find(".content").html(b.content)}))}})}))})}function forumItemJs(){$(".follow-btn a").on("click",function(){var a=$(this),b=a.data("status"),c=a.data("user");0!=isLogin()&&"1"!=b&&(a.data("status",1),ajax(getHttpUrl(),{data:{user_id:c,_format_:"fans"},success:function(b){return a.data("status",0),0==b.code?(a.addClass("active").text("已关注"),void 0):(layer.tips(b.msg,a,{tips:[1,"#0FA6D8"]}),void 0)}}))}),$("#forumPraiseBtn").on("click",function(){var a=$(this),b=a.data("status"),c=a.find(".number").text();c=c?parseInt(c):0,0!=isLogin()&&"1"!=b&&(a.data("status",1),ajax(getHttpUrl(),{data:{_format_:"praise"},success:function(b){return a.data("status",0),0==b.code?(a.find(".number").text(c+1),layer.tips("谢谢，你的点赞!!!",a,{tips:[1,"#0FA6D8"]}),void 0):(layer.tips(b.msg,a,{tips:[1,"#0FA6D8"]}),void 0)}}))}),$(".collectionBtn").on("click",function(){var a=$(this),b=a.data("id"),c=a.data("status");0!=isLogin()&&"1"!=c&&ajax(getHttpUrl(),{data:{id:b,_format_:"collect"},success:function(b){return a.data("status",0),0==b.code?(layer.tips(b.msg,a,{tips:[1,"#0FA6D8"]}),void 0):(layer.tips(b.msg,a,{tips:[1,"#0FA6D8"]}),void 0)}})}),$("#forumCommentTextBtn").on("focus",function(){0==isLogin()}),$("#forumCommentSubmitBtn").on("click",function(){var a,b,c,d,e;if(0!=isLogin()&&(a=$(this),b=a.parent().parent(),c=a.data("status"),d=b.find('input[name="content"]'),e=d.val(),"1"!=c)){if(""==e)return d.focus(),void 0;a.data("status",1),ajax(getHttpUrl(),{data:{content:e,_format_:"comment"},success:function(b){var c,f,g,h,i,j;a.data("status",0),0==b.code&&(layer.msg("评论成功"),d.val(""),c=$("#commentListBox"),f=c.find(".comment-list-inline").first(),c.prepend(f.clone()),f=c.find(".comment-list-inline").first(),g=f.find(".content-main"),h=isLogin(1),g.find(".user-avatar img").attr("src",h.avatar["50"]),g.find(".user-name").text(h.name),g.find(".to-day").text("刚刚"),g.find(".top-num").text(""),g.find(".tread-num").text(""),g.find(".comment-content").html(e),g.find("a.comment-reply").data("reply",h.id),g.find("a.comment-reply").data("reply-name",h.name),f.removeClass("box-hide"),f.show(),c.find(".comment-list-inline.box-hide").remove(),f.find(".comment-reply-list li.content-list-inline").first().addClass("box-hide").siblings("li.content-list-inline").remove(),f.find(".comment-reply-list").hide(),i=$("#newsCommentListBox"),j=i.find(".comment-count").text(),i.find(".comment-count").text(parseInt(j)+1),i.show())}})}}),$(".forum-item-comment").on("click","a.comment-reply",function(){var a,b,c,d,e,f;if(0!=isLogin()){if(a=$(this),b=a.data("reply"),c=a.data("reply-name"),d=a.data("parent"),e=$("#reply-comment-post"),isLogin(1).id==b)return layer.tips("不允许回复自己的哦！",a,{tips:[1,"#0FA6D8"]}),void 0;f='<div class="flex-between flex-align-stretch flex-align-center" id="reply-comment-post"><div class="flex-between flex-align-stretch flex-align-center input"><input type="text" name="content" placeholder="回复：'+c+'">'+'<a href="javascript:void(0);" class="flex-center flex-align-center expr"><i></i></a>'+"</div>"+'<div class="submit">'+'<a href="javascript:void(0);" data-status="0" data-parent="'+d+'" data-reply="'+b+'"  data-reply-name="'+c+'">发布</a>'+"</div>"+"</div>",e.remove(),a.after(f),$("#reply-comment-post .submit a").on("click",function(){var a,b,c,e,f,g;if(0!=isLogin()&&(a=$(this),b=a.parent().parent().find('input[name="content"]'),c=a.data("reply"),a.data("reply-name"),e=a.data("parent"),f=a.data("status"),g=b.val(),"1"!=f)){if(""==g)return b.focus(),void 0;a.data("status",1),ajax(getHttpUrl(),{data:{content:g,parent:e,reply_id:c,_format_:"reply_comment"},success:function(c){var d,e,f,h;a.data("status",0),0==c.code&&(layer.msg("回复评论成功"),b.val(""),d=a.parent().parent().parent().parent().parent(),$("#reply-comment-post").remove(),console.log(d.html()),e=d.find(".comment-reply-list"),f=e.find("li.content-list-inline").first(),e.prepend(f.clone()),f=e.find("li.content-list-inline").first(),h=isLogin(1),f.find(".user-avatar img").attr("src",h.avatar["50"]),f.find(".user-name.main").text(h.name),f.find(".user-name.reply-user-name").text(h.replyUserName),f.find(".to-day").text("刚刚"),f.find(".top-num").text(""),f.find(".tread-num").text(""),f.find(".comment-content").html(g),f.find("a.comment-reply").data("reply",h.id),f.find("a.comment-reply").data("reply-name",h.name),f.removeClass("box-hide"),f.show(),e.show(),e.find("li.content-list-inline.box-hide").remove())}})}})}}),$(".forum-item-comment").on("click","a.comment-praise",function(){var a,b,c,d,e,f,g;0!=isLogin()&&(a=$(this),b=a.data("status"),c=a.data("id"),d=a.data("user"),e=a.find(".num"),f=e.text(),g=isLogin(1),f=f?parseInt(f):0,""!=d&&g.id!=d&&"1"!=b&&(a.data("status",1),ajax(getHttpUrl(),{data:{id:c,_format_:"comment_praise"},success:function(b){a.data("status",0),0==b.code&&e.text(f+1)}})))}),$(".forum-item-comment").on("click","a.comment-tread",function(){var a,b,c,d,e,f,g;0!=isLogin()&&(a=$(this),b=a.data("status"),c=a.data("id"),d=a.data("user"),e=a.find(".num"),f=e.text(),g=isLogin(1),f=f?parseInt(f):0,""!=d&&g.id!=d&&"1"!=b&&(a.data("status",1),ajax(getHttpUrl(),{data:{id:c,_format_:"comment_tread"},success:function(b){a.data("status",0),0==b.code&&e.text(f+1)}})))})}function loginPopup(){var a=$("#login_url").val();commonWindow(a,400,500)}function registerPopup(){var a=$("#register_url").val();commonWindow(a,400,400)}function commonWindow(a,b,c){layer.open({type:2,area:[b+"px",c+"px"],title:!1,content:[a,"no"],scrollbar:!1})}function countDown(a,b){var c=b,d=null,e=a.text();clearInterval(d),d=setInterval(function(){0==c?(clearInterval(d),a.data("send",0),a.text(e),c=b):(a.data("send",1),a.text(c+"s"),c--)},1e3)}function ajax(a,b){var c={data:{},type:"POST",process:!0,content:"application/x-www-form-urlencoded",beforeSend:function(){},dataFilter:function(){},success:function(a){console.log(a)},error:function(){},dataType:"json"},d=$.extend({},c,b);$.ajax({type:d.type,url:a,data:d.data,cache:!1,contentType:d.content,processData:d.process,dataType:d.dataType,success:function(a){d.success(a)}})}function getHttpUrl(){return self.location.href}function isLogin(a){var b=$.cookie("yutou_www_user");return b=b?$.parseJSON(b):"",a?b:b.id?!0:(loginPopup(),!1)}function uploadFile(a,b){var f,c=$("#"+a),d={url:"",size:1,files:"files",ext:"jpg,png,gif,ico",repeat:!1,ctrl:!1,FilesAdded:function(){f.start()},UploadProgress:function(){},FileUploaded:function(a,b,c){console.log(c)},Error:function(a,b){layer.msg(b.message)}},e=$.extend({},d,b);""==e.url&&(e.url=c.data("url")),f=new plupload.Uploader({runtimes:"html5,flash,silverlight,html4",browse_button:a,url:e.url,flash_swf_url:"/static/www/js/extend/plupload/Moxie.swf",silverlight_xap_url:"/static/www/js/extend/plupload/Moxie.xap",filters:{max_file_size:1024*e.size+"kb",prevent_duplicates:e.repeat,mime_types:[{title:e.files,extensions:e.ext}]},multi_selection:e.ctrl,init:{FilesAdded:function(a,b){e.FilesAdded(a,b)},UploadProgress:function(a,b){e.UploadProgress(a,b)},FileUploaded:function(a,b,c){e.FileUploaded(a,b,c)},Error:function(a,b){e.Error(a,b)}}}),f.init()}function sendForumImage(a,b,c){var d=new FormData;d.append("file",b),ajax(c,{data:d,content:!1,process:!1,success:function(b){return 0==b.code?(b=b.data,a.summernote("insertImage",b.image_url,function(a){a.attr("src",b.image_url)}),void 0):(layer.msg(b.msg),void 0)}})}function telMatch(a){var b=/^((\+)?86|((\+)?86)?)0?1[3458]\d{9}$|^(((0\d2|0\d{2})[- ]?)?\d{8}|((0\d3|0\d{3})[- ]?)?\d{7})(-\d{3})?$/;return a.match(b)?(console.log("true"),!0):(console.log("false"),!1)}$(function(a){indexJS(),newsItemJs(),forumJs(),forumItemJs(),searchJs(),userJs(),a("#publishForum a").on("click",function(){if(0!=isLogin()){var b=a(this).data("url");commonWindow(b,740,600)}}),uploadFile("uploadForumImg",{FilesAdded:function(b){var d=a("#uploadForumImg").prev();d.find("li").length<3?b.start():layer.msg("最多只能上传3个")},FileUploaded:function(b,c,d){var e=a.parseJSON(d.response),f=a("#uploadForumImg").prev(),g=f.find("li").last();f.append(g.clone()),g=f.find("li").last(),e=e.data,g.find("img").attr("src",e.image_url),g.find("input").val(e.image_url),g.show(),g.removeClass("box-hide"),f.find("li.box-hide").remove()}}),a("#publishForum-box .images-list").on("click","a.del",function(){var b=a(this).parent();return 1==a("#publishForum-box .images-list li").length?(b.hide(),void 0):(b.remove(),void 0)}),a("#publishForum-box button.submit").on("click",function(){var g,b=a(this),c=!0,d=b.data("status"),e=a("#publishForum-box form");if(a("#summernote").summernote("code"),g=e.serializeObject(),console.log(g),"1"!=d){if(e.find('.images-list li.box-hide input[name="image_url[]"]').each(function(){c=!1}),0==c)return layer.msg("请上传封面图"),void 0;if(""==g.title)return layer.msg("未填写标题"),void 0;if(""==g.content)return layer.msg("未填写内容"),void 0;g._format_="pub_post",b.data("status",1),ajax(self.location.href,{data:g,success:function(a){return b.data("status",0),0==a.code?(parent.location.reload(),void 0):(layer.msg(a.msg),void 0)}})}}),a("#login-btn").on("click",function(){loginPopup()}),a("#register-btn").on("click",function(){registerPopup()}),a("#logout-btn").on("click",function(){var b=a(this),c=b.data("url");ajax(c,{success:function(a){return 0==a.code?(top.location="/",void 0):(layer.msg(a.msg),void 0)}})}),a("#sendVerification,#sendVerification-updatePass").on("click",function(){var b=a(this),c=b.parent().parent(),d=c.find("input[name='phone']").val(),e=b.data("url");return d&&telMatch(d)?("1"!=b.data("send")&&ajax(e,{data:{mobile:d},success:function(a){return 0==a.code?(countDown(b,60),void 0):(layer.msg(a.msg),void 0)}}),void 0):(c.find("input[name='phone']").focus(),void 0)}),a("#login-register-btn").on("click",function(){var b=a(this),c=b.parent().parent(),d=c.find("input[name='phone']").val(),e=c.find("input[name='code']").val();return d&&telMatch(d)?""==e?(c.find("input[name='code']").focus(),void 0):(ajax(self.location.href,{data:{mobile:d,code:e},success:function(a){return 0==a.code?(parent.location.reload(),void 0):(layer.msg(a.msg),void 0)}}),void 0):(c.find("input[name='phone']").focus(),void 0)}),a("#infoForm button").on("click",function(){var c,d;return a(this),c=a("#infoForm form"),d=c.serializeObject(),""==d.name?(c.find('input[name="name"]').focus(),void 0):(ajax(self.location.href,{data:d,success:function(a){return 0==a.code?(layer.msg("保存成功"),void 0):(layer.msg(a.msg),void 0)}}),void 0)}),a("#bindPhoneForm button").on("click",function(){var c,d;return a(this),c=a("#bindPhoneForm form"),d=c.serializeObject(),""!=d.phone&&telMatch(d.phone)?""==d.code?(c.find('input[name="code"]').focus(),void 0):(ajax(self.location.href,{data:{mobile:d.phone,code:d.code},success:function(a){return 0==a.code?(layer.msg("绑定成功"),void 0):(layer.msg(a.msg),void 0)}}),void 0):(c.find('input[name="phone"]').focus(),void 0)}),uploadFile("uploadAvatarImg",{FileUploaded:function(b,c,d){var e=a.parseJSON(d.response);a("#uploadAvatarImg").prev("img").attr("src",e.data.image_url),a("#headUserAvatarImage").attr("src",e.data.image_url)}}),a("#searchBtn").on("click",function(){var b=a(this),c=b.parent().find('input[name="q"]').val(),d=b.data("url");c&&(c=encodeURIComponent(c),window.location.href=d+"?q="+c)});var b;a(".showUserInfo").hover(function(){var c=a(this),d=c.offset(),e=c.data("id"),f=c.data("home");clearTimeout(b),a("#showUserBox").remove(),ajax(getHttpUrl(),{data:{id:e,_format_:"show_user"},success:function(e){var g,h;return 0==e.code?(e=e.data,g="",h="+关注",e.is_fans&&(g="active",h="已关注"),a("body").append('<div id="showUserBox"><div class="flex-start flex-align-start user-box"><div class="user-avatar"><a href="'+f+'"><img src="'+e.avatar[50]+'"></a></div>'+'<div class="user-name"><p class="name"><a href="'+f+'">'+e.name+'</a></p><p class="synopsis">'+e.synopsis+"</p></div>"+"</div>"+'<div class="flex-center flex-align-center content-box">'+'<div class="inline"><p class="name">ta粉丝</p><p class="num">'+e.fans_num+"</p></div>"+'<div class="inline"><p class="name">ta关注</p><p class="num">'+e.follow_num+"</p></div>"+"</div>"+'<a class="followBtn '+g+'" href="javascript:void(0);" data-status="'+e.is_fans+'" data-id="'+e.id+'">'+h+"</a>"+"</div>"),a("#showUserBox").offset({top:d.top+c.height()+8,left:d.left}),a("#showUserBox").hover(function(){clearTimeout(b)},function(){b=setTimeout(function(){a("#showUserBox").remove()},2e3)}),a("#showUserBox  a.followBtn").on("click",function(){var b=a(this),c=b.data("status"),d=b.data("id");0!=isLogin()&&"1"!=c&&d!=isLogin(1).id&&(b.data("status",1),ajax(getHttpUrl(),{data:{user_id:d,_format_:"fans"},success:function(a){return 0==a.code?(b.text("已关注"),b.addClass("active"),void 0):(b.data("status",0),void 0)}}))}),void 0):void 0}})},function(){b=setTimeout(function(){a("#showUserBox").remove()},1e3)}),a(".user-share").share()}),$.fn.serializeObject=function(){var a=Object.prototype.hasOwnProperty;return this.serializeArray().reduce(function(b,c){return a.call(b,c.name)||(b[c.name]=c.value),b},{})},$.fn.share=function(){function d(a,b,c){var d=(window.screen.availHeight-30-c)/2,e=(window.screen.availWidth-10-b)/2;window.open(a,"_blank","height="+c+", width="+b+",top = "+d+",left ="+e+", toolbar=no,scrollbars=no,menubar=no,status=no")}var a=$(this),b=a.data("title"),c=a.data("link");a.on("click","a",function(){var h,a=$(this),e=a.data("type"),f=a.parent().data("title"),g=a.parent().data("title");switch(f&&(b=f,c=g),e){case"qq":h="https://connect.qq.com/widget/shareqq/iframe_index.html?",h+="url="+encodeURIComponent(c||location.href),h+="&title="+encodeURIComponent(b||document.title),d(h,720,512);break;case"wechat":0==$("#qrcodeShow").length?$("body").append('<div id="qrcodeShow" style="display: none;padding:15px;text-align: center;"><div id="qrcodeShowImg"></div><div style="margin-top:15px;font-size: 14px;">微信扫一扫 右上角"..."分享</div></div>'):$("#qrcodeShowImg").html(""),new QRCode("qrcodeShowImg",{text:c||location.href,width:256,height:256,colorDark:"#000000",colorLight:"#ffffff",correctLevel:QRCode.CorrectLevel.L}),layer.open({type:1,shade:!1,title:!1,content:$("#qrcodeShow"),cancel:function(){}})
}})};