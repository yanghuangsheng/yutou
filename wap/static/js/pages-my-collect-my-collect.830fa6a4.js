(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-my-collect-my-collect"],{"0ed6":function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,'.wrap[data-v-3d60cd1e]{width:%?750?%;margin-top:%?90?%}.wrap .top[data-v-3d60cd1e]{width:100%;height:%?89?%;position:fixed;\r\n\tleft:0;z-index:99;background-color:#fff;border-bottom:%?2?% solid #e9e9e9}.left-arrow[data-v-3d60cd1e]{width:%?100?%;height:%?89?%;position:absolute;top:0;left:0}.left-arrow[data-v-3d60cd1e] :after{content:"";width:%?25?%;height:%?25?%;position:absolute;margin-top:%?-13?%;left:%?35?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-left:%?4?% solid #adadad;border-bottom:%?4?% solid #adadad}.top .center[data-v-3d60cd1e]{margin:0 auto;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.top .center .tab-title[data-v-3d60cd1e]{font-size:%?32?%;color:#737373;margin:%?0?% %?30?%}.top .center .active[data-v-3d60cd1e]{color:#f4cc7e;font-size:%?34?%;z-index:99}.content[data-v-3d60cd1e]{margin-top:%?90?%}',""])},"1b5a":function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=d(i("065c")),n=d(i("d8ec")),o=d(i("7dde")),s=d(i("834a")),l=d(i("1193"));function d(t){return t&&t.__esModule?t:{default:t}}var r={components:{statusBar:a.default,pageLoading:n.default,collectNewsList:o.default,releaseContent:s.default,loadMore:l.default},data:function(){return{page_status:0,loadingType:0,show:!0,tab_index:0,tab_data:["资讯","论坛"],news_list:[],post_list:[],statusBarHeight:""}},onLoad:function(){this._onLoad()},onReachBottom:function(){this._onLoadMore()},methods:{tab:function(t){this.tab_index=t},goBack:function(){uni.navigateBack({delta:1,animationType:"pop-out",animationDuration:200})},setLoadingType:function(t){this.loadingType=t.status},onRefresh:function(){this._onLoad()},_onLoad:function(){var t=this,e=this,i=this.$tool.getUserData().id;if(!i)return e.page_status=1,!1;e.page_status=0;var a=setTimeout(function(){e.$tool.loadFail(e)},6e3);this.$http.get("user/collect",{user_id:i}).then(function(e){console.log(e),0==e.code&&(t.news_list=e.data.news_list,t.post_list=e.data.post_list,t.start_id=e.data.start_id,t.page=1),t.page_status=1,clearTimeout(a)}).catch(function(t){console.log("err")})},_onLoadMore:function(){var t=this,e=this.$tool.getUserData().id;if(!e)return!1;var i=this.tab_index,a=i?"post_list":"news_list";0==this.loadingType&&(this.loadingType=1,this.$http.get("user/more_collect",{user_id:e,page:this.page+1,type:a,start_id:this.start_id}).then(function(e){console.log(e);var a=e.data;if(0==a.length)return t.loadingType=2,!1;1==i?t.post_list=t.post_list.concat(a):t.news_list=t.news_list.concat(a),t.page++,t.loadingType=0}).catch(function(t){console.log("more_err")}))}}};e.default=r},"212f":function(t,e,i){var a=i("3b24");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("7deddfd4",a,!0,{sourceMap:!1,shadowMode:!1})},"23e8":function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",t._l(t.list,function(e,a){return i("v-uni-view",{key:a,staticClass:"uni-list uni-flex",attrs:{"data-id":e.id},on:{click:function(e){e=t.$handleEvent(e),t.goTo_news(e)}}},[i("v-uni-view",{staticClass:" uni-list-cell uni-column",attrs:{"hover-class":"uni-list-cell-hover"}},[i("v-uni-view",{staticClass:"uni-media-list"},[i("v-uni-image",{staticClass:"uni-media-list-logo",attrs:{src:e.image_url,"lazy-load":""}}),i("v-uni-view",{staticClass:"uni-media-list-body"},[i("v-uni-view",{staticClass:"uni-media-list-text-top"},[t._v(t._s(e.title))]),i("v-uni-view",{staticClass:"uni-media-list-text-bottom"},[i("v-uni-text",[t._v(t._s(e.source_name?e.source_name:e.author))]),i("v-uni-text",[t._v(t._s(e.create_time))])],1)],1)],1)],1)],1)}),1)},n=[];i.d(e,"a",function(){return a}),i.d(e,"b",function(){return n})},"33d8":function(t,e,i){"use strict";var a=i("af93"),n=i.n(a);n.a},"3b24":function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,'.uni-list[data-v-288ad1fd]{background-color:#fff;position:relative;width:100%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}.uni-list-cell[data-v-288ad1fd]{position:relative;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.uni-list-cell-hover[data-v-288ad1fd]{background-color:#eee}.uni-media-list[data-v-288ad1fd]{-webkit-box-sizing:border-box;box-sizing:border-box;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;width:100%;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;padding:%?37?% %?25?%}.uni-media-list-logo[data-v-288ad1fd]{width:%?230?%;height:%?150?%;margin-right:%?20?%;padding-right:%?15?%}.uni-media-list-logo uni-image[data-v-288ad1fd]{height:100%;width:100%}.uni-media-list-body[data-v-288ad1fd]{height:auto;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start;overflow:hidden;-webkit-justify-content:space-around;-ms-flex-pack:distribute;justify-content:space-around}.uni-media-list-text-top[data-v-288ad1fd]{width:100%;height:%?108?%;overflow:hidden;color:#282828;line-height:1.7em;font-size:%?30?%}.uni-media-list-text-bottom[data-v-288ad1fd]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;color:#c6c0c0;font-size:%?24?%;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;width:100%}.uni-list[data-v-288ad1fd]:after{position:absolute;z-index:10;right:%?20?%;bottom:0;left:%?20?%;height:%?1?%;content:"";-webkit-transform:scaleY(.5);-ms-transform:scaleY(.5);transform:scaleY(.5);background-color:#e9e9e9}',""])},"7dde":function(t,e,i){"use strict";i.r(e);var a=i("23e8"),n=i("a4d0");for(var o in n)"default"!==o&&function(t){i.d(e,t,function(){return n[t]})}(o);i("a7fd");var s=i("2877"),l=Object(s["a"])(n["default"],a["a"],a["b"],!1,null,"288ad1fd",null);e["default"]=l.exports},"8bfd":function(t,e,i){"use strict";i.r(e);var a=i("fbbf"),n=i("956b");for(var o in n)"default"!==o&&function(t){i.d(e,t,function(){return n[t]})}(o);i("33d8");var s=i("2877"),l=Object(s["a"])(n["default"],a["a"],a["b"],!1,null,"3d60cd1e",null);e["default"]=l.exports},"956b":function(t,e,i){"use strict";i.r(e);var a=i("1b5a"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,function(){return a[t]})}(o);e["default"]=n.a},a4d0:function(t,e,i){"use strict";i.r(e);var a=i("d8c4"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,function(){return a[t]})}(o);e["default"]=n.a},a7fd:function(t,e,i){"use strict";var a=i("212f"),n=i.n(a);n.a},af93:function(t,e,i){var a=i("0ed6");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("701a3778",a,!0,{sourceMap:!1,shadowMode:!1})},d8c4:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{list:{type:Array,default:function(){}}},data:function(){return{}},methods:{goTo_news:function(t){uni.navigateTo({url:"../news-detail/news-detail?id="+this.$tool.getDataSet(t,"id"),animationDuration:400})}}};e.default=a},fbbf:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"index"},[1==t.page_status?i("v-uni-view",{staticClass:"wrap"},[i("v-uni-view",{staticClass:"top uni-flex",style:{marginTop:t.statusBarHeight}},[i("v-uni-view",{staticClass:"left-arrow uni-inline-item",on:{click:function(e){e=t.$handleEvent(e),t.goBack(e)}}},[i("v-uni-view")],1),i("v-uni-view",{staticClass:"center uni-flex"},t._l(t.tab_data,function(e,a){return i("v-uni-view",{key:a,staticClass:"tab-title",class:{active:t.tab_index==a},on:{click:function(e){e=t.$handleEvent(e),t.tab(a)}}},[i("v-uni-text",[t._v(t._s(e))])],1)}),1)],1),i("v-uni-view",{staticClass:"content"},[0==t.tab_index?i("collect-news-list",{attrs:{list:t.news_list},on:{click:function(e){e=t.$handleEvent(e),t.goTo_news(e)}}}):i("release-content",{attrs:{list:t.post_list,isShow:t.show,showTime:t.show}}),i("load-more",{attrs:{loading_type:t.loadingType},on:{"set-status":function(e){e=t.$handleEvent(e),t.setLoadingType(e)}}})],1)],1):i("page-loading",{attrs:{pageStatus:t.page_status},on:{reload:function(e){e=t.$handleEvent(e),t.onRefresh(e)}}})],1)},n=[];i.d(e,"a",function(){return a}),i.d(e,"b",function(){return n})}}]);