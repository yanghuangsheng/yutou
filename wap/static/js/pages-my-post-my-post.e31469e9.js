(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-my-post-my-post"],{"0198":function(t,e,a){var n=a("31c1");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var i=a("4f06").default;i("434c7f6c",n,!0,{sourceMap:!1,shadowMode:!1})},"21bd":function(t,e,a){"use strict";a.r(e);var n=a("544e"),i=a.n(n);for(var o in n)"default"!==o&&function(t){a.d(e,t,function(){return n[t]})}(o);e["default"]=i.a},"31c1":function(t,e,a){e=t.exports=a("2350")(!1),e.push([t.i,'.nav[data-v-8ac7b7ca]{width:100%;height:%?90?%;position:fixed;\n\t\n\ttop:0;\n\tleft:0;z-index:99;background-color:#fff;border-bottom:%?1?% solid #e9e9e9}.nav .title[data-v-8ac7b7ca]{width:%?300?%;font-size:%?34?%;line-height:%?89?%;color:#4a4a4a;text-align:center}.left-arrow[data-v-8ac7b7ca]{width:%?100?%;height:%?89?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;top:0;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;position:absolute;left:0}.left-arrow[data-v-8ac7b7ca] :after{content:"";width:%?25?%;height:%?25?%;position:absolute;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;margin-top:%?-13?%;left:%?35?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-left:%?4?% solid #adadad;border-bottom:%?4?% solid #adadad}.margin-bottom[data-v-8ac7b7ca]{margin-bottom:%?90?%}',""])},4013:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"index"},[1==t.page_status?a("v-uni-view",{staticClass:"wrap"},[a("uni-nav",{attrs:{title:t.title}}),a("v-uni-view",{staticClass:"content"},[a("release-content",{attrs:{list:t.list_data,isShow:t.show,showTime:t.show}}),a("load-more",{attrs:{loading_type:t.loadingType},on:{"set-status":function(e){e=t.$handleEvent(e),t.setLoadingType(e)}}})],1)],1):a("page-loading",{attrs:{pageStatus:t.page_status},on:{reload:function(e){e=t.$handleEvent(e),t.onRefresh(e)}}})],1)},i=[];a.d(e,"a",function(){return n}),a.d(e,"b",function(){return i})},4209:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[a("v-uni-view",{staticClass:"nav uni-center",style:{marginTop:t.statusBarHeight}},[a("v-uni-view",{staticClass:"title uni-ellipsis"},[t._v(t._s(t.title))]),a("v-uni-view",{staticClass:"left-arrow",on:{click:function(e){e=t.$handleEvent(e),t.goback(e)}}},[a("v-uni-view")],1)],1),a("v-uni-view",{staticClass:"margin-bottom"})],1)},i=[];a.d(e,"a",function(){return n}),a.d(e,"b",function(){return i})},"544e":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n=u(a("065c")),i=u(a("8058")),o=u(a("d8ec")),s=u(a("834a")),r=u(a("1193"));function u(t){return t&&t.__esModule?t:{default:t}}var c={components:{statusBar:n.default,pageLoading:o.default,uniNav:i.default,releaseContent:s.default,loadMore:r.default},data:function(){return{page_status:0,show:!1,loadingType:0,title:"我的帖子",list_data:[]}},onLoad:function(){this._onLoad()},onReachBottom:function(){this._onLoadMore()},methods:{setLoadingType:function(t){this.loadingType=t.status},onRefresh:function(){this._onLoad()},_onLoad:function(){var t=this,e=this.$tool.getUserData().id;if(!e)return t.page_status=1,!1;t.page_status=0;var a=setTimeout(function(){t.$tool.loadFail(t)},6e3);this.$http.get("user/my_post",{user_id:e}).then(function(e){0==e.code&&(t.list_data=e.data.list,t.start_id=e.data.start_id,t.page=1),t.page_status=1,clearTimeout(a)}).catch(function(t){console.log("err")})},_onLoadMore:function(){var t=this,e=this.$tool.getUserData().id;if(!e)return!1;0==this.loadingType&&(this.loadingType=1,this.$http.get("user/more_my_post",{user_id:e,page:this.page+1,start_id:this.start_id}).then(function(e){console.log(e);var a=e.data;if(0==a.length)return t.loadingType=2,!1;t.list_data=t.list_data.concat(a),t.page++,t.loadingType=0}))}}};e.default=c},6901:function(t,e,a){e=t.exports=a("2350")(!1),e.push([t.i,"",""])},"76b0":function(t,e,a){var n=a("6901");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var i=a("4f06").default;i("7e28f7d0",n,!0,{sourceMap:!1,shadowMode:!1})},8058:function(t,e,a){"use strict";a.r(e);var n=a("4209"),i=a("f732");for(var o in i)"default"!==o&&function(t){a.d(e,t,function(){return i[t]})}(o);a("fcaa");var s=a("2877"),r=Object(s["a"])(i["default"],n["a"],n["b"],!1,null,"8ac7b7ca",null);e["default"]=r.exports},"9ce3":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={props:{title:{type:String}},data:function(){return{statusBarHeight:""}},onLoad:function(){},methods:{goback:function(){uni.navigateBack({delta:1,animationType:"pop-out",animationDuration:200})}}};e.default=n},cd04:function(t,e,a){"use strict";var n=a("76b0"),i=a.n(n);i.a},da67:function(t,e,a){"use strict";a.r(e);var n=a("4013"),i=a("21bd");for(var o in i)"default"!==o&&function(t){a.d(e,t,function(){return i[t]})}(o);a("cd04");var s=a("2877"),r=Object(s["a"])(i["default"],n["a"],n["b"],!1,null,"59af1b40",null);e["default"]=r.exports},f732:function(t,e,a){"use strict";a.r(e);var n=a("9ce3"),i=a.n(n);for(var o in n)"default"!==o&&function(t){a.d(e,t,function(){return n[t]})}(o);e["default"]=i.a},fcaa:function(t,e,a){"use strict";var n=a("0198"),i=a.n(n);i.a}}]);