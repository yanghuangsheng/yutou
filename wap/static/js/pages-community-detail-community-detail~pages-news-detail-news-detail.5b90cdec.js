(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-community-detail-community-detail~pages-news-detail-news-detail"],{"04f8":function(t,e,n){"use strict";n.r(e);var i=n("2126"),a=n.n(i);for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);e["default"]=a.a},"065c":function(t,e,n){"use strict";n.r(e);var i=n("7493"),a=n("946a");for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);n("b8d9");var s=n("2877"),r=Object(s["a"])(a["default"],i["a"],i["b"],!1,null,"5c41bc10",null);e["default"]=r.exports},"0b09":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,'.nav[data-v-ceff955c]{width:100%;height:%?90?%;position:fixed;\n\t\n\ttop:0;\n\tleft:0;z-index:99;background-color:#fff;border-bottom:%?1?% solid #e9e9e9}.nav .title[data-v-ceff955c]{width:%?350?%;font-size:%?34?%;line-height:%?89?%;color:#4a4a4a;text-align:center}.left-arrow[data-v-ceff955c]{width:%?100?%;height:%?89?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;top:0;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;position:absolute;left:0}.left-arrow[data-v-ceff955c] :after{content:"";width:%?25?%;height:%?25?%;position:absolute;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;margin-top:%?-13?%;left:%?35?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);\n\tborder-left:%?4?% solid #adadad;border-bottom:%?4?% solid #adadad;\n\t\n\t}.margin-bottom[data-v-ceff955c]{margin-bottom:%?90?%}',""])},1193:function(t,e,n){"use strict";n.r(e);var i=n("f1ce"),a=n("04f8");for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);n("a4f9");var s=n("2877"),r=Object(s["a"])(a["default"],i["a"],i["b"],!1,null,"0da82823",null);e["default"]=r.exports},2126:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={props:{loading_type:{type:Number,default:1},time:{type:Number,default:1e3},color:{type:String,default:"#777777"}},data:function(){return{image_show:!0,loading_txt:""}},computed:{returnMoreStatus:function(){var t=this;return 0===t.loading_type?(t.image_show=!0,!1):2===t.loading_type?(t.image_show=!1,t.loading_txt="没有更多了",t._setStatus(),!0):1===t.loading_type?(t.loading_txt="正在加载 ...",t.image_show=!0,!0):void 0}},methods:{_setStatus:function(){var t=this;setTimeout(function(){t.$emit("set-status",{status:0})},this.time)}}};e.default=i},"29b2":function(t,e,n){"use strict";var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"nav uni-center",style:{marginTop:t.statusBarHeight}},[n("v-uni-view",{staticClass:"title uni-ellipsis"},[t._v(t._s(t.title))]),t.isShow?n("v-uni-view",{staticClass:"left-arrow",on:{click:function(e){e=t.$handleEvent(e),t.goback(e)}}},[n("v-uni-view")],1):n("v-uni-view",{staticClass:"left-arrow",on:{click:function(e){e=t.$handleEvent(e),t.Tapback(e)}}},[n("v-uni-view")],1)],1),n("v-uni-view",{staticClass:"margin-bottom"})],1)},a=[];n.d(e,"a",function(){return i}),n.d(e,"b",function(){return a})},"380d":function(t,e,n){"use strict";var i=n("43aa"),a=n.n(i);a.a},"43aa":function(t,e,n){var i=n("0b09");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=n("4f06").default;a("808405f4",i,!0,{sourceMap:!1,shadowMode:!1})},4443:function(t,e,n){"use strict";var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"comment"},[n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.hot_list.length,expression:"hot_list.length"}],staticClass:"comment-tab uni-flex"},[n("v-uni-view",{staticClass:"comment-title"},[n("v-uni-text",{staticClass:"current"},[t._v("热门评论")])],1),n("v-uni-view",{staticClass:"comment-title",on:{click:function(e){e=t.$handleEvent(e),t.go_newset(e)}}},[n("v-uni-text",[t._v("最新评论")])],1)],1),t._l(t.hot_list,function(e,i){return n("v-uni-view",{key:i,staticClass:"comment-box",attrs:{id:"hotComment_"+e.id}},[n("v-uni-view",{staticClass:"header uni-flex"},[n("v-uni-view",{staticClass:"header-face"},[n("v-uni-image",{attrs:{src:e.user_avatar[100],mode:"aspectFill","lazy-load":""}})],1),n("v-uni-view",{staticClass:"header-name uni-flex"},[n("v-uni-view",{staticClass:"name"},[n("v-uni-text",[t._v(t._s(e.user_name))])],1),n("v-uni-view",{staticClass:"time"},[n("v-uni-text",[t._v(t._s(e.date_time))])],1)],1)],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:e.reply_content,expression:"item.reply_content"}],staticClass:"revert"},[n("v-uni-text",{staticClass:"revert-name"},[t._v(t._s(e.reply_name))]),n("v-uni-text",{staticClass:"revert-content"},[t._v(t._s(e.reply_content))])],1),n("v-uni-view",{staticClass:"comment-content"},[n("v-uni-text",[t._v(t._s(e.content))])],1),n("v-uni-view",{staticClass:"comment-bottom uni-flex"},[n("v-uni-view",{staticClass:"bottom-list uni-flex like",attrs:{"data-type":"hotComment"},on:{click:function(e){e=t.$handleEvent(e),t.commentLike(e)}}},[n("v-uni-image",{attrs:{src:0===e.islike?"../../static/images/like.png":"../../static/images/islike.png"}}),n("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(e.praise_num?e.praise_num:""))])],1),n("v-uni-view",{staticClass:"bottom-list uni-flex",attrs:{"data-id":e.id},on:{click:function(e){e=t.$handleEvent(e),t.goReply(e)}}},[n("v-uni-image",{attrs:{src:"../../static/images/reply.png"}}),n("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(e.replyNum))])],1),n("v-uni-view",{staticClass:"bottom-list uni-flex",attrs:{"data-index":i,"data-type":"hot","data-id":e.id},on:{click:function(e){e=t.$handleEvent(e),t.reply(e)}}},[n("v-uni-text",{staticClass:"huifu"},[t._v("回复")])],1)],1)],1)}),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.newset_list.length,expression:"newset_list.length"}],staticClass:"comment-tab uni-flex",attrs:{id:"goTo_new"}},[n("v-uni-view",{staticClass:"divider"}),n("v-uni-text",{staticClass:"comment-title current"},[t._v("最新评论")])],1),t._l(t.newset_list,function(e,i){return n("v-uni-view",{key:i,staticClass:"comment-box",attrs:{id:"newComment_"+e.id}},[n("v-uni-view",{staticClass:"header uni-flex"},[n("v-uni-view",{staticClass:"header-face"},[n("v-uni-image",{attrs:{src:e.user_avatar[100],mode:"aspectFill","lazy-load":""}})],1),n("v-uni-view",{staticClass:"header-name uni-flex"},[n("v-uni-view",{staticClass:"name"},[n("v-uni-text",[t._v(t._s(e.user_name))])],1),n("v-uni-view",{staticClass:"time"},[n("v-uni-text",[t._v(t._s(e.date_time))])],1)],1)],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:e.reply_content,expression:"item.reply_content"}],staticClass:"revert"},[n("v-uni-text",{staticClass:"revert-name"},[t._v(t._s(e.reply_name)+" ：")]),n("v-uni-text",{staticClass:"revert-content"},[t._v(t._s(e.reply_content))])],1),n("v-uni-view",{staticClass:"comment-content"},[n("v-uni-text",[t._v(t._s(e.content))])],1),n("v-uni-view",{staticClass:"comment-bottom uni-flex like"},[n("v-uni-view",{staticClass:"bottom-list uni-flex",attrs:{"data-type":"newsComment","data-index":i,"data-id":e.id},on:{click:function(e){e=t.$handleEvent(e),t.commentLike(e)}}},[n("v-uni-image",{attrs:{src:0===e.islike?"../../static/images/like.png":"../../static/images/islike.png"}}),n("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(e.praise_num?e.praise_num:""))])],1),n("v-uni-view",{staticClass:"bottom-list uni-flex",attrs:{"data-id":e.id},on:{click:function(e){e=t.$handleEvent(e),t.goReply(e)}}},[n("v-uni-image",{attrs:{src:"../../static/images/reply.png"}}),n("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(e.replyNum))])],1),n("v-uni-view",{staticClass:"bottom-list uni-flex",attrs:{"data-index":i,"data-type":"newset","data-id":e.id},on:{click:function(e){e=t.$handleEvent(e),t.reply(e)}}},[n("v-uni-text",{staticClass:"huifu"},[t._v("回复")])],1)],1)],1)})],2),n("v-uni-view",{staticClass:"footer",attrs:{id:"footer"}},[n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.replyShow,expression:"replyShow"}],staticClass:"comment-box popup-content"},[n("v-uni-view",{staticClass:"close",on:{click:function(e){e=t.$handleEvent(e),t.close(e)}}},[n("v-uni-text",[t._v("×")])],1),n("v-uni-view",{staticClass:"header uni-flex"},[n("v-uni-view",{staticClass:"header-face"},[n("v-uni-image",{attrs:{src:t.replyUserAvatar,mode:"aspectFill","lazy-load":""}})],1),n("v-uni-view",{staticClass:"header-name uni-flex"},[n("v-uni-view",{staticClass:"name"},[n("v-uni-text",[t._v(t._s(t.replyData.user_name))])],1),n("v-uni-view",{staticClass:"time"},[n("v-uni-text",[t._v(t._s(t.replyData.date_time))])],1)],1)],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.replyData.reply_content,expression:"replyData.reply_content"}],staticClass:"revert"},[n("v-uni-text",{staticClass:"revert-name"},[t._v(t._s(t.replyData.reply_name)+" ：")]),n("v-uni-text",{staticClass:"revert-content"},[t._v(t._s(t.replyData.reply_content))])],1),n("v-uni-view",{staticClass:"comment-content"},[n("v-uni-text",[t._v(t._s(t.replyData.content))])],1)],1),n("v-uni-view",{staticClass:"bottom"},[n("v-uni-view",{staticClass:"release uni-flex"},[n("v-uni-view",{staticClass:"input"},[n("v-uni-input",{staticClass:"ipt",attrs:{type:"text",placeholder:t.placeholder,value:t.sendText,maxlength:"150",focus:t.showInput},on:{focus:function(e){e=t.$handleEvent(e),t.focus(e)},input:function(e){e=t.$handleEvent(e),t.replaceInput(e)},blur:function(e){e=t.$handleEvent(e),t.blur(e)}}})],1),n("v-uni-view",{staticClass:"button"},[n("v-uni-button",{staticClass:"btn",on:{click:function(e){e=t.$handleEvent(e),t.commentAdd(e)}}},[t._v("发布")])],1)],1)],1)],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.showInput,expression:"showInput"}],staticClass:"mark",on:{touchmove:function(e){e.stopPropagation(),e.preventDefault(),e=t.$handleEvent(e),t.moveHandle(e)}}})],1)},a=[];n.d(e,"a",function(){return i}),n.d(e,"b",function(){return a})},"4a84":function(t,e,n){var i=n("4ac4");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=n("4f06").default;a("55011e8d",i,!0,{sourceMap:!1,shadowMode:!1})},"4ac4":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,'\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 评论区 */.comment .comment-tab[data-v-1df4e432]{width:%?710?%;margin:0 auto;height:%?100?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.comment-title[data-v-1df4e432]{font-size:%?32?%;color:#595757;margin-right:%?30?%}.current[data-v-1df4e432]{color:#282826;position:relative}.current[data-v-1df4e432]:after{position:absolute;bottom:%?-10?%;left:%?0?%;right:%?0?%;height:%?6?%;content:"";background-color:#f4cc7e}.comment-box[data-v-1df4e432]{padding:0 %?20?%;margin-top:%?30?%;border-bottom:%?1?% solid #f5f5f5}.comment-box .header[data-v-1df4e432]{height:%?70?%;margin-bottom:%?20?%}.comment-box .header .header-face[data-v-1df4e432]{width:%?70?%;height:%?70?%;border-radius:100%;-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;overflow:hidden}.header .header-face uni-image[data-v-1df4e432]{width:%?70?%;height:%?70?%;border-radius:100%}.comment-box .header .header-name[data-v-1df4e432]{margin-left:%?13?%;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}.header .header-name .name[data-v-1df4e432]{line-height:1.3em;font-size:%?28?%;color:#757575}.header .header-name .time[data-v-1df4e432]{line-height:1.3em;font-size:%?24?%;color:#cacaca}.comment-box .revert[data-v-1df4e432]{margin:%?20?% %?0?% %?20?% %?70?%;background-color:#f2f2f2;font-size:%?26?%;border-radius:%?10?%;padding:%?20?% %?0?% %?20?% %?15?%;line-height:1.5em}.revert .revert-name[data-v-1df4e432]{color:#407aa6}.revert .revert-content[data-v-1df4e432]{color:#888}.comment-box .comment-content[data-v-1df4e432]{font-size:%?30?%;line-height:1.6em;color:#4a4a4a;margin-left:%?70?%}.comment-box .comment-bottom[data-v-1df4e432]{height:%?70?%;margin:%?20?% %?0?% %?0?% %?70?%;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between}.comment-bottom .bottom-list[data-v-1df4e432]{width:%?100?%;height:%?70?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.comment-bottom .bottom-list uni-image[data-v-1df4e432]{width:%?35?%;height:%?35?%}.comment-bottom .bottom-list .like[data-v-1df4e432]{text-align:left}.comment-bottom .bottom-list .bottom-list-number[data-v-1df4e432]{margin-left:%?10?%;color:#9d9d9d}.comment-bottom .bottom-list .huifu[data-v-1df4e432]{color:#9e9e9e}\r\n/* 底部 */.footer[data-v-1df4e432]{width:%?750?%;position:fixed;bottom:0;z-index:999;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;background-color:#fff;padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.footer .close[data-v-1df4e432]{position:absolute;top:%?-18?%;right:%?-10?%;width:%?45?%;height:%?45?%;color:#fff;font-size:%?30?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;border-radius:50%;background-color:#f4cc7e;opacity:.9}.popup-content[data-v-1df4e432]{position:absolute;left:%?30?%;right:%?30?%;bottom:100%;margin-bottom:%?30?%;padding:%?20?%;background-color:#fff;border:none;border-radius:%?8?%}.footer .release[data-v-1df4e432]{width:%?710?%;height:%?104?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;padding:%?0?% %?20?%;background-color:#fff}.footer .release .input[data-v-1df4e432]{width:%?566?%;height:%?64?%;border:%?1?% solid #a0a0a0;border-radius:%?40?%}.footer .input .ipt[data-v-1df4e432]{height:%?64?%;padding-left:%?20?%;padding-right:%?20?%}.footer .button[data-v-1df4e432]{margin-left:%?40?%}.footer .button .btn[data-v-1df4e432]{width:%?95?%;height:%?64?%;font-size:%?24?%;padding:0;color:#fff;line-height:%?64?%;background-color:#f4cc7e}',""])},"4e1a":function(t,e,n){var i=n("a1f8");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=n("4f06").default;a("66a40329",i,!0,{sourceMap:!1,shadowMode:!1})},"67c1":function(t,e,n){"use strict";var i=n("4a84"),a=n.n(i);a.a},"68c7":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,".load-more[data-v-0da82823]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;height:%?80?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center}.loading-img[data-v-0da82823]{height:24px;width:24px;margin-right:10px}.loading-text[data-v-0da82823]{font-size:%?28?%;color:#777}.loading-img>uni-view[data-v-0da82823]{position:absolute}.load1[data-v-0da82823],.load2[data-v-0da82823],.load3[data-v-0da82823]{height:24px;width:24px}.load2[data-v-0da82823]{-webkit-transform:rotate(30deg);-ms-transform:rotate(30deg);transform:rotate(30deg)}.load3[data-v-0da82823]{-webkit-transform:rotate(60deg);-ms-transform:rotate(60deg);transform:rotate(60deg)}.loading-img>uni-view uni-view[data-v-0da82823]{width:6px;height:2px;border-top-left-radius:1px;border-bottom-left-radius:1px;background:#777;position:absolute;opacity:.2;-webkit-transform-origin:50%;-ms-transform-origin:50%;transform-origin:50%;-webkit-animation:load-data-v-0da82823 1.56s ease infinite}.loading-img>uni-view uni-view[data-v-0da82823]:first-child{-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg);top:2px;left:9px}.loading-img>uni-view uni-view[data-v-0da82823]:nth-child(2){-webkit-transform:rotate(180deg);top:11px;right:0}.loading-img>uni-view uni-view[data-v-0da82823]:nth-child(3){-webkit-transform:rotate(270deg);-ms-transform:rotate(270deg);transform:rotate(270deg);bottom:2px;left:9px}.loading-img>uni-view uni-view[data-v-0da82823]:nth-child(4){top:11px;left:0}.load1 uni-view[data-v-0da82823]:first-child{-webkit-animation-delay:0s;animation-delay:0s}.load2 uni-view[data-v-0da82823]:first-child{-webkit-animation-delay:.13s;animation-delay:.13s}.load3 uni-view[data-v-0da82823]:first-child{-webkit-animation-delay:.26s;animation-delay:.26s}.load1 uni-view[data-v-0da82823]:nth-child(2){-webkit-animation-delay:.39s;animation-delay:.39s}.load2 uni-view[data-v-0da82823]:nth-child(2){-webkit-animation-delay:.52s;animation-delay:.52s}.load3 uni-view[data-v-0da82823]:nth-child(2){-webkit-animation-delay:.65s;animation-delay:.65s}.load1 uni-view[data-v-0da82823]:nth-child(3){-webkit-animation-delay:.78s;animation-delay:.78s}.load2 uni-view[data-v-0da82823]:nth-child(3){-webkit-animation-delay:.91s;animation-delay:.91s}.load3 uni-view[data-v-0da82823]:nth-child(3){-webkit-animation-delay:1.04s;animation-delay:1.04s}.load1 uni-view[data-v-0da82823]:nth-child(4){-webkit-animation-delay:1.17s;animation-delay:1.17s}.load2 uni-view[data-v-0da82823]:nth-child(4){-webkit-animation-delay:1.3s;animation-delay:1.3s}.load3 uni-view[data-v-0da82823]:nth-child(4){-webkit-animation-delay:1.43s;animation-delay:1.43s}@-webkit-keyframes load-data-v-0da82823{0%{opacity:1}to{opacity:.2}}",""])},7493:function(t,e,n){"use strict";var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"status_bar"},[n("v-uni-view",{staticClass:"top_view"})],1)],1)},a=[];n.d(e,"a",function(){return i}),n.d(e,"b",function(){return a})},8058:function(t,e,n){"use strict";n.r(e);var i=n("29b2"),a=n("f732");for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);n("380d");var s=n("2877"),r=Object(s["a"])(a["default"],i["a"],i["b"],!1,null,"ceff955c",null);e["default"]=r.exports},"80a0":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={data:function(){return{statusBarHeight:""}},onLoad:function(){}};e.default=i},"946a":function(t,e,n){"use strict";n.r(e);var i=n("80a0"),a=n.n(i);for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);e["default"]=a.a},"9ce3":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={props:{title:{type:String},isShow:{type:Boolean,default:!0}},data:function(){return{statusBarHeight:""}},onLoad:function(){},methods:{goback:function(){uni.navigateBack({delta:1,animationType:"pop-out",animationDuration:200})},Tapback:function(){uni.switchTab({url:"../index/index",animationDuration:200})}}};e.default=i},a1f8:function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 状态栏 */.status_bar[data-v-5c41bc10]{height:0;width:100%}.top_view[data-v-5c41bc10]{height:0;width:100%;position:fixed;background-color:#fff;top:0;z-index:9999}",""])},a4f9:function(t,e,n){"use strict";var i=n("db47"),a=n.n(i);a.a},b1ca:function(t,e,n){"use strict";n.r(e);var i=n("b760"),a=n.n(i);for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);e["default"]=a.a},b3d0:function(t,e,n){"use strict";var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"loading"},[n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.loading_show,expression:"loading_show"}],staticClass:"loading-img"},[n("v-uni-view",{staticClass:"load1"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load2"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load3"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1)],1)],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.error_show,expression:"error_show"}],staticClass:"load"},[n("v-uni-view",{staticClass:"load-img"},[n("v-uni-image",{attrs:{src:"/static/images/load.png"}})],1),n("v-uni-view",{staticClass:"prompt"},[n("v-uni-text",[t._v("加载失败了，等会再浪吧")])],1),n("v-uni-view",{staticClass:"reload uni-center",on:{click:function(e){e=t.$handleEvent(e),t.reload(e)}}},[n("v-uni-text",[t._v("重新加载")])],1)],1)],1)},a=[];n.d(e,"a",function(){return i}),n.d(e,"b",function(){return a})},b599:function(t,e,n){"use strict";n.r(e);var i=n("f6f4"),a=n.n(i);for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);e["default"]=a.a},b760:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={props:{add_comment_url:{type:String},hot_list:{default:[]},newset_list:{default:[]},page:{type:String}},data:function(){return{placeholder:"来都来了，不说点什么吗？",showInput:!1,screenHeight:"",windowHeight:"",replyData:[],sendText:""}},computed:{replyShow:function(){return!!this.replyData.id},replyUserAvatar:function(){return this.replyData.user_avatar?this.replyData.user_avatar[100]:""}},methods:{moveHandle:function(){},go_newset:function(){var t=uni.createSelectorQuery().select("#goTo_new");t.boundingClientRect(function(t){uni.pageScrollTo({scrollTop:t.top,duration:20})}).exec()},reply:function(t){var e=this.$tool.getDataSet(t,"index"),n=this.$tool.getDataSet(t,"type");"hot"==n?this.replyData=this.hot_list[e]:"newset"==n&&(this.replyData=this.newset_list[e]),console.log(this.replyData);var i=this.replyData.user_name;this.placeholder="@回复"+i+":",this.showInput=!0},focus:function(){this.showInput=!0},blur:function(){this.showInput=!1,this.replyData=[],this.placeholder="来都来了，不说点什么吗？"},goReply:function(t){var e=this.page,n=this.$tool.getDataSet(t,"id");uni.navigateTo({url:"../reply/reply?id="+n+"&type="+e,animationDuration:200})},replaceInput:function(t){this.sendText=t.target.value},commentAdd:function(){var t=this;if(""!=this.sendText){var e=this.replyData,n={content:this.sendText};e&&(n.reply_id=e.id,n.parent_id=e.parent_id?e.parent_id:e.id,n.reply_user_id=e.user_id),this.$http.post(this.add_comment_url,n).then(function(e){0==e.code&&(t.sendText="",t.replyData={},uni.hideKeyboard(),t.$emit("set-comment-list",e.data))}).catch(function(t){console.log("err")})}},commentLike:function(t){var e=this.$tool.getDataSet(t,"type"),n=this.$tool.getDataSet(t,"index"),i=this.$tool.getDataSet(t,"id"),a={index:n,type:e,id:i};this.$emit("praise",a)},close:function(){this.replyData=[],this.placeholder="来都来了，不说点什么吗？",uni.hideKeyboard()}}};e.default=i},b8d9:function(t,e,n){"use strict";var i=n("4e1a"),a=n.n(i);a.a},cf80:function(t,e,n){"use strict";n.r(e);var i=n("4443"),a=n("b1ca");for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);n("67c1");var s=n("2877"),r=Object(s["a"])(a["default"],i["a"],i["b"],!1,null,"1df4e432",null);e["default"]=r.exports},d8ec:function(t,e,n){"use strict";n.r(e);var i=n("b3d0"),a=n("b599");for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);var s=n("2877"),r=Object(s["a"])(a["default"],i["a"],i["b"],!1,null,"066967ad",null);e["default"]=r.exports},db47:function(t,e,n){var i=n("68c7");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=n("4f06").default;a("3ab169ac",i,!0,{sourceMap:!1,shadowMode:!1})},f1ce:function(t,e,n){"use strict";var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.returnMoreStatus,expression:"returnMoreStatus"}],staticClass:"load-more"},[n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.image_show,expression:"image_show"}],staticClass:"loading-img"},[n("v-uni-view",{staticClass:"load1"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load2"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load3"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1)],1),n("v-uni-text",{staticClass:"loading-text"},[t._v(t._s(t.loading_txt))])],1)},a=[];n.d(e,"a",function(){return i}),n.d(e,"b",function(){return a})},f6f4:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={props:{color:{type:String,default:"#777777"},pageStatus:{type:Number}},data:function(){return{}},computed:{loading_show:function(){return 0==this.pageStatus},error_show:function(){return 2==this.pageStatus}},methods:{reload:function(){this.$emit("reload")}}};e.default=i},f732:function(t,e,n){"use strict";n.r(e);var i=n("9ce3"),a=n.n(i);for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);e["default"]=a.a}}]);