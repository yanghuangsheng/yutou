(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-community-detail-community-detail"],{"00f2":function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"index"},[1==t.page_status?i("v-uni-view",{staticClass:"content"},[i("uni-nav",{attrs:{title:t.title}}),i("v-uni-view",{staticClass:"wrap"},[i("v-uni-view",{staticClass:"release"},[i("v-uni-view",{staticClass:"release-list"},[i("v-uni-view",{staticClass:"release-top uni-flex"},[i("v-uni-view",{staticClass:"release-face"},[i("v-uni-image",{attrs:{src:t.item.user_avatar,mode:"aspectFill","lazy-load":""}})],1),i("v-uni-view",{staticClass:"release-name uni-flex"},[i("v-uni-view",{staticClass:"release-name-top"},[i("v-uni-text",[t._v(t._s(t.item.user_name))])],1),i("v-uni-view",{staticClass:"release-name-time"},[i("v-uni-text",[t._v(t._s(t.item.create_time))])],1)],1),i("v-uni-view",{class:t.item.is_fans?"y_Focus":"Focus",on:{click:function(e){e=t.$handleEvent(e),t.isFocus(e)}}},[i("v-uni-text",{staticClass:"addFocus"},[t._v(t._s(t.item.is_fans?"已关注":"+关注"))])],1)],1),i("v-uni-view",{staticClass:"release-news"},[i("v-uni-view",{staticClass:"news-title"},[i("v-uni-text",[t._v(t._s(t.item.title))])],1),i("v-uni-view",{staticClass:"news-content"},[i("v-uni-rich-text",{staticClass:"main-content",attrs:{nodes:t.item.content}})],1)],1),i("v-uni-view",{staticClass:"news-bottom uni-flex"},[i("v-uni-view",{staticClass:"bottom-list uni-flex",on:{click:function(e){e=t.$handleEvent(e),t.like(e)}}},[i("v-uni-image",{staticClass:"islike",attrs:{src:"../../static/images/big_islike.png"}}),i("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(0==t.item.praise_num||null==t.item.praise_num?"":t.item.praise_num))])],1),i("v-uni-view",{staticClass:"bottom-list reply uni-flex",on:{click:function(e){e=t.$handleEvent(e),t.reply(e)}}},[i("v-uni-image",{attrs:{src:"../../static/images/reply.png"}}),i("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(0==t.item.comment_num||null==t.item.comment_num?"":t.item.comment_num))])],1),i("v-uni-view",{staticClass:"bottom-list uni-flex",on:{click:function(e){e=t.$handleEvent(e),t.transmit(e)}}},[i("v-uni-image",{attrs:{src:"../../static/images/transmit.png"}}),i("v-uni-text",{staticClass:"bottom-list-number"})],1)],1)],1)],1)],1),i("v-uni-view",{staticClass:"divider"}),i("comment-list",{attrs:{add_comment_url:t.commentUrl,hot_list:t.hot_comment_data,newset_list:t.new_comment_data,page:t.pageType},on:{"set-comment-list":function(e){e=t.$handleEvent(e),t.setCommentList(e)},praise:function(e){e=t.$handleEvent(e),t.praiseComment(e)}}}),i("load-more",{attrs:{loading_type:t.loadingType},on:{"set-status":function(e){e=t.$handleEvent(e),t.setLoadingType(e)}}}),i("v-uni-view",{staticClass:"box"}),i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.isShare,expression:"isShare"}],staticClass:"share"},[i("v-uni-view",{staticClass:"share-way uni-flex"},[i("v-uni-view",{staticClass:"weChat uni-flex"},[i("v-uni-view",{staticClass:"white_circle uni-flex"},[i("v-uni-image",{attrs:{src:"../../static/images/weixin.png"}})],1),i("v-uni-text",[t._v("微信好友")])],1),i("v-uni-view",{staticClass:"QQ uni-flex"},[i("v-uni-view",{staticClass:"white_circle uni-flex"},[i("v-uni-image",{attrs:{src:"../../static/images/Q.png"}})],1),i("v-uni-text",[t._v("QQ好友")])],1),i("v-uni-view",{staticClass:"weibo uni-flex"},[i("v-uni-view",{staticClass:"white_circle uni-flex"},[i("v-uni-image",{attrs:{src:"../../static/images/weibo.png"}})],1),i("v-uni-text",[t._v("新浪微博")])],1),i("v-uni-view",{staticClass:"douban uni-flex"},[i("v-uni-view",{staticClass:"white_circle uni-flex"},[i("v-uni-image",{attrs:{src:"../../static/images/douban.png"}})],1),i("v-uni-text",[t._v("豆瓣社区")])],1),i("v-uni-view",{staticClass:"pengyouquan uni-flex"},[i("v-uni-view",{staticClass:"white_circle uni-flex"},[i("v-uni-image",{attrs:{src:"../../static/images/pengyouquan.png"}})],1),i("v-uni-text",[t._v("微信朋友圈")])],1)],1),i("v-uni-view",{staticClass:"cancel",on:{click:function(e){e=t.$handleEvent(e),t.cancel_share(e)}}},[i("v-uni-text",[t._v("取消")])],1)],1),i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.isShare,expression:"isShare"}],staticClass:"mark",on:{touchmove:function(e){e.stopPropagation(),e.preventDefault(),e=t.$handleEvent(e),t.moveHandle(e)}}})],1):i("page-loading",{attrs:{pageStatus:t.page_status},on:{reload:function(e){e=t.$handleEvent(e),t.onRefresh(e)}}})],1)},n=[];i.d(e,"a",function(){return a}),i.d(e,"b",function(){return n})},"34dc":function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,".content[data-v-78756c52]{width:%?750?%}.wrap[data-v-78756c52]{width:100%;position:relative}.release-list[data-v-78756c52]{padding:%?40?% %?20?% %?10?% %?20?%;border-bottom:%?1?% solid #f5f5f5}.release-top[data-v-78756c52]{height:%?70?%;margin-bottom:%?25?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;position:relative}.release-face[data-v-78756c52]{width:%?70?%;height:%?70?%;border-radius:100%;-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;overflow:hidden}.release-face uni-image[data-v-78756c52]{width:%?70?%;height:%?70?%;border-radius:100%}.release-name[data-v-78756c52]{height:%?70?%;margin-left:%?20?%;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}.release-name-top[data-v-78756c52]{font-size:%?28?%;color:#626262;line-height:1.5em}.release-name-time[data-v-78756c52]{font-size:%?24?%;color:#bcbcbc;line-height:1.5em}.Focus[data-v-78756c52]{width:%?95?%;height:%?45?%;line-height:%?45?%;text-align:center;position:absolute;right:0;font-size:%?24?%;border:1px solid #272626;color:#0c0c0c;border-radius:%?40?%}.y_Focus[data-v-78756c52]{width:%?95?%;height:%?45?%;line-height:%?45?%;text-align:center;position:absolute;right:0;font-size:%?24?%;border:1px solid #969494;color:#acabab;border-radius:%?40?%}.release-list .release-news .news-title[data-v-78756c52]{font-size:%?32?%;color:#4f4f4f;line-height:1.6em}.release-list .release-news .news-content[data-v-78756c52]{margin:%?20?% %?0?%;font-size:%?30?%;line-height:1.6em;overflow:hidden}.release-list .release-news .main-content[data-v-78756c52]{color:#989898}.release-news .news-img uni-image[data-v-78756c52]{width:%?710?%;height:%?354?%}.release-list .news-bottom[data-v-78756c52]{height:%?70?%;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between}.release-list .news-bottom .reply[data-v-78756c52]{margin-left:%?400?%}.release-list .news-bottom .bottom-list[data-v-78756c52]{width:%?100?%;height:%?70?%;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.news-bottom .bottom-list uni-image[data-v-78756c52]{width:%?35?%;height:%?35?%}.news-bottom .bottom-list .islike[data-v-78756c52]{width:%?40?%;height:%?40?%}.news-bottom .bottom-list .bottom-list-number[data-v-78756c52]{color:#9d9d9d;margin-left:%?10?%}\r\n/* 分割线 */.divider[data-v-78756c52]{position:relative;margin-top:%?-3?%;height:%?25?%;background-color:#f5f5f5}.box[data-v-78756c52]{height:%?95?%}\r\n/* 分享 */.share[data-v-78756c52]{width:%?750?%;height:%?537?%;position:fixed;bottom:0;z-index:1000}.share .share-way[data-v-78756c52]{width:100%;height:%?418?%;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;padding-top:%?30?%;background-color:#f5f5f5}.share .share-way .white_circle[data-v-78756c52]{width:%?105?%;height:%?105?%;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;background-color:#fff;border-radius:100%}.share-way .white_circle uni-image[data-v-78756c52]{width:%?60?%;height:%?60?%}.share .share-way>uni-view[data-v-78756c52]{margin-left:%?66?%;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}.share .share-way uni-text[data-v-78756c52]{color:#a3a3a3}.share .cancel[data-v-78756c52]{width:100%;height:%?89?%;text-align:center;line-height:%?89?%;color:#42c5f0;background-color:#fff}",""])},"3f6c":function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=r(i("1193")),n=r(i("065c")),s=r(i("d8ec")),o=r(i("8058")),c=r(i("cf80"));function r(t){return t&&t.__esModule?t:{default:t}}var l={components:{pageLoading:s.default,statusBar:n.default,loadMore:a.default,uniNav:o.default,commentList:c.default},data:function(){return{pageType:"community",page_status:0,title:"动态详情",isShare:!1,commentUrl:"",item:{},start_id:"",page:1,loadingType:0,hot_comment_data:[],new_comment_data:[]}},onLoad:function(t){console.log(this.item),console.log(t),this.item_id=t.id,this.commentUrl="forum/submit_comment?id="+this.item_id,this._onLoad()},onReachBottom:function(){this._onLoadMore()},methods:{moveHandle:function(){},transmit:function(){this.isShare=!0},cancel_share:function(){this.isShare=!1},setCommentList:function(t){console.log(t),this.new_comment_data=t.concat(this.new_comment_data)},setLoadingType:function(t){this.loadingType=t.status},_onLoadMore:function(){var t=this;if(console.log(this.loadingType),0==this.loadingType){this.loadingType=1;var e=this.item.id,i=this.page+1,a=this.start_id;this.$http.get("forum/more_comment",{id:e,page:i,start_id:a}).then(function(e){if(console.log(JSON.stringify(e)),0==e.data.length)return t.loadingType=2,!1;console.log(t.new_comment_data),t.new_comment_data=t.new_comment_data.concat(e.data),t.new_comment_data.page=i,t.loadingType=0}).catch(function(e){t.loadingType=0,t.$tool.errorToast(),console.log("page_err")})}},onRefresh:function(){this._onLoad()},_onLoad:function(){var t=this,e=this,i=this.item_id;e.page_status=0;var a=setTimeout(function(){e.$tool.loadFail(e)},6e3);this.$http.get("forum/item",{id:i}).then(function(e){console.log(e);var i=e.data;t.item=i.item,t.title=t.item.title,t.new_comment_data=i.new_comment_list,t.hot_comment_data=i.hot_comment_list,t.start_id=i.start_id,t.page_status=1,clearTimeout(a)}).catch(function(t){console.log("err")})},like:function(){var t=this,e=this.item_id;this.$http.post("forum/praise",{id:e}).then(function(e){return isNaN(t.item.praise_num)?(t.item.praise_num=1,!1):-1==e.code?(t.$tool.showToast(e.message),!1):void(t.item.praise_num+=1)}).catch(function(t){console.log("err")})},praiseComment:function(t){var e=this,i=t.id;this.$http.post("forum/praise_comment",{id:i}).then(function(i){if(0==i.code){if("newsComment"==t.type){if(isNaN(e.new_comment_data[t.index].praise_num))return e.new_comment_data[t.index].praise_num=1,!1;e.new_comment_data[t.index].praise_num+=1}else if("hotComment"==t.type){if(isNaN(e.hot_comment_data[t.index].praise_num))return e.hot_comment_data[t.index].praise_num=1,!1;e.hot_comment_data[t.index].praise_num+=1}}else e.$tool.showToast(i.message)}).catch(function(t){console.log("err")})},isFocus:function(){var t=this,e=this.item.user_id,i=this.item.is_fans;this.$tool.getUserData().id?0==i&&this.$http.post("user/fans",{user_id:e}).then(function(e){0==e.code&&(t.item.is_fans=1)}).catch(function(t){console.log("err")}):uni.navigateTo({url:"../login/login"})}}};e.default=l},"40fb":function(t,e,i){"use strict";var a=i("c948"),n=i.n(a);n.a},"55a1":function(t,e,i){"use strict";i.r(e);var a=i("00f2"),n=i("fddc");for(var s in n)"default"!==s&&function(t){i.d(e,t,function(){return n[t]})}(s);i("5816");var o=i("2877"),c=Object(o["a"])(n["default"],a["a"],a["b"],!1,null,"78756c52",null);e["default"]=c.exports},5816:function(t,e,i){"use strict";var a=i("b0a4"),n=i.n(a);n.a},8058:function(t,e,i){"use strict";i.r(e);var a=i("9c5c"),n=i("f732");for(var s in n)"default"!==s&&function(t){i.d(e,t,function(){return n[t]})}(s);i("40fb");var o=i("2877"),c=Object(o["a"])(n["default"],a["a"],a["b"],!1,null,"cb31f95a",null);e["default"]=c.exports},"9c5c":function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",[i("v-uni-view",{staticClass:"nav uni-center",style:{marginTop:t.statusBarHeight}},[i("v-uni-view",{staticClass:"title uni-ellipsis"},[t._v(t._s(t.title))]),i("v-uni-view",{staticClass:"left-arrow",on:{click:function(e){e=t.$handleEvent(e),t.goback(e)}}},[i("v-uni-view")],1)],1),i("v-uni-view",{staticClass:"margin-bottom"})],1)},n=[];i.d(e,"a",function(){return a}),i.d(e,"b",function(){return n})},"9ce3":function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{title:{type:String}},data:function(){return{statusBarHeight:""}},onLoad:function(){},methods:{goback:function(){uni.navigateBack({delta:1,animationType:"pop-out",animationDuration:200})}}};e.default=a},"9d37":function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,'.nav[data-v-cb31f95a]{width:100%;height:%?90?%;position:fixed;\n\tleft:0;z-index:99;background-color:#fff;border-bottom:%?1?% solid #e9e9e9}.nav .title[data-v-cb31f95a]{width:%?300?%;font-size:%?34?%;line-height:%?89?%;color:#4a4a4a;text-align:center}.left-arrow[data-v-cb31f95a]{width:%?100?%;height:%?89?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;top:0;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;position:absolute;left:0}.left-arrow[data-v-cb31f95a] :after{content:"";width:%?25?%;height:%?25?%;position:absolute;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;margin-top:%?-13?%;left:%?35?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-left:%?4?% solid #adadad;border-bottom:%?4?% solid #adadad}.margin-bottom[data-v-cb31f95a]{margin-bottom:%?90?%}',""])},b0a4:function(t,e,i){var a=i("34dc");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("9edde68a",a,!0,{sourceMap:!1,shadowMode:!1})},c948:function(t,e,i){var a=i("9d37");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("6ec24cd4",a,!0,{sourceMap:!1,shadowMode:!1})},f732:function(t,e,i){"use strict";i.r(e);var a=i("9ce3"),n=i.n(a);for(var s in a)"default"!==s&&function(t){i.d(e,t,function(){return a[t]})}(s);e["default"]=n.a},fddc:function(t,e,i){"use strict";i.r(e);var a=i("3f6c"),n=i.n(a);for(var s in a)"default"!==s&&function(t){i.d(e,t,function(){return a[t]})}(s);e["default"]=n.a}}]);