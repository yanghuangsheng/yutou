(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-lottery-lottery"],{"0468":function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a=o(e("065c")),i=o(e("d8ec"));function o(t){return t&&t.__esModule?t:{default:t}}var r={components:{statusBar:a.default,pageLoading:i.default},data:function(){return{page_status:0,list_data:[],show_more:2}},onLoad:function(){this._onLoad()},onPullDownRefresh:function(){this._onLoad(1)},methods:{goTo:function(t){var n=this.$tool.getDataSet(t,"id");uni.navigateTo({url:"../lottery-detail/lottery-detail?id="+n})},onRefresh:function(){this._onLoad()},_onLoad:function(t){var n=this,e=this;e.page_status=t?3:0;var a=setTimeout(function(){t&&uni.stopPullDownRefresh(),e.$tool.loadFail(e)},6e3);this.$http.get("lottery/list").then(function(i){var o=i.data;console.log(o),n.list_data=o,e.page_status=1,t&&uni.stopPullDownRefresh(),clearTimeout(a)}).catch(function(t){console.log("err")})},setMoreStatus:function(t){console.log(t),this.show_more=t.status}}};n.default=r},"065c":function(t,n,e){"use strict";e.r(n);var a=e("f674"),i=e("946a");for(var o in i)"default"!==o&&function(t){e.d(n,t,function(){return i[t]})}(o);e("4904");var r=e("2877"),s=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"07966727",null);n["default"]=s.exports},"075a":function(t,n,e){"use strict";var a=e("9254"),i=e.n(a);i.a},"15cd":function(t,n,e){"use strict";var a=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view",{staticClass:"index"},[1==t.page_status?e("v-uni-view",{staticClass:"wrap"},[e("v-uni-view",{staticClass:"top"},[e("v-uni-text",{staticClass:"wwe"},[t._v("开奖公告")])],1),e("v-uni-view",{staticClass:"content"},t._l(t.list_data,function(n,a){return e("v-uni-view",{key:a,staticClass:"list uni-flex uni-column",attrs:{"data-id":n.id},on:{click:function(n){n=t.$handleEvent(n),t.goTo(n)}}},[e("v-uni-view",{staticClass:"list-top uni-flex uni-row"},[e("v-uni-text",{staticClass:"name"},[t._v(t._s(n.name))]),e("v-uni-text",{staticClass:"times"},[t._v(t._s(n.lottery_no)+"期")]),e("v-uni-text",{staticClass:"date"},[t._v(t._s(n.open_time)+" ("+t._s(n.week)+")")])],1),e("v-uni-view",{staticClass:"arrow"},[e("v-uni-view",{staticClass:"uni-flex"},t._l(n.open_code,function(n,a){return e("v-uni-text",{key:a,staticClass:"num-badge num-badge-danger"},[t._v(t._s(n))])}),1),e("v-uni-view",{staticClass:"uni-flex"},t._l(n.open_code_ext,function(n,a){return e("v-uni-text",{key:a,staticClass:"num-badge num-badge-primary"},[t._v(t._s(n))])}),1)],1)],1)}),1)],1):e("page-loading",{attrs:{pageStatus:t.page_status},on:{reload:function(n){n=t.$handleEvent(n),t.onRefresh(n)}}})],1)},i=[];e.d(n,"a",function(){return a}),e.d(n,"b",function(){return i})},"35ed":function(t,n,e){"use strict";e.r(n);var a=e("0468"),i=e.n(a);for(var o in a)"default"!==o&&function(t){e.d(n,t,function(){return a[t]})}(o);n["default"]=i.a},4904:function(t,n,e){"use strict";var a=e("f3e7"),i=e.n(a);i.a},"501b":function(t,n,e){n=t.exports=e("2350")(!1),n.push([t.i,'uni-page-body[data-v-3b34869a]{background-color:#f5f5f5}.top[data-v-3b34869a]{width:100%;height:%?90?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;background-color:#fff;line-height:%?89?%;font-size:%?34?%;color:#4a4a4a;position:fixed;\r\n\tleft:0;border-bottom:%?5?% solid #f5f5f5}.content[data-v-3b34869a]{\r\n\tpadding-top:%?90?%\r\n\t}.list[data-v-3b34869a]{height:%?160?%;padding-left:%?20?%;padding-right:%?20?%;background-color:#fff;margin-top:%?25?%}.list-top[data-v-3b34869a]{margin:%?10?% 0;line-height:%?60?%}.name[data-v-3b34869a]{color:#3a3556;font-size:%?32?%;padding-right:%?20?%}.times[data-v-3b34869a]{color:#a4a3a3;font-size:%?28?%;padding-right:%?20?%}.date[data-v-3b34869a]{color:#6c6666;font-size:%?28?%}.arrow[data-v-3b34869a]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.arrow[data-v-3b34869a]:after{content:"";width:%?20?%;height:%?20?%;position:absolute;right:%?25?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-right:%?3?% solid #adadad;border-top:%?3?% solid #adadad}.num-badge[data-v-3b34869a]{font-family:Helvetica Neue,Helvetica,sans-serif;-webkit-box-sizing:border-box;box-sizing:border-box;font-size:12px;line-height:1;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;width:%?50?%;height:%?50?%;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;margin-right:%?20?%;border-radius:100%}.num-badge-primary[data-v-3b34869a]{color:#fff;background-color:#36c1ef;-webkit-box-shadow:%?0?% %?5?% %?5?% #75daf8;box-shadow:%?0?% %?5?% %?5?% #75daf8}.num-badge-danger[data-v-3b34869a]{color:#fff;background-color:#ff0d0d;-webkit-box-shadow:%?0?% %?5?% %?5?% #f98383;box-shadow:%?0?% %?5?% %?5?% #f98383}body.?%PAGE?%[data-v-3b34869a]{background-color:#f5f5f5}',""])},"80a0":function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a={data:function(){return{platform:"",statusBarHeight:"",screenHeight:"",windowHeight:"",navHeight:""}},onLoad:function(){}};n.default=a},"90f3":function(t,n,e){"use strict";e.r(n);var a=e("15cd"),i=e("35ed");for(var o in i)"default"!==o&&function(t){e.d(n,t,function(){return i[t]})}(o);e("075a");var r=e("2877"),s=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"3b34869a",null);n["default"]=s.exports},9254:function(t,n,e){var a=e("501b");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=e("4f06").default;i("26ebc5b0",a,!0,{sourceMap:!1,shadowMode:!1})},"946a":function(t,n,e){"use strict";e.r(n);var a=e("80a0"),i=e.n(a);for(var o in a)"default"!==o&&function(t){e.d(n,t,function(){return a[t]})}(o);n["default"]=i.a},b3d0:function(t,n,e){"use strict";var a=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view",[e("v-uni-view",{staticClass:"loading"},[e("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.loading_show,expression:"loading_show"}],staticClass:"loading-img"},[e("v-uni-view",{staticClass:"load1"},[e("v-uni-view",{style:{background:t.color}}),e("v-uni-view",{style:{background:t.color}}),e("v-uni-view",{style:{background:t.color}}),e("v-uni-view",{style:{background:t.color}})],1),e("v-uni-view",{staticClass:"load2"},[e("v-uni-view",{style:{background:t.color}}),e("v-uni-view",{style:{background:t.color}}),e("v-uni-view",{style:{background:t.color}}),e("v-uni-view",{style:{background:t.color}})],1),e("v-uni-view",{staticClass:"load3"},[e("v-uni-view",{style:{background:t.color}}),e("v-uni-view",{style:{background:t.color}}),e("v-uni-view",{style:{background:t.color}}),e("v-uni-view",{style:{background:t.color}})],1)],1)],1),e("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.error_show,expression:"error_show"}],staticClass:"load"},[e("v-uni-view",{staticClass:"load-img"},[e("v-uni-image",{attrs:{src:"/static/images/load.png"}})],1),e("v-uni-view",{staticClass:"prompt"},[e("v-uni-text",[t._v("加载失败了，等会再浪吧")])],1),e("v-uni-view",{staticClass:"reload uni-center",on:{click:function(n){n=t.$handleEvent(n),t.reload(n)}}},[e("v-uni-text",[t._v("重新加载")])],1)],1)],1)},i=[];e.d(n,"a",function(){return a}),e.d(n,"b",function(){return i})},b599:function(t,n,e){"use strict";e.r(n);var a=e("f6f4"),i=e.n(a);for(var o in a)"default"!==o&&function(t){e.d(n,t,function(){return a[t]})}(o);n["default"]=i.a},d8ec:function(t,n,e){"use strict";e.r(n);var a=e("b3d0"),i=e("b599");for(var o in i)"default"!==o&&function(t){e.d(n,t,function(){return i[t]})}(o);var r=e("2877"),s=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"066967ad",null);n["default"]=s.exports},f367:function(t,n,e){n=t.exports=e("2350")(!1),n.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 状态栏 */.status_bar[data-v-07966727]{height:0;width:100%}.top_view[data-v-07966727]{height:0;width:100%;position:fixed;background-color:#fff;top:0;z-index:999}",""])},f3e7:function(t,n,e){var a=e("f367");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=e("4f06").default;i("657de40a",a,!0,{sourceMap:!1,shadowMode:!1})},f674:function(t,n,e){"use strict";var a=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view")},i=[];e.d(n,"a",function(){return a}),e.d(n,"b",function(){return i})},f6f4:function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a={props:{color:{type:String,default:"#777777"},pageStatus:{type:Number}},data:function(){return{}},computed:{loading_show:function(){return 0==this.pageStatus},error_show:function(){return 2==this.pageStatus}},methods:{reload:function(){this.$emit("reload")}}};n.default=a}}]);