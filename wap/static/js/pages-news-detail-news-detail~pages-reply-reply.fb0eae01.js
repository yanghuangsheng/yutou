(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-news-detail-news-detail~pages-reply-reply"],{"063f":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{item:{type:Object},page:{type:String},commentType:{type:String},showReply:{type:Boolean,default:!0}},data:function(){return{}},computed:{replyUserAvatar:function(){return this.item.user_avatar?this.item.user_avatar[100]:""}},methods:{go_newset:function(){var t=uni.createSelectorQuery().select("#goTo_new");t.boundingClientRect(function(t){uni.pageScrollTo({scrollTop:t.top,duration:20})}).exec()},commentLike:function(t){var e=this.$tool.getDataSet(t,"id"),n={data:this.item,id:e};this.$emit("praise",n)},reply:function(){this.$emit("reply",this.item)},goReply:function(t){var e=this.$tool.getDataSet(t,"id");uni.navigateTo({url:"../reply/reply?id="+e,animationDuration:200})}}};e.default=a},"0a46":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={name:"custom-nav",props:{title:{type:String},share:{type:Boolean,default:!1},arrow:{type:Boolean,default:!0},showBorder:{type:Boolean,default:!0}},data:function(){return{statusBarHeight:""}},onLoad:function(){},methods:{goback:function(){this.$emit("back")},Tapshare:function(){this.$emit("Share")}}};e.default=a},"1d18":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"nav align-items",class:t.showBorder?"boderBottom":"",style:{marginTop:t.statusBarHeight}},[t.arrow?n("v-uni-view",{staticClass:"left-arrow flex-center",on:{click:function(e){e=t.$handleEvent(e),t.goback(e)}}},[n("v-uni-view")],1):n("v-uni-view",{staticClass:"close flex-center",on:{click:function(e){e=t.$handleEvent(e),t.goback(e)}}},[n("v-uni-image",{attrs:{src:"/static/images/black_colse.png",mode:""}})],1),n("v-uni-view",{staticClass:"title ellipsis"},[t._v(t._s(t.title))]),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.share,expression:"share"}],staticClass:"dot flex-center",on:{click:function(e){e=t.$handleEvent(e),t.Tapshare(e)}}},[n("v-uni-view"),n("v-uni-view"),n("v-uni-view")],1)],1),n("v-uni-view",{staticClass:"margin-bottom"})],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"26c5":function(t,e,n){"use strict";n.r(e);var a=n("8738"),i=n("dcd0");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("2fa6");var r=n("2877"),s=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"3d7651de",null);e["default"]=s.exports},"2fa6":function(t,e,n){"use strict";var a=n("4611"),i=n.n(a);i.a},4611:function(t,e,n){var a=n("c41d");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("2ea4fda0",a,!0,{sourceMap:!1,shadowMode:!1})},"4c06":function(t,e,n){"use strict";n.r(e);var a=n("5f1b9"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},"4e69":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 状态栏 */.status_bar[data-v-e5327a8c]{height:0;width:100%;background-color:#fff}.top_view[data-v-e5327a8c]{height:0;width:100%;position:fixed;background-color:#fff;top:0;z-index:9999}",""])},"541d":function(t,e,n){var a=n("4e69");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("79182a61",a,!0,{sourceMap:!1,shadowMode:!1})},"5f1b9":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={data:function(){return{statusBarHeight:""}},onLoad:function(){}};e.default=a},"5f59":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"status_bar"},[n("v-uni-view",{staticClass:"top_view"})],1)],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"67a3":function(t,e,n){var a=n("6f06");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("43d2adf7",a,!0,{sourceMap:!1,shadowMode:!1})},"6f06":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,'.nav[data-v-74166a98]{width:100%;height:%?90?%;position:fixed;top:0;\n\t\n\ttop:0;\n\tleft:0;z-index:99;background-color:#fff}.boderBottom[data-v-74166a98]{border-bottom:%?1?% solid #e9e9e9}.left-arrow[data-v-74166a98]{width:%?100?%;height:%?90?%;position:absolute}.left-arrow[data-v-74166a98] :after{content:"";width:%?22?%;height:%?22?%;position:absolute;margin-top:%?-11?%;margin-left:%?-11?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-left:%?4?% solid #222;border-bottom:%?4?% solid #222}.nav .close[data-v-74166a98]{width:%?100?%;height:%?90?%;position:absolute}.nav .close uni-image[data-v-74166a98]{width:%?30?%;height:%?30?%}.nav .title[data-v-74166a98]{width:%?550?%;font-size:%?34?%;line-height:%?90?%;color:#222;margin:0 auto;text-align:center}.nav .dot[data-v-74166a98]{position:absolute;width:%?100?%;height:%?89?%;top:0;right:%?10?%}.nav .dot uni-view[data-v-74166a98]{width:%?9?%;height:%?9?%;margin-left:%?10?%;border-radius:100%;background-color:#222}.margin-bottom[data-v-74166a98]{margin-bottom:%?90?%}',""])},8738:function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"comment-box"},[n("v-uni-view",{staticClass:"header flex-row"},[n("v-uni-view",{staticClass:"header-face"},[n("v-uni-image",{attrs:{src:t.replyUserAvatar,mode:"aspectFill","lazy-load":""}})],1),n("v-uni-view",{staticClass:"header-name"},[n("v-uni-view",{staticClass:"name"},[n("v-uni-text",[t._v(t._s(t.item.user_name))])],1)],1)],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.item.reply_content,expression:"item.reply_content"}],staticClass:"revert flex-row"},[n("v-uni-text",{staticClass:"revert-name"},[t._v(t._s(t.item.reply_name)+"：")]),n("v-uni-rich-text",{staticClass:"revert-content",attrs:{nodes:t.item.reply_content}})],1),n("v-uni-view",{staticClass:"comment-content"},[n("v-uni-rich-text",{attrs:{nodes:t.item.content}})],1),n("v-uni-view",{staticClass:"comment-bottom align-items",class:0==t.showReply?"":"boderBottom"},[n("v-uni-view",{staticClass:"left flex-row align-items"},[n("v-uni-view",{staticClass:"time"},[n("v-uni-text",[t._v(t._s(t.item.date_time))])],1),n("v-uni-view",{staticClass:"reply flex-center",on:{click:function(e){e=t.$handleEvent(e),t.reply(e)}}},[n("v-uni-text",{staticClass:"huifu"},[t._v("回复")])],1)],1),n("v-uni-view",{staticClass:"right flex-row"},[n("v-uni-view",{staticClass:"bottom-list align-items like",attrs:{"data-id":t.item.id},on:{click:function(e){e=t.$handleEvent(e),t.commentLike(e)}}},[n("v-uni-image",{attrs:{src:0===t.item.is_praise?"../../static/images/commentisLike.png":"../../static/images/commentLike.png"}}),n("v-uni-text",{staticClass:"bottom-list-number",class:0===t.item.is_praise?"":"active"},[t._v(t._s(0==t.item.praise_num||null==t.item.praise_num?"":t.item.praise_num))])],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.showReply,expression:"showReply"}],staticClass:"bottom-list align-items replyComment",attrs:{"data-id":t.item.id},on:{click:function(e){e=t.$handleEvent(e),t.goReply(e)}}},[n("v-uni-image",{attrs:{src:"../../static/images/reply.png"}}),n("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(t.item.replyNum))])],1)],1)],1)],1)],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},a64c:function(t,e,n){"use strict";n.r(e);var a=n("0a46"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},ab1b:function(t,e,n){"use strict";var a=n("67a3"),i=n.n(a);i.a},bb50:function(t,e,n){"use strict";n.r(e);var a=n("1d18"),i=n("a64c");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("ab1b");var r=n("2877"),s=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"74166a98",null);e["default"]=s.exports},bd1a:function(t,e,n){"use strict";n.r(e);var a=n("5f59"),i=n("4c06");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("f633");var r=n("2877"),s=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"e5327a8c",null);e["default"]=s.exports},c41d:function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 评论区 */.comment-box[data-v-3d7651de]{padding:%?40?% %?21?% %?0?% %?21?%;background-color:#fff}.comment-box .header[data-v-3d7651de]{height:%?70?%}.comment-box .header .header-face[data-v-3d7651de]{width:%?70?%;height:%?70?%;-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;overflow:hidden}.header .header-face uni-image[data-v-3d7651de]{width:%?70?%;height:%?70?%;border-radius:100%}.comment-box .header .header-name[data-v-3d7651de]{height:%?70?%;margin-left:%?13?%}.header .header-name .name[data-v-3d7651de]{font-size:%?28?%;line-height:%?70?%;color:#222}.comment-box .revert[data-v-3d7651de]{margin:%?0?% %?0?% %?10?% %?73?%;background-color:#f2f2f2;font-size:%?26?%;border-radius:%?10?%;padding:%?20?% %?22?%;line-height:1.5em}.revert .revert-name[data-v-3d7651de]{color:#71b1fe}.revert .revert-content[data-v-3d7651de]{color:#757576}.comment-box .comment-content[data-v-3d7651de]{font-size:%?30?%;color:#3b3b3b;margin-left:%?73?%}.comment-box .comment-bottom[data-v-3d7651de]{height:%?70?%;margin:%?20?% %?0?% %?0?% %?73?%;padding-bottom:%?10?%;position:relative}.boderBottom[data-v-3d7651de]{border-bottom:%?1?% solid #f5f5f5}.comment-bottom .left[data-v-3d7651de]{height:%?70?%}.comment-bottom .left .time[data-v-3d7651de]{font-size:%?26?%;color:#a2a7af;margin-right:%?15?%}.comment-bottom .reply[data-v-3d7651de]{width:%?90?%;height:%?40?%;background-color:#f8f8f8;border-radius:%?45?%}.comment-bottom .reply .huifu[data-v-3d7651de]{color:#8c8c8c;font-size:%?26?%}.comment-bottom .right[data-v-3d7651de]{height:%?70?%;position:absolute;right:%?25?%}.comment-bottom .right .replyComment[data-v-3d7651de]{margin-left:%?34?%}.comment-bottom .right .bottom-list uni-image[data-v-3d7651de]{width:%?35?%;height:%?35?%;opacity:1}.comment-bottom .bottom-list .bottom-list-number[data-v-3d7651de]{margin-left:%?5?%;color:#9d9d9d;font-size:%?24?%;padding-top:%?14?%}.comment-bottom .bottom-list .active[data-v-3d7651de]{color:#ffd954}",""])},dcd0:function(t,e,n){"use strict";n.r(e);var a=n("063f"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},f633:function(t,e,n){"use strict";var a=n("541d"),i=n.n(a);i.a}}]);