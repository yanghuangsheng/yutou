(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-my-collect-my-collect"],{"04ed":function(t,e,i){"use strict";var a=i("5bdf"),n=i.n(a);n.a},"04f8":function(t,e,i){"use strict";i.r(e);var a=i("2126"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,function(){return a[t]})}(o);e["default"]=n.a},"073a":function(t,e,i){"use strict";var a=i("6abf"),n=i.n(a);n.a},1193:function(t,e,i){"use strict";i.r(e);var a=i("f1ce"),n=i("04f8");for(var o in n)"default"!==o&&function(t){i.d(e,t,function(){return n[t]})}(o);i("a4f9");var s=i("2877"),l=Object(s["a"])(n["default"],a["a"],a["b"],!1,null,"0da82823",null);e["default"]=l.exports},"1b5a":function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=l(i("d8ec")),n=l(i("7dde")),o=l(i("834a")),s=l(i("1193"));function l(t){return t&&t.__esModule?t:{default:t}}var r={components:{pageLoading:a.default,collectNewsList:n.default,releaseContent:o.default,loadMore:s.default},data:function(){return{page_status:0,loadingType:0,show:!0,tab_index:0,tab_data:["资讯","论坛"],news_list:[],post_list:[]}},onLoad:function(){this._onLoad()},onReachBottom:function(){this._onLoadMore()},methods:{tab:function(t){this.tab_index=t},goBack:function(){uni.navigateBack({delta:1,animationType:"pop-out",animationDuration:200})},setLoadingType:function(t){this.loadingType=t.status},onRefresh:function(){this._onLoad()},_onLoad:function(){var t=this,e=this,i=this.$tool.getUserData().id;if(!i)return e.page_status=1,!1;e.page_status=0;var a=setTimeout(function(){e.$tool.loadFail(e)},6e3);this.$http.get("user/collect",{user_id:i}).then(function(e){console.log(e),0==e.code&&(t.news_list=e.data.news_list,t.post_list=e.data.post_list,t.start_id=e.data.start_id,t.page=1),t.page_status=1,clearTimeout(a)}).catch(function(t){console.log("err")})},_onLoadMore:function(){var t=this,e=this.$tool.getUserData().id;if(!e)return!1;var i=this.tab_index,a=i?"post_list":"news_list";0==this.loadingType&&(this.loadingType=1,this.$http.get("user/more_collect",{user_id:e,page:this.page+1,type:a,start_id:this.start_id}).then(function(e){console.log(e);var a=e.data;if(0==a.length)return t.loadingType=2,!1;1==i?t.post_list=t.post_list.concat(a):t.news_list=t.news_list.concat(a),t.page++,t.loadingType=0}).catch(function(t){console.log("more_err")}))}}};e.default=r},2126:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{loading_type:{type:Number,default:1},time:{type:Number,default:1e3},color:{type:String,default:"#777777"}},data:function(){return{image_show:!0,loading_txt:""}},computed:{returnMoreStatus:function(){var t=this;return 0===t.loading_type?(t.image_show=!0,!1):2===t.loading_type?(t.image_show=!1,t.loading_txt="没有更多了",t._setStatus(),!0):1===t.loading_type?(t.loading_txt="正在加载 ...",t.image_show=!0,!0):void 0}},methods:{_setStatus:function(){var t=this;setTimeout(function(){t.$emit("set-status",{status:0})},this.time)}}};e.default=a},"5bdf":function(t,e,i){var a=i("dafe");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("e3b965f4",a,!0,{sourceMap:!1,shadowMode:!1})},6375:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",t._l(t.list,function(e,a){return i("v-uni-view",{key:a,staticClass:"uni-list uni-flex",attrs:{"data-id":e.id},on:{click:function(e){e=t.$handleEvent(e),t.goTo_news(e)}}},[i("v-uni-view",{staticClass:" uni-list-cell uni-column",attrs:{"hover-class":"uni-list-cell-hover"}},[i("v-uni-view",{staticClass:"uni-media-list"},[i("v-uni-image",{staticClass:"uni-media-list-logo",attrs:{src:e.image_url}}),i("v-uni-view",{staticClass:"uni-media-list-body"},[i("v-uni-view",{staticClass:"uni-media-list-text-top"},[t._v(t._s(e.title))]),i("v-uni-view",{staticClass:"uni-media-list-text-bottom"},[i("v-uni-text",[t._v(t._s(e.source_name?e.source_name:e.author))]),i("v-uni-text",[t._v(t._s(e.create_time))])],1)],1)],1)],1)],1)}),1)},n=[];i.d(e,"a",function(){return a}),i.d(e,"b",function(){return n})},"68c7":function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,".load-more[data-v-0da82823]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;height:%?80?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center}.loading-img[data-v-0da82823]{height:24px;width:24px;margin-right:10px}.loading-text[data-v-0da82823]{font-size:%?28?%;color:#777}.loading-img>uni-view[data-v-0da82823]{position:absolute}.load1[data-v-0da82823],.load2[data-v-0da82823],.load3[data-v-0da82823]{height:24px;width:24px}.load2[data-v-0da82823]{-webkit-transform:rotate(30deg);-ms-transform:rotate(30deg);transform:rotate(30deg)}.load3[data-v-0da82823]{-webkit-transform:rotate(60deg);-ms-transform:rotate(60deg);transform:rotate(60deg)}.loading-img>uni-view uni-view[data-v-0da82823]{width:6px;height:2px;border-top-left-radius:1px;border-bottom-left-radius:1px;background:#777;position:absolute;opacity:.2;-webkit-transform-origin:50%;-ms-transform-origin:50%;transform-origin:50%;-webkit-animation:load-data-v-0da82823 1.56s ease infinite}.loading-img>uni-view uni-view[data-v-0da82823]:first-child{-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg);top:2px;left:9px}.loading-img>uni-view uni-view[data-v-0da82823]:nth-child(2){-webkit-transform:rotate(180deg);top:11px;right:0}.loading-img>uni-view uni-view[data-v-0da82823]:nth-child(3){-webkit-transform:rotate(270deg);-ms-transform:rotate(270deg);transform:rotate(270deg);bottom:2px;left:9px}.loading-img>uni-view uni-view[data-v-0da82823]:nth-child(4){top:11px;left:0}.load1 uni-view[data-v-0da82823]:first-child{-webkit-animation-delay:0s;animation-delay:0s}.load2 uni-view[data-v-0da82823]:first-child{-webkit-animation-delay:.13s;animation-delay:.13s}.load3 uni-view[data-v-0da82823]:first-child{-webkit-animation-delay:.26s;animation-delay:.26s}.load1 uni-view[data-v-0da82823]:nth-child(2){-webkit-animation-delay:.39s;animation-delay:.39s}.load2 uni-view[data-v-0da82823]:nth-child(2){-webkit-animation-delay:.52s;animation-delay:.52s}.load3 uni-view[data-v-0da82823]:nth-child(2){-webkit-animation-delay:.65s;animation-delay:.65s}.load1 uni-view[data-v-0da82823]:nth-child(3){-webkit-animation-delay:.78s;animation-delay:.78s}.load2 uni-view[data-v-0da82823]:nth-child(3){-webkit-animation-delay:.91s;animation-delay:.91s}.load3 uni-view[data-v-0da82823]:nth-child(3){-webkit-animation-delay:1.04s;animation-delay:1.04s}.load1 uni-view[data-v-0da82823]:nth-child(4){-webkit-animation-delay:1.17s;animation-delay:1.17s}.load2 uni-view[data-v-0da82823]:nth-child(4){-webkit-animation-delay:1.3s;animation-delay:1.3s}.load3 uni-view[data-v-0da82823]:nth-child(4){-webkit-animation-delay:1.43s;animation-delay:1.43s}@-webkit-keyframes load-data-v-0da82823{0%{opacity:1}to{opacity:.2}}",""])},"6abf":function(t,e,i){var a=i("ca27");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("31b8d2c8",a,!0,{sourceMap:!1,shadowMode:!1})},"7dde":function(t,e,i){"use strict";i.r(e);var a=i("6375"),n=i("a4d0");for(var o in n)"default"!==o&&function(t){i.d(e,t,function(){return n[t]})}(o);i("ac9e");var s=i("2877"),l=Object(s["a"])(n["default"],a["a"],a["b"],!1,null,"b7c69204",null);e["default"]=l.exports},8094:function(t,e,i){var a=i("e29f");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("d3264e82",a,!0,{sourceMap:!1,shadowMode:!1})},"834a":function(t,e,i){"use strict";i.r(e);var a=i("dac7"),n=i("f93f");for(var o in n)"default"!==o&&function(t){i.d(e,t,function(){return n[t]})}(o);i("04ed");var s=i("2877"),l=Object(s["a"])(n["default"],a["a"],a["b"],!1,null,"350d285e",null);e["default"]=l.exports},"8bfd":function(t,e,i){"use strict";i.r(e);var a=i("b343"),n=i("956b");for(var o in n)"default"!==o&&function(t){i.d(e,t,function(){return n[t]})}(o);i("073a");var s=i("2877"),l=Object(s["a"])(n["default"],a["a"],a["b"],!1,null,"1483d248",null);e["default"]=l.exports},"956b":function(t,e,i){"use strict";i.r(e);var a=i("1b5a"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,function(){return a[t]})}(o);e["default"]=n.a},a4d0:function(t,e,i){"use strict";i.r(e);var a=i("d8c4"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,function(){return a[t]})}(o);e["default"]=n.a},a4f9:function(t,e,i){"use strict";var a=i("db47"),n=i.n(a);n.a},ac9e:function(t,e,i){"use strict";var a=i("8094"),n=i.n(a);n.a},b343:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"index"},[1==t.page_status?i("v-uni-view",{staticClass:"wrap"},[i("v-uni-view",{staticClass:"top uni-flex"},[i("v-uni-view",{staticClass:"left-arrow uni-inline-item",on:{click:function(e){e=t.$handleEvent(e),t.goBack(e)}}},[i("v-uni-view")],1),i("v-uni-view",{staticClass:"center uni-flex"},t._l(t.tab_data,function(e,a){return i("v-uni-view",{key:a,staticClass:"tab-title",class:{active:t.tab_index==a},on:{click:function(e){e=t.$handleEvent(e),t.tab(a)}}},[i("v-uni-text",[t._v(t._s(e))])],1)}),1)],1),i("v-uni-view",{staticClass:"content"},[0==t.tab_index?i("collect-news-list",{attrs:{list:t.news_list},on:{click:function(e){e=t.$handleEvent(e),t.goTo_news(e)}}}):i("release-content",{attrs:{list:t.post_list,isShow:t.show,showTime:t.show}}),i("load-more",{attrs:{loading_type:t.loadingType},on:{"set-status":function(e){e=t.$handleEvent(e),t.setLoadingType(e)}}})],1)],1):i("page-loading",{attrs:{pageStatus:t.page_status},on:{reload:function(e){e=t.$handleEvent(e),t.onRefresh(e)}}})],1)},n=[];i.d(e,"a",function(){return a}),i.d(e,"b",function(){return n})},b3d0:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",[i("v-uni-view",{staticClass:"loading"},[i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.loading_show,expression:"loading_show"}],staticClass:"loading-img"},[i("v-uni-view",{staticClass:"load1"},[i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}})],1),i("v-uni-view",{staticClass:"load2"},[i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}})],1),i("v-uni-view",{staticClass:"load3"},[i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}})],1)],1)],1),i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.error_show,expression:"error_show"}],staticClass:"load"},[i("v-uni-view",{staticClass:"load-img"},[i("v-uni-image",{attrs:{src:"/static/images/load.png"}})],1),i("v-uni-view",{staticClass:"prompt"},[i("v-uni-text",[t._v("加载失败了，等会再浪吧")])],1),i("v-uni-view",{staticClass:"reload uni-center",on:{click:function(e){e=t.$handleEvent(e),t.reload(e)}}},[i("v-uni-text",[t._v("重新加载")])],1)],1)],1)},n=[];i.d(e,"a",function(){return a}),i.d(e,"b",function(){return n})},b599:function(t,e,i){"use strict";i.r(e);var a=i("f6f4"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,function(){return a[t]})}(o);e["default"]=n.a},ca27:function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,'.wrap[data-v-1483d248]{width:%?750?%;margin-top:%?90?%}.wrap .top[data-v-1483d248]{width:100%;height:%?89?%;position:fixed;\r\n\tleft:0;z-index:99;background-color:#fff;border-bottom:%?2?% solid #e9e9e9}.left-arrow[data-v-1483d248]{width:%?100?%;height:%?89?%;position:absolute;top:0;left:0}.left-arrow[data-v-1483d248] :after{content:"";width:%?25?%;height:%?25?%;position:absolute;margin-top:%?-13?%;left:%?35?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-left:%?4?% solid #adadad;border-bottom:%?4?% solid #adadad}.top .center[data-v-1483d248]{margin:0 auto;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.top .center .tab-title[data-v-1483d248]{font-size:%?32?%;color:#737373;margin:%?0?% %?30?%}.top .center .active[data-v-1483d248]{color:#f4cc7e;font-size:%?34?%;z-index:99}.content[data-v-1483d248]{margin-top:%?90?%}',""])},d67d:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{list:{type:Array,default:function(){}},isShow:{type:Boolean,default:!0},showTime:{type:Boolean,default:!0}},data:function(){return{}},methods:{goDetail:function(t){var e=this.$tool.getDataSet(t,"id");uni.navigateTo({url:"../community-detail/community-detail?id="+e,animationDuration:400})}}};e.default=a},d8c4:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{list:{type:Array,default:function(){}}},data:function(){return{}},methods:{goTo_news:function(t){uni.navigateTo({url:"../news-detail/news-detail?id="+this.$tool.getDataSet(t,"id"),animationDuration:400})}}};e.default=a},d8ec:function(t,e,i){"use strict";i.r(e);var a=i("b3d0"),n=i("b599");for(var o in n)"default"!==o&&function(t){i.d(e,t,function(){return n[t]})}(o);var s=i("2877"),l=Object(s["a"])(n["default"],a["a"],a["b"],!1,null,"066967ad",null);e["default"]=l.exports},dac7:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",[i("v-uni-view",{staticClass:"release"},t._l(t.list,function(e,a){return i("v-uni-view",{key:a,staticClass:"release-list"},[i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.isShow,expression:"isShow"}],staticClass:"release-top uni-flex"},[i("v-uni-view",{staticClass:"release-face"},[i("v-uni-image",{attrs:{src:e.user_avatar}})],1),i("v-uni-view",{staticClass:"release-name uni-flex"},[i("v-uni-view",{staticClass:"release-name-top"},[i("v-uni-text",[t._v(t._s(e.user_name))])],1),i("v-uni-view",{staticClass:"release-name-time"},[i("v-uni-text",[t._v(t._s(e.create_time))])],1)],1)],1),i("v-uni-view",{staticClass:"release-news",attrs:{"data-id":e.post_id?e.post_id:e.id},on:{click:function(e){e=t.$handleEvent(e),t.goDetail(e)}}},[i("v-uni-view",{staticClass:"news-title"},[i("v-uni-text",[t._v(t._s(e.title))])],1),i("v-uni-view",{staticClass:"news-content"},[i("v-uni-text",{staticClass:"main-content"},[t._v(t._s(e.description))]),i("v-uni-text",{staticClass:"detail"},[t._v("详情")])],1)],1),i("v-uni-view",{staticClass:"picture"},[i("v-uni-scroll-view",{staticClass:"news-img",attrs:{"scroll-x":"true","scroll-left":"0"}},[t._l(e.image_url,function(t,e){return[i("v-uni-view",{key:e+"_0",staticClass:"image-1"},[i("v-uni-image",{attrs:{src:t,mode:"aspectFill"}})],1)]})],2)],1),i("v-uni-view",{staticClass:"news-bottom uni-flex"},[i("v-uni-view",{staticClass:"bottom-list uni-flex",on:{click:function(e){e=t.$handleEvent(e),t.like(t.index)}}},[i("v-uni-image",{attrs:{src:0===e.islike?"../../static/images/like.png":"../../static/images/islike.png"}}),i("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(e.praise_num?e.praise_num:""))])],1),i("v-uni-view",{staticClass:"bottom-list uni-flex"},[i("v-uni-image",{attrs:{src:"../../static/images/reply.png"}}),i("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(e.comment_num?e.comment_num:""))])],1),i("v-uni-view",{staticClass:"bottom-list uni-flex"},[i("v-uni-image",{attrs:{src:"../../static/images/transmit.png"}}),i("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(e.transmit_num))])],1),i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.showTime,expression:"showTime"}],staticClass:"bottom-list uni-flex"},[i("v-uni-text",{staticClass:"bottom-list-number"},[t._v(t._s(e.create_time))])],1)],1)],1)}),1)],1)},n=[];i.d(e,"a",function(){return a}),i.d(e,"b",function(){return n})},dafe:function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* 内容 */.release .release-list[data-v-350d285e]{padding:%?30?% %?20?% %?10?% %?20?%;border-bottom:%?1?% solid #f5f5f5}.release .release-list .release-top[data-v-350d285e]{height:%?70?%;margin-bottom:%?25?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;position:relative}.release .release-top .release-face[data-v-350d285e]{width:%?70?%;height:%?70?%;border-radius:100%;-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;overflow:hidden}.release .release-top .release-face uni-image[data-v-350d285e]{width:%?70?%;height:%?70?%;border-radius:100%}.release .release-top .release-name[data-v-350d285e]{height:%?70?%;margin-left:%?20?%;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}.release .release-name .release-name-top[data-v-350d285e]{font-size:%?28?%;color:#626262;line-height:1.5em}.release .release-name .release-name-time[data-v-350d285e]{font-size:%?24?%;color:#bcbcbc;line-height:1.5em}.release .release-news .news-title[data-v-350d285e]{font-size:%?32?%;color:#4f4f4f;line-height:1.6em}.release .release-news .news-content[data-v-350d285e]{margin-top:%?20?%;font-size:%?30?%;line-height:1.6em}.release .news-content .main-content[data-v-350d285e]{color:#989898}.release .news-content .detail[data-v-350d285e]{color:#eaa918}.release .release-list .picture[data-v-350d285e]{white-space:nowrap;margin-top:%?25?%;height:129px}.picture .news-img .image-1[data-v-350d285e]{display:inline-block;background-color:#eee;line-height:%?0?%;width:218px;height:129px;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;margin-left:%?5?%}.news-img .image-1[data-v-350d285e]:first-child{margin-left:%?0?%}.news-img .image-1 uni-image[data-v-350d285e]{width:100%;height:100%}.release .release-list .news-bottom[data-v-350d285e]{height:%?70?%;margin-top:%?20?%;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between}.release .news-bottom .bottom-list[data-v-350d285e]{height:%?70?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.bottom-list uni-image[data-v-350d285e]{width:%?35?%;height:%?35?%}.bottom-list-number[data-v-350d285e]{color:#9d9d9d;margin-left:%?10?%}",""])},db47:function(t,e,i){var a=i("68c7");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("3ab169ac",a,!0,{sourceMap:!1,shadowMode:!1})},e29f:function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,'.uni-list[data-v-b7c69204]{background-color:#fff;position:relative;width:100%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}.uni-list-cell[data-v-b7c69204]{position:relative;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.uni-list-cell-hover[data-v-b7c69204]{background-color:#eee}.uni-media-list[data-v-b7c69204]{-webkit-box-sizing:border-box;box-sizing:border-box;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;width:100%;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;padding:%?37?% %?25?%}.uni-media-list-logo[data-v-b7c69204]{width:%?230?%;height:%?150?%;margin-right:%?20?%;padding-right:%?15?%}.uni-media-list-logo uni-image[data-v-b7c69204]{height:100%;width:100%}.uni-media-list-body[data-v-b7c69204]{height:auto;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start;overflow:hidden;-webkit-justify-content:space-around;-ms-flex-pack:distribute;justify-content:space-around}.uni-media-list-text-top[data-v-b7c69204]{width:100%;height:%?108?%;overflow:hidden;color:#282828;line-height:1.7em;font-size:%?30?%}.uni-media-list-text-bottom[data-v-b7c69204]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;color:#c6c0c0;font-size:%?24?%;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;width:100%}.uni-list[data-v-b7c69204]:after{position:absolute;z-index:10;right:%?20?%;bottom:0;left:%?20?%;height:%?1?%;content:"";-webkit-transform:scaleY(.5);-ms-transform:scaleY(.5);transform:scaleY(.5);background-color:#e9e9e9}',""])},f1ce:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.returnMoreStatus,expression:"returnMoreStatus"}],staticClass:"load-more"},[i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.image_show,expression:"image_show"}],staticClass:"loading-img"},[i("v-uni-view",{staticClass:"load1"},[i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}})],1),i("v-uni-view",{staticClass:"load2"},[i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}})],1),i("v-uni-view",{staticClass:"load3"},[i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}}),i("v-uni-view",{style:{background:t.color}})],1)],1),i("v-uni-text",{staticClass:"loading-text"},[t._v(t._s(t.loading_txt))])],1)},n=[];i.d(e,"a",function(){return a}),i.d(e,"b",function(){return n})},f6f4:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{color:{type:String,default:"#777777"},pageStatus:{type:Number}},data:function(){return{}},computed:{loading_show:function(){return 0==this.pageStatus},error_show:function(){return 2==this.pageStatus}},methods:{reload:function(){this.$emit("reload")}}};e.default=a},f93f:function(t,e,i){"use strict";i.r(e);var a=i("d67d"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,function(){return a[t]})}(o);e["default"]=n.a}}]);