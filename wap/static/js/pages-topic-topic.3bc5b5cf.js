(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-topic-topic"],{"065c":function(t,e,n){"use strict";n.r(e);var a=n("7493"),i=n("946a");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("b8d9");var r=n("2877"),s=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"5c41bc10",null);e["default"]=s.exports},"0d83":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{staticClass:"index"},[1==t.page_status?n("v-uni-view",{staticClass:"wrap"},[n("v-uni-view",{staticClass:"top uni-flex",style:{marginTop:t.statusBarHeight}},[n("v-uni-view",{staticClass:"left-arrow",on:{click:function(e){e=t.$handleEvent(e),t.goback(e)}}},[n("v-uni-view")],1),n("v-uni-view",{staticClass:"search-ipt"},[n("v-uni-input",{staticClass:"input",attrs:{type:"text",value:""}}),n("v-uni-view",{staticClass:"search"},[n("v-uni-image",{attrs:{src:"../../static/images/search.png",mode:""}})],1)],1)],1),n("v-uni-view",{staticClass:"content"},[n("v-uni-view",{staticClass:"list-top uni-flex"},[n("v-uni-view",{staticClass:"topic uni-flex"},[n("v-uni-image",{attrs:{src:"../../static/images/topic.png",mode:""}})],1),n("v-uni-view",{staticClass:"title uni-flex"},[n("v-uni-text",[t._v("话题")])],1)],1),t._l(t.list_data,function(e,a){return n("v-uni-view",{key:a,staticClass:"list uni-flex",attrs:{"data-id":e.id},on:{click:function(e){e=t.$handleEvent(e),t.goPageDetail(e)}}},[n("v-uni-text",{staticClass:"number",class:a<=2?"red_number":"yellow_number"},[t._v(t._s(a+1))]),n("v-uni-text",{staticClass:"name",class:a<=2?"black_name":"gray_name"},[t._v(t._s(e.title))])],1)})],2)],1):n("page-loading",{attrs:{pageStatus:t.page_status},on:{reload:function(e){e=t.$handleEvent(e),t.onRefresh(e)}}})],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},4339:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=o(n("065c")),i=o(n("d8ec"));function o(t){return t&&t.__esModule?t:{default:t}}var r={components:{pageLoading:i.default,statusBar:a.default},data:function(){return{list_data:[],page_status:0,statusBarHeight:""}},onLoad:function(){this._onLoad()},methods:{goback:function(){uni.navigateBack({delta:1,animationType:"pop-out",animationDuration:200})},goPageDetail:function(t){var e=this.$tool.getDataSet(t,"id");uni.navigateTo({url:"../community-detail/community-detail?id="+e,animationDuration:400})},onRefresh:function(){this._onLoad()},_onLoad:function(){var t=this,e=this;e.page_status=0;var n=setTimeout(function(){e.$tool.loadFail(e)},6e3);this.$http.get("forum/hot_topic").then(function(e){t.list_data=e.data,t.page_status=1,clearTimeout(n)}).catch(function(t){console.log("err")})}}};e.default=r},"449e":function(t,e,n){var a=n("9ce4");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("445c9dde",a,!0,{sourceMap:!1,shadowMode:!1})},"4e1a":function(t,e,n){var a=n("a1f8");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("66a40329",a,!0,{sourceMap:!1,shadowMode:!1})},"534c":function(t,e,n){"use strict";n.r(e);var a=n("4339"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},7493:function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"status_bar"},[n("v-uni-view",{staticClass:"top_view"})],1)],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"80a0":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={data:function(){return{statusBarHeight:""}},onLoad:function(){}};e.default=a},"946a":function(t,e,n){"use strict";n.r(e);var a=n("80a0"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},"9ce4":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,'.wrap[data-v-2334ce50]{width:%?750?%}\r\n/* 导航栏 */.wrap .top[data-v-2334ce50]{width:%?750?%;height:%?89?%;background-color:#fff;position:fixed;\r\n\t\r\n\ttop:0;\r\n\t\r\n\tz-index:99}.top .left-arrow[data-v-2334ce50]{width:%?100?%;height:%?89?%;\r\n\tdisplay:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;position:absolute;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;top:0;left:0}.top .left-arrow[data-v-2334ce50] :after{content:"";width:%?25?%;height:%?25?%;position:absolute;margin-top:%?-5?%;left:%?35?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-left:%?4?% solid #adadad;border-bottom:%?4?% solid #adadad}.top .search-ipt[data-v-2334ce50]{width:85%;height:%?70?%;\r\n\tmargin-top:%?18?%;margin-left:%?75?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;background-color:#f4f4f4;border-radius:%?200?%;position:relative}.top .search-ipt .input[data-v-2334ce50]{width:100%;height:%?70?%;\r\n\tpadding-left:%?30?%}.top .search uni-image[data-v-2334ce50]{width:%?35?%;height:%?35?%;position:absolute;top:50%;right:8%;margin-top:%?-18?%}\r\n/* 内容区 */.content[data-v-2334ce50]{width:%?750?%;margin-top:%?89?%}.content .list-top[data-v-2334ce50]{padding-top:%?40?%;padding-left:%?35?%}.list-top .topic uni-image[data-v-2334ce50]{width:%?45?%;height:%?45?%}.list-top .title[data-v-2334ce50]{margin-left:%?15?%;font-size:%?34?%;margin-top:%?-3?%;color:#000}.content .list[data-v-2334ce50]{height:%?110?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;padding:0 %?25?%;font-size:%?30?%;border-bottom:%?1?% solid #f5f5f5;overflow:hidden}.content .list .number[data-v-2334ce50]{margin-right:%?30?%;margin-left:%?15?%}.content .list .name[data-v-2334ce50]{max-height:%?90?%;line-height:%?45?%;overflow:hidden}.red_number[data-v-2334ce50]{color:#ef1818}.yellow_number[data-v-2334ce50]{color:#f4cc7e}.black_name[data-v-2334ce50]{color:#3e3838}.gray_name[data-v-2334ce50]{color:#7d7b7b}',""])},a1f8:function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 状态栏 */.status_bar[data-v-5c41bc10]{height:0;width:100%}.top_view[data-v-5c41bc10]{height:0;width:100%;position:fixed;background-color:#fff;top:0;z-index:9999}",""])},b3d0:function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"loading"},[n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.loading_show,expression:"loading_show"}],staticClass:"loading-img"},[n("v-uni-view",{staticClass:"load1"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load2"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load3"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1)],1)],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.error_show,expression:"error_show"}],staticClass:"load"},[n("v-uni-view",{staticClass:"load-img"},[n("v-uni-image",{attrs:{src:"/static/images/load.png"}})],1),n("v-uni-view",{staticClass:"prompt"},[n("v-uni-text",[t._v("加载失败了，等会再浪吧")])],1),n("v-uni-view",{staticClass:"reload uni-center",on:{click:function(e){e=t.$handleEvent(e),t.reload(e)}}},[n("v-uni-text",[t._v("重新加载")])],1)],1)],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},b599:function(t,e,n){"use strict";n.r(e);var a=n("f6f4"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},b8d9:function(t,e,n){"use strict";var a=n("4e1a"),i=n.n(a);i.a},d8ec:function(t,e,n){"use strict";n.r(e);var a=n("b3d0"),i=n("b599");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);var r=n("2877"),s=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"066967ad",null);e["default"]=s.exports},df37:function(t,e,n){"use strict";n.r(e);var a=n("0d83"),i=n("534c");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("f5ab");var r=n("2877"),s=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"2334ce50",null);e["default"]=s.exports},f5ab:function(t,e,n){"use strict";var a=n("449e"),i=n.n(a);i.a},f6f4:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{color:{type:String,default:"#777777"},pageStatus:{type:Number}},data:function(){return{}},computed:{loading_show:function(){return 0==this.pageStatus},error_show:function(){return 2==this.pageStatus}},methods:{reload:function(){this.$emit("reload")}}};e.default=a}}]);