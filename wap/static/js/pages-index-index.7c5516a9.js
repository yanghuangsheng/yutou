(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-index-index"],{1002:function(t,i,a){"use strict";a.r(i);var e=a("ebc2"),n=a.n(e);for(var o in e)"default"!==o&&function(t){a.d(i,t,function(){return e[t]})}(o);i["default"]=n.a},"2aa8":function(t,i,a){i=t.exports=a("2350")(!1),i.push([t.i,'.content[data-v-db75f84c]{width:%?750?%}.header[data-v-db75f84c]{width:100%;height:%?89?%;background-color:#fff;border-bottom:%?1?% solid #f5f5f5;position:fixed;\r\n\tz-index:99}.logo-img[data-v-db75f84c]{height:%?79?%}.logo[data-v-db75f84c]{height:%?79?%;width:%?232?%}.sousuo[data-v-db75f84c]{height:%?89?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;\r\n\tmargin-left:%?60?%;\r\n\tposition:relative;width:60%;\r\n\t}.search[data-v-db75f84c]{width:%?100?%;position:absolute;z-index:1;\r\n\t\r\n\tright:%?-20?%\r\n\t}.search uni-image[data-v-db75f84c]{width:%?35?%;height:%?35?%}.search-ipt[data-v-db75f84c]{width:90%;height:%?60?%;\r\n\t\r\n\tpadding-left:%?25?%;\r\n\tbackground-color:#f4f4f4;border-radius:%?200?%}.search-ipt uni-input[data-v-db75f84c]{width:100%;height:%?60?%}.swiper[data-v-db75f84c]{padding-top:%?90?%}\r\n /* 轮播图S */.swiper[data-v-db75f84c]{width:%?750?%}.swiper-item[data-v-db75f84c]{width:100%;height:%?250?%}.swiper-item uni-image[data-v-db75f84c]{width:100%;height:100%}\r\n /* 广告 */.bell[data-v-db75f84c]{padding-top:%?9?%;margin-left:%?20?%}.bell uni-image[data-v-db75f84c]{width:%?30?%;height:%?30?%}.uni-swiper-msg[data-v-db75f84c]{width:100%;height:%?55?%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.news[data-v-db75f84c]{font-size:%?26?%}\r\n /* 热门快讯 */.hot-news[data-v-db75f84c]{height:%?210?%;margin:%?13?% %?20?%}.hot[data-v-db75f84c]{color:#353534;font-size:%?30?%}.border[data-v-db75f84c]{width:%?6?%;height:%?30?%;background-color:#c3c3c3;margin:%?9?% %?15?% %?0?% %?15?%}.h-title[data-v-db75f84c]{height:%?95?%;overflow:hidden;font-size:%?30?%;color:#282828;line-height:1.7em}.next[data-v-db75f84c]{text-align:right;color:#b1b0b0;margin-top:%?10?%;margin-right:%?30?%}.text_deal[data-v-db75f84c]{overflow:hidden;-o-text-overflow:ellipsis;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;word-break:break-all}\r\n /* 分割 */.divider[data-v-db75f84c]{background-color:#f5f5f5;width:100%;height:%?25?%}.line[data-v-db75f84c]{height:%?10?%;background-color:#f5f5f5}\r\n /* tab切换 */.title-text[data-v-db75f84c]{color:#6e6d6d;font-size:%?32?%;padding:%?5?% %?0?%;margin:%?0?% %?20?%}.tab-title[data-v-db75f84c]{width:100%;height:%?79?%;line-height:%?79?%}.active[data-v-db75f84c]{position:relative;color:#2d2d2d;z-index:99}.active[data-v-db75f84c]:after{position:absolute;z-index:10;bottom:%?-6?%;left:%?0?%;right:%?0?%;height:%?6?%;content:"";background-color:#ff0d0d}.fixed[data-v-db75f84c]{width:100%;background-color:#fff;position:fixed;\r\n\t\r\n\ttop:0;\r\n\tleft:0;z-index:999;padding:%?5?% %?0?% %?10?% %?0?%}.fixed[data-v-db75f84c]:after{position:absolute;z-index:10;right:%?0?%;bottom:%?-1?%;left:%?0?%;height:1px;content:"";-webkit-transform:scaleY(.5);-ms-transform:scaleY(.5);transform:scaleY(.5);background-color:#e9e9e9}.box[data-v-db75f84c]{width:%?0?%;height:%?666?%;position:absolute}',""])},6557:function(t,i,a){"use strict";var e=function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("v-uni-view",{staticClass:"index"},[a("v-uni-view",{staticClass:"box"}),1==t.page_status?a("v-uni-view",{staticClass:"content"},[a("v-uni-view",{staticClass:"header uni-inline-item"},[a("v-uni-view",{staticClass:"logo-img"},[a("v-uni-image",{staticClass:"logo",attrs:{src:"../../static/images/logo.png",mode:"scaleToFill"}})],1),a("v-uni-view",{staticClass:"sousuo uni-inline-item",on:{click:function(i){i=t.$handleEvent(i),t.tapSearch(i)}}},[a("v-uni-view",{staticClass:"search uni-inline-item"},[a("v-uni-image",{attrs:{src:"../../static/images/search.png"}})],1),a("v-uni-view",{staticClass:"search-ipt uni-inline-item"},[a("v-uni-input",{attrs:{type:"text",value:"","confirm-type":"search",disabled:"",placeholder:"请输入搜索内容"},on:{confirm:function(i){i=t.$handleEvent(i),t.searchMe(i)}}})],1)],1)],1),a("v-uni-view",{staticClass:"swiper"},[a("v-uni-swiper",{staticClass:"swiper-item",attrs:{"indicator-active-color":"#FFFFFF","indicator-dots":t.indicatorDots,autoplay:t.autoplay,interval:t.interval,duration:t.duration}},t._l(t.banner_data,function(t,i){return a("v-uni-swiper-item",{key:i},[a("v-uni-image",{attrs:{src:t.image_url,mode:"aspectFill","lazy-load":""}})],1)}),1)],1),a("v-uni-view",{staticClass:"uni-swiper-msg uni-flex"},[a("v-uni-view",{staticClass:"uni-swiper-msg-icon bell"},[a("v-uni-image",{attrs:{src:"../../static/images/horn.png",mode:"widthFix"}})],1),a("v-uni-swiper",{attrs:{autoplay:"true",circular:"true",interval:"2500"}},t._l(t.baroad_data,function(i,e){return a("v-uni-swiper-item",{key:e},[a("v-uni-view",{staticClass:"news",attrs:{"data-id":i.o_id},on:{click:function(i){i=t.$handleEvent(i),t.goDetail(i)}}},[a("v-uni-rich-text",{attrs:{nodes:i.content}})],1)],1)}),1)],1),a("v-uni-view",{staticClass:"divider"}),a("v-uni-view",{staticClass:"hot-news"},[a("v-uni-view",{staticClass:"title uni-flex"},[a("v-uni-navigator",{staticClass:"hot",attrs:{url:""}},[t._v("热门快讯")]),a("v-uni-view",{staticClass:"border"})],1),t._l(t.hot_data,function(i,e){return a("v-uni-view",{key:e},[a("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:e==t.hot_index,expression:"value==hot_index?true:false"}],staticClass:"h-title text_deal"},[t._v(t._s(i.title))])],1)}),a("v-uni-view",{staticClass:"next",on:{click:function(i){i=t.$handleEvent(i),t.next(1)}}},[t._v("下一篇")])],2),a("v-uni-view",{staticClass:"line"}),t.tabbar_data.length?a("v-uni-view",{staticClass:"tab"},[a("v-uni-view",{staticClass:"uni-flex tab-title",class:t.menuFixed?"fixed":"",style:t.menuFixed?t.tabFixed:""},t._l(t.tabbar_data,function(i,e){return a("v-uni-text",{key:e,staticClass:"title-text",class:{active:t.tabbar_index==e},on:{click:function(i){i=t.$handleEvent(i),t.tab(e)}}},[t._v(t._s(i.name))])}),1),a("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.menuFixed,expression:"menuFixed"}],staticClass:"tab-box",staticStyle:{"margin-bottom":"222upx"}}),a("uni-news-list",{attrs:{list:t.tabbar_data[t.tabbar_index].list},on:{click:function(i){i=t.$handleEvent(i),t.goTo_news(i)}}}),a("load-more",{attrs:{loading_type:t.loadingType},on:{"set-status":function(i){i=t.$handleEvent(i),t.setLoadingType(i)}}})],1):t._e()],1):a("page-loading",{attrs:{pageStatus:t.page_status},on:{reload:function(i){i=t.$handleEvent(i),t.onRefresh(i)}}})],1)},n=[];a.d(i,"a",function(){return e}),a.d(i,"b",function(){return n})},"8b59":function(t,i,a){var e=a("2aa8");"string"===typeof e&&(e=[[t.i,e,""]]),e.locals&&(t.exports=e.locals);var n=a("4f06").default;n("761762fc",e,!0,{sourceMap:!1,shadowMode:!1})},a042:function(t,i,a){"use strict";var e=a("8b59"),n=a.n(e);n.a},b3d0:function(t,i,a){"use strict";var e=function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("v-uni-view",[a("v-uni-view",{staticClass:"loading"},[a("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.loading_show,expression:"loading_show"}],staticClass:"loading-img"},[a("v-uni-view",{staticClass:"load1"},[a("v-uni-view",{style:{background:t.color}}),a("v-uni-view",{style:{background:t.color}}),a("v-uni-view",{style:{background:t.color}}),a("v-uni-view",{style:{background:t.color}})],1),a("v-uni-view",{staticClass:"load2"},[a("v-uni-view",{style:{background:t.color}}),a("v-uni-view",{style:{background:t.color}}),a("v-uni-view",{style:{background:t.color}}),a("v-uni-view",{style:{background:t.color}})],1),a("v-uni-view",{staticClass:"load3"},[a("v-uni-view",{style:{background:t.color}}),a("v-uni-view",{style:{background:t.color}}),a("v-uni-view",{style:{background:t.color}}),a("v-uni-view",{style:{background:t.color}})],1)],1)],1),a("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.error_show,expression:"error_show"}],staticClass:"load"},[a("v-uni-view",{staticClass:"load-img"},[a("v-uni-image",{attrs:{src:"/static/images/load.png"}})],1),a("v-uni-view",{staticClass:"prompt"},[a("v-uni-text",[t._v("加载失败了，等会再浪吧")])],1),a("v-uni-view",{staticClass:"reload uni-center",on:{click:function(i){i=t.$handleEvent(i),t.reload(i)}}},[a("v-uni-text",[t._v("重新加载")])],1)],1)],1)},n=[];a.d(i,"a",function(){return e}),a.d(i,"b",function(){return n})},b599:function(t,i,a){"use strict";a.r(i);var e=a("f6f4"),n=a.n(e);for(var o in e)"default"!==o&&function(t){a.d(i,t,function(){return e[t]})}(o);i["default"]=n.a},d8ec:function(t,i,a){"use strict";a.r(i);var e=a("b3d0"),n=a("b599");for(var o in n)"default"!==o&&function(t){a.d(i,t,function(){return n[t]})}(o);var s=a("2877"),r=Object(s["a"])(n["default"],e["a"],e["b"],!1,null,"066967ad",null);i["default"]=r.exports},ebc2:function(t,i,a){"use strict";Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var e=r(a("065c")),n=r(a("d8ec")),o=r(a("1193")),s=r(a("cd2d"));function r(t){return t&&t.__esModule?t:{default:t}}var d={components:{statusBar:e.default,pageLoading:n.default,loadMore:o.default,uniNewsList:s.default},data:function(){return{page_status:0,tabbar_index:0,hot_index:0,indicatorDots:!0,autoplay:!0,interval:3500,duration:500,menuFixed:"",loadingType:0,banner_data:[],baroad_data:[],hot_data:[],tabbar_data:[],statusBarHeight:""}},computed:{tabFixed:function(){return"margin-top:".concat(this.statusBarHeight)}},onPageScroll:function(t){var i=this,a=uni.createSelectorQuery().select(".box");a.boundingClientRect(function(t){i.height=t.height}).exec(),t.scrollTop>=this.height?this.menuFixed=!0:this.menuFixed=!1},onLoad:function(){this._onLoad()},onPullDownRefresh:function(){this._onLoad(1)},onReachBottom:function(){var t=this;if(0==this.loadingType){this.loadingType=1;var i=this.tabbar_index,a=this.tabbar_data[i],e=a.page+1;this.$http.get("news/list",{category_id:a.category_id,page:e,start_id:a.start_id}).then(function(a){if(0==a.data.length)return t.loadingType=2,!1;t.tabbar_data[i].list=t.tabbar_data[i].list.concat(a.data),t.tabbar_data[i].page=e,t.loadingType=0}).catch(function(t){console.log("page_err")})}},methods:{tab:function(t){var i=this;i.tabbar_index=t},next:function(t){return 0!=this.hot_data.length&&(this.hot_index==this.hot_data.length-1?(this.hot_index=0,!1):void(this.hot_index+=t))},getInfo:function(){var t=this;uni.getSystemInfo({success:function(i){t.statusBarHeight=i.statusBarHeight+44+"px",console.log(t.statusBarHeight)}})},goDetail:function(t){var i=this.$tool.getDataSet(t,"id");console.log(i),uni.navigateTo({url:"../community-detail/community-detail?id="+i,animationDuration:400})},tapSearch:function(){uni.navigateTo({url:"../search-detail/search-detail",animationDuration:400})},setLoadingType:function(t){this.loadingType=t.status},onRefresh:function(){this._onLoad()},_onLoad:function(t){var i=this;i.page_status=t?3:0;var a=setTimeout(function(){t&&uni.stopPullDownRefresh(),i.$tool.loadFail(i)},6e3);i.$http.get("index/all").then(function(e){var n=e.data;i.banner_data=n.banner,i.hot_data=n.hot_news,i.tabbar_data=n.news_column,i.baroad_data=n.baroadcast,i.page_status=1,t&&uni.stopPullDownRefresh(),clearTimeout(a)}).catch(function(t){console.log("err")})}}};i.default=d},f2c6:function(t,i,a){"use strict";a.r(i);var e=a("6557"),n=a("1002");for(var o in n)"default"!==o&&function(t){a.d(i,t,function(){return n[t]})}(o);a("a042");var s=a("2877"),r=Object(s["a"])(n["default"],e["a"],e["b"],!1,null,"db75f84c",null);i["default"]=r.exports},f6f4:function(t,i,a){"use strict";Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var e={props:{color:{type:String,default:"#777777"},pageStatus:{type:Number}},data:function(){return{}},computed:{loading_show:function(){return 0==this.pageStatus},error_show:function(){return 2==this.pageStatus}},methods:{reload:function(){this.$emit("reload")}}};i.default=e}}]);