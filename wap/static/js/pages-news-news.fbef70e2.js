(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-news-news"],{"08e6":function(t,e,n){"use strict";n.r(e);var a=n("3c3e"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},"0a46":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={name:"custom-nav",props:{title:{type:String},share:{type:Boolean,default:!1},arrow:{type:Boolean,default:!0},showBorder:{type:Boolean,default:!0}},data:function(){return{statusBarHeight:""}},onLoad:function(){},methods:{goback:function(){this.$emit("back")},Tapshare:function(){this.$emit("Share")}}};e.default=a},"1d18":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"nav align-items",class:t.showBorder?"boderBottom":"",style:{marginTop:t.statusBarHeight}},[t.arrow?n("v-uni-view",{staticClass:"left-arrow flex-center",on:{click:function(e){e=t.$handleEvent(e),t.goback(e)}}},[n("v-uni-view")],1):n("v-uni-view",{staticClass:"close flex-center",on:{click:function(e){e=t.$handleEvent(e),t.goback(e)}}},[n("v-uni-image",{attrs:{src:"/static/images/black_colse.png",mode:""}})],1),n("v-uni-view",{staticClass:"title ellipsis"},[t._v(t._s(t.title))]),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.share,expression:"share"}],staticClass:"dot flex-center",on:{click:function(e){e=t.$handleEvent(e),t.Tapshare(e)}}},[n("v-uni-view"),n("v-uni-view"),n("v-uni-view")],1)],1),n("v-uni-view",{staticClass:"margin-bottom"})],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"23ae":function(t,e,n){"use strict";n.r(e);var a=n("d0e6"),i=n("d407");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("8627");var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"28a16214",null);e["default"]=r.exports},3120:function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"loading"},[n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.loading_show,expression:"loading_show"}],staticClass:"loading-img"},[n("v-uni-view",{staticClass:"load1"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load2"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load3"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1)],1)],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.error_show,expression:"error_show"}],staticClass:"load"},[n("v-uni-view",{staticClass:"load-img"},[n("v-uni-image",{attrs:{src:"/static/images/load.png"}})],1),n("v-uni-view",{staticClass:"prompt"},[n("v-uni-text",[t._v("加载失败了，等会再浪吧")])],1),n("v-uni-view",{staticClass:"reload flex-center",on:{click:function(e){e=t.$handleEvent(e),t.reload(e)}}},[n("v-uni-text",[t._v("重新加载")])],1)],1)],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"363f":function(t,e,n){var a=n("66c8d");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("f8c7580a",a,!0,{sourceMap:!1,shadowMode:!1})},"37bd":function(t,e,n){"use strict";n.r(e);var a=n("3120"),i=n("6369");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("91ec");var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"315755b8",null);e["default"]=r.exports},"37d8":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{color:{type:String,default:"#777777"},pageStatus:{type:Number}},data:function(){return{}},computed:{loading_show:function(){return 0==this.pageStatus},error_show:function(){return 2==this.pageStatus}},methods:{reload:function(){this.$emit("reload")}}};e.default=a},"3aee":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{staticClass:"index"},[1==t.page_status?n("v-uni-view",{staticClass:"wrap"},[n("custom-nav",{attrs:{title:t.title},on:{back:function(e){e=t.$handleEvent(e),t.tapBack(e)}}}),t._l(t.news_list,function(e,a){return[n("news-list",{key:a+"_0",attrs:{item:e,type:t.type},on:{click:function(e){e=t.$handleEvent(e),t.TapNews(e)}}})]}),n("load-more",{attrs:{loading_type:t.loadingType},on:{"set-status":function(e){e=t.$handleEvent(e),t.setLoadingType(e)}}})],2):n("page-loading",{attrs:{pageStatus:t.page_status},on:{reload:function(e){e=t.$handleEvent(e),t.onRefresh(e)}}})],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"3c3e":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{loading_type:{type:Number,default:1},time:{type:Number,default:1e3},color:{type:String,default:"#777777"}},data:function(){return{image_show:!0,loading_txt:""}},computed:{returnMoreStatus:function(){var t=this;return 0===t.loading_type?(t.image_show=!0,!1):2===t.loading_type?(t.image_show=!1,t.loading_txt="没有更多了",t._setStatus(),!0):1===t.loading_type?(t.loading_txt="正在加载 ...",t.image_show=!0,!0):void 0}},methods:{_setStatus:function(){var t=this;setTimeout(function(){t.$emit("set-status",{status:0})},this.time)}}};e.default=a},"4c06":function(t,e,n){"use strict";n.r(e);var a=n("5f1b9"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},"4e69":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 状态栏 */.status_bar[data-v-e5327a8c]{height:0;width:100%;background-color:#fff}.top_view[data-v-e5327a8c]{height:0;width:100%;position:fixed;background-color:#fff;top:0;z-index:9999}",""])},"53c0":function(t,e,n){"use strict";var a=n("8073"),i=n.n(a);i.a},"541d":function(t,e,n){var a=n("4e69");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("79182a61",a,!0,{sourceMap:!1,shadowMode:!1})},5883:function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,"uni-page-body[data-v-7d9f54f6]{background-color:#fff}body.?%PAGE?%[data-v-7d9f54f6]{background-color:#fff}",""])},"5f1b9":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={data:function(){return{statusBarHeight:""}},onLoad:function(){}};e.default=a},"5f59":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"status_bar"},[n("v-uni-view",{staticClass:"top_view"})],1)],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},6369:function(t,e,n){"use strict";n.r(e);var a=n("37d8"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},"66c8d":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,".loading[data-v-315755b8]{position:absolute;left:50%;top:50%;margin-left:%?-24?%;margin-top:%?-24?%}\n/* 加载失败 */.load[data-v-315755b8]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;position:absolute;left:50%;top:50%;margin-top:%?-256?%;margin-left:%?-178?%}.load-img uni-image[data-v-315755b8]{width:%?357?%;height:%?341?%}.prompt[data-v-315755b8]{font-size:%?24?%;color:#ccc}.reload[data-v-315755b8]{width:%?200?%;height:%?64?%;margin-top:%?50?%;color:#67686b;font-size:%?26?%;border-radius:%?45?%;border:%?1?% solid #5f6268}",""])},"67a3":function(t,e,n){var a=n("6f06");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("43d2adf7",a,!0,{sourceMap:!1,shadowMode:!1})},"6f06":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,'.nav[data-v-74166a98]{width:100%;height:%?90?%;position:fixed;top:0;\n\t\n\ttop:0;\n\tleft:0;z-index:99;background-color:#fff}.boderBottom[data-v-74166a98]{border-bottom:%?1?% solid #e9e9e9}.left-arrow[data-v-74166a98]{width:%?100?%;height:%?90?%;position:absolute}.left-arrow[data-v-74166a98] :after{content:"";width:%?22?%;height:%?22?%;position:absolute;margin-top:%?-11?%;margin-left:%?-11?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-left:%?4?% solid #222;border-bottom:%?4?% solid #222}.nav .close[data-v-74166a98]{width:%?100?%;height:%?90?%;position:absolute}.nav .close uni-image[data-v-74166a98]{width:%?30?%;height:%?30?%}.nav .title[data-v-74166a98]{width:%?550?%;font-size:%?34?%;line-height:%?90?%;color:#222;margin:0 auto;text-align:center}.nav .dot[data-v-74166a98]{position:absolute;width:%?100?%;height:%?89?%;top:0;right:%?10?%}.nav .dot uni-view[data-v-74166a98]{width:%?9?%;height:%?9?%;margin-left:%?10?%;border-radius:100%;background-color:#222}.margin-bottom[data-v-74166a98]{margin-bottom:%?90?%}',""])},"7ed2":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{item:{type:Object},type:{type:String}},data:function(){return{}},methods:{tapNews:function(t){var e=this.$tool.getDataSet(t,"id");uni.navigateTo({url:"../news-detail/news-detail?id="+e,animationDuration:400})}}};e.default=a},8073:function(t,e,n){var a=n("5883");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("1901ce8a",a,!0,{sourceMap:!1,shadowMode:!1})},8627:function(t,e,n){"use strict";var a=n("c44a"),i=n.n(a);i.a},"90ae":function(t,e,n){"use strict";n.r(e);var a=n("d543"),i=n("08e6");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"4d87cd6a",null);e["default"]=r.exports},"91ec":function(t,e,n){"use strict";var a=n("363f"),i=n.n(a);i.a},a64c:function(t,e,n){"use strict";n.r(e);var a=n("0a46"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},ab1b:function(t,e,n){"use strict";var a=n("67a3"),i=n.n(a);i.a},bb50:function(t,e,n){"use strict";n.r(e);var a=n("1d18"),i=n("a64c");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("ab1b");var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"74166a98",null);e["default"]=r.exports},bd1a:function(t,e,n){"use strict";n.r(e);var a=n("5f59"),i=n("4c06");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("f633");var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"e5327a8c",null);e["default"]=r.exports},c44a:function(t,e,n){var a=n("dc2d");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("64aebd04",a,!0,{sourceMap:!1,shadowMode:!1})},d0bb:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=u(n("bd1a")),i=u(n("bb50")),o=u(n("23ae")),s=u(n("37bd")),r=u(n("90ae"));function u(t){return t&&t.__esModule?t:{default:t}}var l={components:{customNav:i.default,statusBar:a.default,newsList:o.default,pageLoading:s.default,loadMore:r.default},data:function(){return{title:"资讯",page_status:0,news_list:[],type:"newsCollect",loadingType:0}},onLoad:function(){this._onLoad()},onReachBottom:function(){this._onLoadMore()},methods:{tapBack:function(){uni.navigateBack({delta:1})},setLoadingType:function(t){this.loadingType=t.status},onRefresh:function(){this._onLoad()},_onLoad:function(){var t=this,e=this,n=this.$tool.getUserData().id;if(!n)return e.page_status=1,!1;e.page_status=0;var a=setTimeout(function(){e.$tool.loadFail(e)},6e3);this.$http.get("user/collect",{user_id:n}).then(function(e){console.log(JSON.stringify(e)),0==e.code&&(t.news_list=e.data.news_list,t.start_id=e.data.start_id,t.page=1),t.page_status=1,clearTimeout(a)}).catch(function(t){console.log("err")})},_onLoadMore:function(){var t=this,e=this.$tool.getUserData().id;if(!e)return!1;var n="news_list";0==this.loadingType&&(this.loadingType=1,this.$http.get("user/more_collect",{user_id:e,type:n,page:this.page+1,start_id:this.start_id}).then(function(e){console.log(e);var n=e.data;if(0==n.length)return t.loadingType=2,!1;t.news_list=t.news_list.concat(n),t.page++,t.loadingType=0}).catch(function(t){console.log("more_err")}))}}};e.default=l},d0e6:function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{staticClass:"news-content"},[n("v-uni-view",{staticClass:"news-list flex-row",attrs:{"data-id":"newsCollect"==t.type?t.item.news_id:t.item.id},on:{click:function(e){e=t.$handleEvent(e),t.tapNews(e)}}},[n("v-uni-view",{staticClass:"news-list-logo"},[n("v-uni-image",{attrs:{src:t.item.image_url,mode:"aspectFill","lazy-load":""}})],1),n("v-uni-view",{staticClass:"news-list-text column-space-between"},[n("v-uni-view",{staticClass:"news-list-text-top"},[n("v-uni-text",[t._v(t._s(t.item.title))])],1),n("v-uni-view",{staticClass:"news-list-text-bottom"},[n("v-uni-text",[t._v(t._s(t.item.source_name?t.item.source_name:t.item.author))]),n("v-uni-text",{class:"newsCollect"==t.type?"collect-time":"time"},[t._v(t._s(t.item.published_time?t.item.published_time:t.item.create_time))])],1)],1)],1)],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},d407:function(t,e,n){"use strict";n.r(e);var a=n("7ed2"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},d543:function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.returnMoreStatus,expression:"returnMoreStatus"}],staticClass:"load-more flex-center"},[n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.image_show,expression:"image_show"}],staticClass:"loading-img"},[n("v-uni-view",{staticClass:"load1"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load2"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load3"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1)],1),n("v-uni-text",{staticClass:"loading-text"},[t._v(t._s(t.loading_txt))])],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},d8b2:function(t,e,n){"use strict";n.r(e);var a=n("d0bb"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},dc2d:function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* tab栏内容区 */.news-content[data-v-28a16214]{margin-top:%?10?%;background-color:#FFFFF}.news-content .news-list[data-v-28a16214]{padding:%?40?% %?22?%;border-bottom:%?1?% solid #f4f4f4;background-color:#fff}\r\n/* 新闻列表图片 */.news-content .news-list .news-list-logo[data-v-28a16214]{width:%?237?%;height:%?146?%;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}.news-list .news-list-logo uni-image[data-v-28a16214]{width:100%;height:100%;border-radius:%?10?%}\r\n/* 新闻列表内容 */.news-content .news-list .news-list-text[data-v-28a16214]{-webkit-box-flex:2;-webkit-flex:2;-ms-flex:2;flex:2;padding:%?0?% %?20?%}.news-list-text .news-list-text-top[data-v-28a16214]{height:%?90?%;overflow:hidden;color:#222;font-size:%?28?%;line-height:1.7em}.news-list-text .news-list-text-bottom[data-v-28a16214]{color:#bcc0c5;font-size:%?24?%;line-height:%?24?%;position:relative}.news-list-text .news-list-text-bottom .time[data-v-28a16214]{position:absolute;right:0}.news-list-text .news-list-text-bottom .collect-time[data-v-28a16214]{margin-left:%?25?%}",""])},f1d3:function(t,e,n){"use strict";n.r(e);var a=n("3aee"),i=n("d8b2");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("53c0");var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"7d9f54f6",null);e["default"]=r.exports},f633:function(t,e,n){"use strict";var a=n("541d"),i=n.n(a);i.a}}]);