(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-lottery-lottery"],{"0468":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=o(n("065c")),i=o(n("d8ec"));function o(t){return t&&t.__esModule?t:{default:t}}var s={components:{statusBar:a.default,pageLoading:i.default},data:function(){return{page_status:0,list_data:[],show_more:2}},onLoad:function(){this._onLoad()},onPullDownRefresh:function(){this._onLoad(1)},methods:{goTo:function(t){var e=this.$tool.getDataSet(t,"id");uni.navigateTo({url:"../lottery-detail/lottery-detail?id="+e})},onRefresh:function(){this._onLoad()},_onLoad:function(t){var e=this,n=this;n.page_status=t?3:0;var a=setTimeout(function(){t&&uni.stopPullDownRefresh(),n.$tool.loadFail(n)},6e3);this.$http.get("lottery/list").then(function(i){var o=i.data;console.log(o),e.list_data=o,n.page_status=1,t&&uni.stopPullDownRefresh(),clearTimeout(a)}).catch(function(t){console.log("err")})},setMoreStatus:function(t){console.log(t),this.show_more=t.status}}};e.default=s},"065c":function(t,e,n){"use strict";n.r(e);var a=n("7493"),i=n("946a");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("b8d9");var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"5c41bc10",null);e["default"]=r.exports},"075a":function(t,e,n){"use strict";var a=n("9254"),i=n.n(a);i.a},"15cd":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{staticClass:"index"},[1==t.page_status?n("v-uni-view",{staticClass:"wrap"},[n("v-uni-view",{staticClass:"top"},[n("v-uni-text",{staticClass:"wwe"},[t._v("开奖公告")])],1),n("v-uni-view",{staticClass:"content"},t._l(t.list_data,function(e,a){return n("v-uni-view",{key:a,staticClass:"list uni-flex uni-column",attrs:{"data-id":e.id},on:{click:function(e){e=t.$handleEvent(e),t.goTo(e)}}},[n("v-uni-view",{staticClass:"list-top uni-flex uni-row"},[n("v-uni-text",{staticClass:"name"},[t._v(t._s(e.name))]),n("v-uni-text",{staticClass:"times"},[t._v(t._s(e.lottery_no)+"期")]),n("v-uni-text",{staticClass:"date"},[t._v(t._s(e.open_time)+" ("+t._s(e.week)+")")])],1),n("v-uni-view",{staticClass:"arrow"},[n("v-uni-view",{staticClass:"uni-flex"},t._l(e.open_code,function(e,a){return n("v-uni-text",{key:a,staticClass:"num-badge num-badge-danger"},[t._v(t._s(e))])}),1),n("v-uni-view",{staticClass:"uni-flex"},t._l(e.open_code_ext,function(e,a){return n("v-uni-text",{key:a,staticClass:"num-badge num-badge-primary"},[t._v(t._s(e))])}),1)],1)],1)}),1)],1):n("page-loading",{attrs:{pageStatus:t.page_status},on:{reload:function(e){e=t.$handleEvent(e),t.onRefresh(e)}}})],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"35ed":function(t,e,n){"use strict";n.r(e);var a=n("0468"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},"4e1a":function(t,e,n){var a=n("a1f8");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("66a40329",a,!0,{sourceMap:!1,shadowMode:!1})},"501b":function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,'uni-page-body[data-v-3b34869a]{background-color:#f5f5f5}.top[data-v-3b34869a]{width:100%;height:%?90?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;background-color:#fff;line-height:%?89?%;font-size:%?34?%;color:#4a4a4a;position:fixed;\r\n\tleft:0;border-bottom:%?5?% solid #f5f5f5}.content[data-v-3b34869a]{\r\n\tpadding-top:%?90?%\r\n\t}.list[data-v-3b34869a]{height:%?160?%;padding-left:%?20?%;padding-right:%?20?%;background-color:#fff;margin-top:%?25?%}.list-top[data-v-3b34869a]{margin:%?10?% 0;line-height:%?60?%}.name[data-v-3b34869a]{color:#3a3556;font-size:%?32?%;padding-right:%?20?%}.times[data-v-3b34869a]{color:#a4a3a3;font-size:%?28?%;padding-right:%?20?%}.date[data-v-3b34869a]{color:#6c6666;font-size:%?28?%}.arrow[data-v-3b34869a]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.arrow[data-v-3b34869a]:after{content:"";width:%?20?%;height:%?20?%;position:absolute;right:%?25?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-right:%?3?% solid #adadad;border-top:%?3?% solid #adadad}.num-badge[data-v-3b34869a]{font-family:Helvetica Neue,Helvetica,sans-serif;-webkit-box-sizing:border-box;box-sizing:border-box;font-size:12px;line-height:1;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;width:%?50?%;height:%?50?%;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;margin-right:%?20?%;border-radius:100%}.num-badge-primary[data-v-3b34869a]{color:#fff;background-color:#36c1ef;-webkit-box-shadow:%?0?% %?5?% %?5?% #75daf8;box-shadow:%?0?% %?5?% %?5?% #75daf8}.num-badge-danger[data-v-3b34869a]{color:#fff;background-color:#ff0d0d;-webkit-box-shadow:%?0?% %?5?% %?5?% #f98383;box-shadow:%?0?% %?5?% %?5?% #f98383}body.?%PAGE?%[data-v-3b34869a]{background-color:#f5f5f5}',""])},7493:function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"status_bar"},[n("v-uni-view",{staticClass:"top_view"})],1)],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"80a0":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={data:function(){return{statusBarHeight:""}},onLoad:function(){}};e.default=a},"90f3":function(t,e,n){"use strict";n.r(e);var a=n("15cd"),i=n("35ed");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);n("075a");var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"3b34869a",null);e["default"]=r.exports},9254:function(t,e,n){var a=n("501b");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=n("4f06").default;i("26ebc5b0",a,!0,{sourceMap:!1,shadowMode:!1})},"946a":function(t,e,n){"use strict";n.r(e);var a=n("80a0"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},a1f8:function(t,e,n){e=t.exports=n("2350")(!1),e.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 状态栏 */.status_bar[data-v-5c41bc10]{height:0;width:100%}.top_view[data-v-5c41bc10]{height:0;width:100%;position:fixed;background-color:#fff;top:0;z-index:9999}",""])},b3d0:function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"loading"},[n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.loading_show,expression:"loading_show"}],staticClass:"loading-img"},[n("v-uni-view",{staticClass:"load1"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load2"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1),n("v-uni-view",{staticClass:"load3"},[n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}}),n("v-uni-view",{style:{background:t.color}})],1)],1)],1),n("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.error_show,expression:"error_show"}],staticClass:"load"},[n("v-uni-view",{staticClass:"load-img"},[n("v-uni-image",{attrs:{src:"/static/images/load.png"}})],1),n("v-uni-view",{staticClass:"prompt"},[n("v-uni-text",[t._v("加载失败了，等会再浪吧")])],1),n("v-uni-view",{staticClass:"reload uni-center",on:{click:function(e){e=t.$handleEvent(e),t.reload(e)}}},[n("v-uni-text",[t._v("重新加载")])],1)],1)],1)},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},b599:function(t,e,n){"use strict";n.r(e);var a=n("f6f4"),i=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=i.a},b8d9:function(t,e,n){"use strict";var a=n("4e1a"),i=n.n(a);i.a},d8ec:function(t,e,n){"use strict";n.r(e);var a=n("b3d0"),i=n("b599");for(var o in i)"default"!==o&&function(t){n.d(e,t,function(){return i[t]})}(o);var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"066967ad",null);e["default"]=r.exports},f6f4:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={props:{color:{type:String,default:"#777777"},pageStatus:{type:Number}},data:function(){return{}},computed:{loading_show:function(){return 0==this.pageStatus},error_show:function(){return 2==this.pageStatus}},methods:{reload:function(){this.$emit("reload")}}};e.default=a}}]);