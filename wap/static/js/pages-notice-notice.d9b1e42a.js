(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-notice-notice"],{"065c":function(t,n,e){"use strict";e.r(n);var i=e("7493"),a=e("946a");for(var o in a)"default"!==o&&function(t){e.d(n,t,function(){return a[t]})}(o);e("b8d9");var r=e("2877"),s=Object(r["a"])(a["default"],i["a"],i["b"],!1,null,"5c41bc10",null);n["default"]=s.exports},"0859":function(t,n,e){"use strict";e.r(n);var i=e("b35b"),a=e("4ed1");for(var o in a)"default"!==o&&function(t){e.d(n,t,function(){return a[t]})}(o);e("be29");var r=e("2877"),s=Object(r["a"])(a["default"],i["a"],i["b"],!1,null,"819191ba",null);n["default"]=s.exports},"0b09":function(t,n,e){n=t.exports=e("2350")(!1),n.push([t.i,'.nav[data-v-ceff955c]{width:100%;height:%?90?%;position:fixed;\n\t\n\ttop:0;\n\tleft:0;z-index:99;background-color:#fff;border-bottom:%?1?% solid #e9e9e9}.nav .title[data-v-ceff955c]{width:%?350?%;font-size:%?34?%;line-height:%?89?%;color:#4a4a4a;text-align:center}.left-arrow[data-v-ceff955c]{width:%?100?%;height:%?89?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;top:0;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;position:absolute;left:0}.left-arrow[data-v-ceff955c] :after{content:"";width:%?25?%;height:%?25?%;position:absolute;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;margin-top:%?-13?%;left:%?35?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);\n\tborder-left:%?4?% solid #adadad;border-bottom:%?4?% solid #adadad;\n\t\n\t}.margin-bottom[data-v-ceff955c]{margin-bottom:%?90?%}',""])},"1ee1":function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i=o(e("065c")),a=o(e("8058"));function o(t){return t&&t.__esModule?t:{default:t}}var r={components:{uniNav:a.default,statusBar:i.default},data:function(){return{title:"系统通知",list_data:[]}}};n.default=r},"29b2":function(t,n,e){"use strict";var i=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view",[e("v-uni-view",{staticClass:"nav uni-center",style:{marginTop:t.statusBarHeight}},[e("v-uni-view",{staticClass:"title uni-ellipsis"},[t._v(t._s(t.title))]),t.isShow?e("v-uni-view",{staticClass:"left-arrow",on:{click:function(n){n=t.$handleEvent(n),t.goback(n)}}},[e("v-uni-view")],1):e("v-uni-view",{staticClass:"left-arrow",on:{click:function(n){n=t.$handleEvent(n),t.Tapback(n)}}},[e("v-uni-view")],1)],1),e("v-uni-view",{staticClass:"margin-bottom"})],1)},a=[];e.d(n,"a",function(){return i}),e.d(n,"b",function(){return a})},"380d":function(t,n,e){"use strict";var i=e("43aa"),a=e.n(i);a.a},"43aa":function(t,n,e){var i=e("0b09");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=e("4f06").default;a("808405f4",i,!0,{sourceMap:!1,shadowMode:!1})},"46eb":function(t,n,e){var i=e("e0e0");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=e("4f06").default;a("99fc6182",i,!0,{sourceMap:!1,shadowMode:!1})},"4e1a":function(t,n,e){var i=e("a1f8");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=e("4f06").default;a("66a40329",i,!0,{sourceMap:!1,shadowMode:!1})},"4ed1":function(t,n,e){"use strict";e.r(n);var i=e("1ee1"),a=e.n(i);for(var o in i)"default"!==o&&function(t){e.d(n,t,function(){return i[t]})}(o);n["default"]=a.a},7493:function(t,n,e){"use strict";var i=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view",[e("v-uni-view",{staticClass:"status_bar"},[e("v-uni-view",{staticClass:"top_view"})],1)],1)},a=[];e.d(n,"a",function(){return i}),e.d(n,"b",function(){return a})},8058:function(t,n,e){"use strict";e.r(n);var i=e("29b2"),a=e("f732");for(var o in a)"default"!==o&&function(t){e.d(n,t,function(){return a[t]})}(o);e("380d");var r=e("2877"),s=Object(r["a"])(a["default"],i["a"],i["b"],!1,null,"ceff955c",null);n["default"]=s.exports},"80a0":function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i={data:function(){return{statusBarHeight:""}},onLoad:function(){}};n.default=i},"946a":function(t,n,e){"use strict";e.r(n);var i=e("80a0"),a=e.n(i);for(var o in i)"default"!==o&&function(t){e.d(n,t,function(){return i[t]})}(o);n["default"]=a.a},"9ce3":function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i={props:{title:{type:String},isShow:{type:Boolean,default:!0}},data:function(){return{statusBarHeight:""}},onLoad:function(){},methods:{goback:function(){uni.navigateBack({delta:1,animationType:"pop-out",animationDuration:200})},Tapback:function(){uni.switchTab({url:"../index/index",animationDuration:200})}}};n.default=i},a1f8:function(t,n,e){n=t.exports=e("2350")(!1),n.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 状态栏 */.status_bar[data-v-5c41bc10]{height:0;width:100%}.top_view[data-v-5c41bc10]{height:0;width:100%;position:fixed;background-color:#fff;top:0;z-index:9999}",""])},b35b:function(t,n,e){"use strict";var i=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view",{staticClass:"index"},[e("v-uni-view",{staticClass:"wrap"},[e("uni-nav",{attrs:{title:t.title}}),e("v-uni-view",{staticClass:"content"},[e("v-uni-view",{staticClass:"list uni-flex"},[e("v-uni-view",{staticClass:"logo"},[e("v-uni-image",{attrs:{src:"../../static/images/logo.png",mode:"scaleToFill"}}),e("v-uni-view",{staticClass:"dot"})],1),e("v-uni-view",{staticClass:"notice-content"},[e("v-uni-text",{staticClass:"notice"},[t._v("系统通知：")]),e("v-uni-view",{staticClass:"info"},[e("v-uni-text",[t._v("恭喜你在“吸引和地点”大家快回家符合疾风剑豪不仅仅代表国家粉黛花点击：")]),e("v-uni-navigator",{staticClass:"link",attrs:{url:""}},[t._v("https//www.zhipin.com/chat/im？mu=chat")]),e("v-uni-text",[t._v("领取你获得的奖品")])],1),e("v-uni-view",{staticClass:"datetime text-right"},[e("v-uni-text",[t._v("2019-4-7")])],1)],1)],1)],1)],1)],1)},a=[];e.d(n,"a",function(){return i}),e.d(n,"b",function(){return a})},b8d9:function(t,n,e){"use strict";var i=e("4e1a"),a=e.n(i);a.a},be29:function(t,n,e){"use strict";var i=e("46eb"),a=e.n(i);a.a},e0e0:function(t,n,e){n=t.exports=e("2350")(!1),n.push([t.i,".wrap[data-v-819191ba]{width:%?750?%}.list[data-v-819191ba]{width:%?710?%;padding:%?0?% %?20?%;border-bottom:%?1?% solid #f5f5f5}.list .logo[data-v-819191ba]{padding-top:%?20?%;position:relative;height:%?60?%}.list .logo uni-image[data-v-819191ba]{height:100%;width:%?100?%}.list .logo .dot[data-v-819191ba]{width:%?15?%;height:%?15?%;border-radius:50%;position:absolute;right:%?-5?%;top:%?25?%;background-color:#ff0d0d}.list .notice-content[data-v-819191ba]{margin-left:%?15?%;padding-top:%?30?%}.list .notice-content .notice[data-v-819191ba]{color:#292828;float:left}.list .notice-content .info[data-v-819191ba]{color:#636363}.list .notice-content .link[data-v-819191ba]{color:#00a2ff}.list .notice-content .datetime[data-v-819191ba]{color:#bcbcbc;padding-bottom:%?10?%}",""])},f732:function(t,n,e){"use strict";e.r(n);var i=e("9ce3"),a=e.n(i);for(var o in i)"default"!==o&&function(t){e.d(n,t,function(){return i[t]})}(o);n["default"]=a.a}}]);