(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-set-set"],{"0a46":function(t,n,a){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var e={name:"custom-nav",props:{title:{type:String},share:{type:Boolean,default:!1},arrow:{type:Boolean,default:!0},showBorder:{type:Boolean,default:!0}},data:function(){return{statusBarHeight:""}},onLoad:function(){},methods:{goback:function(){this.$emit("back")},Tapshare:function(){this.$emit("Share")}}};n.default=e},"1d18":function(t,n,a){"use strict";var e=function(){var t=this,n=t.$createElement,a=t._self._c||n;return a("v-uni-view",[a("v-uni-view",{staticClass:"nav align-items",class:t.showBorder?"boderBottom":"",style:{marginTop:t.statusBarHeight}},[t.arrow?a("v-uni-view",{staticClass:"left-arrow flex-center",on:{click:function(n){n=t.$handleEvent(n),t.goback(n)}}},[a("v-uni-view")],1):a("v-uni-view",{staticClass:"close flex-center",on:{click:function(n){n=t.$handleEvent(n),t.goback(n)}}},[a("v-uni-image",{attrs:{src:"/static/images/black_colse.png",mode:""}})],1),a("v-uni-view",{staticClass:"title ellipsis"},[t._v(t._s(t.title))]),a("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.share,expression:"share"}],staticClass:"dot flex-center",on:{click:function(n){n=t.$handleEvent(n),t.Tapshare(n)}}},[a("v-uni-view"),a("v-uni-view"),a("v-uni-view")],1)],1),a("v-uni-view",{staticClass:"margin-bottom"})],1)},i=[];a.d(n,"a",function(){return e}),a.d(n,"b",function(){return i})},"2c9f":function(t,n,a){"use strict";var e=function(){var t=this,n=t.$createElement,a=t._self._c||n;return a("v-uni-view",{staticClass:"index"},[a("v-uni-view",{staticClass:"wrap"},[a("custom-nav",{attrs:{title:t.title},on:{back:function(n){n=t.$handleEvent(n),t.tapBack(n)}}}),a("v-uni-view",{staticClass:"content"},[a("v-uni-view",{staticClass:"list align-items",on:{click:function(n){n=t.$handleEvent(n),t.tapPersonInfo(n)}}},[a("v-uni-view",{staticClass:"name"},[a("v-uni-text",[t._v("个人资料")])],1),a("v-uni-view",{staticClass:"right-arrow align-items"},[a("v-uni-view")],1)],1),a("v-uni-view",{staticClass:"list align-items",on:{click:function(n){n=t.$handleEvent(n),t.tapBindPhone(n)}}},[a("v-uni-view",{staticClass:"name"},[a("v-uni-text",[t._v("绑定手机")])],1),a("v-uni-view",{staticClass:"right-arrow align-items"},[a("v-uni-view")],1)],1),a("v-uni-view",{staticClass:"list align-items",on:{click:function(n){n=t.$handleEvent(n),t.tapChangePassword(n)}}},[a("v-uni-view",{staticClass:"name"},[a("v-uni-text",[t._v("修改密码")])],1),a("v-uni-view",{staticClass:"right-arrow align-items"},[a("v-uni-view")],1)],1),a("v-uni-view",{staticClass:"btn"},[a("v-uni-button",{staticClass:"button",on:{click:function(n){n=t.$handleEvent(n),t.removeLogin(n)}}},[t._v("退出登录")])],1)],1)],1)],1)},i=[];a.d(n,"a",function(){return e}),a.d(n,"b",function(){return i})},"4c06":function(t,n,a){"use strict";a.r(n);var e=a("5f1b9"),i=a.n(e);for(var o in e)"default"!==o&&function(t){a.d(n,t,function(){return e[t]})}(o);n["default"]=i.a},"4e69":function(t,n,a){n=t.exports=a("2350")(!1),n.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\n/* 状态栏 */.status_bar[data-v-e5327a8c]{height:0;width:100%;background-color:#fff}.top_view[data-v-e5327a8c]{height:0;width:100%;position:fixed;background-color:#fff;top:0;z-index:9999}",""])},"541d":function(t,n,a){var e=a("4e69");"string"===typeof e&&(e=[[t.i,e,""]]),e.locals&&(t.exports=e.locals);var i=a("4f06").default;i("79182a61",e,!0,{sourceMap:!1,shadowMode:!1})},"5f1b9":function(t,n,a){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var e={data:function(){return{statusBarHeight:""}},onLoad:function(){}};n.default=e},"5f59":function(t,n,a){"use strict";var e=function(){var t=this,n=t.$createElement,a=t._self._c||n;return a("v-uni-view",[a("v-uni-view",{staticClass:"status_bar"},[a("v-uni-view",{staticClass:"top_view"})],1)],1)},i=[];a.d(n,"a",function(){return e}),a.d(n,"b",function(){return i})},"67a3":function(t,n,a){var e=a("6f06");"string"===typeof e&&(e=[[t.i,e,""]]),e.locals&&(t.exports=e.locals);var i=a("4f06").default;i("43d2adf7",e,!0,{sourceMap:!1,shadowMode:!1})},"6ed0":function(t,n,a){"use strict";var e=a("fa5a"),i=a.n(e);i.a},"6f06":function(t,n,a){n=t.exports=a("2350")(!1),n.push([t.i,'.nav[data-v-74166a98]{width:100%;height:%?90?%;position:fixed;top:0;\n\t\n\ttop:0;\n\tleft:0;z-index:99;background-color:#fff}.boderBottom[data-v-74166a98]{border-bottom:%?1?% solid #e9e9e9}.left-arrow[data-v-74166a98]{width:%?100?%;height:%?90?%;position:absolute}.left-arrow[data-v-74166a98] :after{content:"";width:%?22?%;height:%?22?%;position:absolute;margin-top:%?-11?%;margin-left:%?-11?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-left:%?4?% solid #222;border-bottom:%?4?% solid #222}.nav .close[data-v-74166a98]{width:%?100?%;height:%?90?%;position:absolute}.nav .close uni-image[data-v-74166a98]{width:%?30?%;height:%?30?%}.nav .title[data-v-74166a98]{width:%?550?%;font-size:%?34?%;line-height:%?90?%;color:#222;margin:0 auto;text-align:center}.nav .dot[data-v-74166a98]{position:absolute;width:%?100?%;height:%?89?%;top:0;right:%?10?%}.nav .dot uni-view[data-v-74166a98]{width:%?9?%;height:%?9?%;margin-left:%?10?%;border-radius:100%;background-color:#222}.margin-bottom[data-v-74166a98]{margin-bottom:%?90?%}',""])},a64c:function(t,n,a){"use strict";a.r(n);var e=a("0a46"),i=a.n(e);for(var o in e)"default"!==o&&function(t){a.d(n,t,function(){return e[t]})}(o);n["default"]=i.a},ab1b:function(t,n,a){"use strict";var e=a("67a3"),i=a.n(e);i.a},ad2d:function(t,n,a){"use strict";a.r(n);var e=a("efd9"),i=a.n(e);for(var o in e)"default"!==o&&function(t){a.d(n,t,function(){return e[t]})}(o);n["default"]=i.a},bb50:function(t,n,a){"use strict";a.r(n);var e=a("1d18"),i=a("a64c");for(var o in i)"default"!==o&&function(t){a.d(n,t,function(){return i[t]})}(o);a("ab1b");var r=a("2877"),s=Object(r["a"])(i["default"],e["a"],e["b"],!1,null,"74166a98",null);n["default"]=s.exports},bd1a:function(t,n,a){"use strict";a.r(n);var e=a("5f59"),i=a("4c06");for(var o in i)"default"!==o&&function(t){a.d(n,t,function(){return i[t]})}(o);a("f633");var r=a("2877"),s=Object(r["a"])(i["default"],e["a"],e["b"],!1,null,"e5327a8c",null);n["default"]=s.exports},d508:function(t,n,a){n=t.exports=a("2350")(!1),n.push([t.i,'.content[data-v-45b711e6]{padding-top:%?20?%}.content .list[data-v-45b711e6]{height:%?113?%;padding:%?0?% %?24?% %?0?% %?34?%;background-color:#fff;margin-bottom:%?5?%}.content .list .name[data-v-45b711e6]{color:#222;font-size:%?30?%}.content .list .right-arrow[data-v-45b711e6]:after{content:"";width:%?20?%;height:%?20?%;position:absolute;right:%?40?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-right:%?1?% solid #c9c9c9;border-top:%?1?% solid #c9c9c9}.content .btn[data-v-45b711e6]{margin:%?114?% %?40?% %?0?% %?40?%}.content .btn .button[data-v-45b711e6]{color:#f98d52;height:%?87?%;line-height:%?87?%;border-radius:%?45?%;font-size:%?34?%;border:%?1?% solid #f98d52}.button[data-v-45b711e6]:after{border:none}',""])},ea0f:function(t,n,a){"use strict";a.r(n);var e=a("2c9f"),i=a("ad2d");for(var o in i)"default"!==o&&function(t){a.d(n,t,function(){return i[t]})}(o);a("6ed0");var r=a("2877"),s=Object(r["a"])(i["default"],e["a"],e["b"],!1,null,"45b711e6",null);n["default"]=s.exports},efd9:function(t,n,a){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var e=o(a("bd1a")),i=o(a("bb50"));function o(t){return t&&t.__esModule?t:{default:t}}var r={components:{customNav:i.default,statusBar:e.default},data:function(){return{title:"设置"}},methods:{tapBack:function(){uni.navigateBack({delta:1})},tapBindPhone:function(){uni.navigateTo({url:"../bind-phone/bind-phone",animationDuration:200})},tapChangePassword:function(){uni.navigateTo({url:"../change-password/change-password",animationDuration:200})},tapPersonInfo:function(){var t="../login/login";this.$tool.getUserData().id&&(t="../person-info/person-info"),uni.navigateTo({url:t,animationDuration:200})},removeLogin:function(){this.$tool.setUserData("del"),uni.switchTab({url:"/pages/my/my"})}}};n.default=r},f633:function(t,n,a){"use strict";var e=a("541d"),i=a.n(e);i.a},fa5a:function(t,n,a){var e=a("d508");"string"===typeof e&&(e=[[t.i,e,""]]),e.locals&&(t.exports=e.locals);var i=a("4f06").default;i("5fc6d853",e,!0,{sourceMap:!1,shadowMode:!1})}}]);