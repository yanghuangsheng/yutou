(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-login-login"],{"066f":function(t,i,e){"use strict";Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var n={data:function(){return{codeTxt:"获取验证码",disabled:!1,tel:!1,codes:!1,mobile:"",codeNum:"",currentTime:60}},methods:{mobileInput:function(t){this.mobile=t.target.value},codeInput:function(t){this.codeNum=t.target.value},isMobile:function(t){var i=/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\d{8})$/;return!!i.test(t)},isCode:function(t){var i=/^\d{6}$/;return!!i.test(t)},_calculationTime:function(){var t=this;this.tel=!1,this.time="60s",this.disabled=!0;var i=this.currentTime,e=this.setTime;t.codeTxt=i+"s",e=setInterval(function(){t.codeTxt=i-1+"s",i--,i<=0&&(clearInterval(e),t.codeTxt="重新获取",t.currentTime=60,t.disabled=!1)},1e3)},getCode:function(t){var i=this,e=this.mobile;if(!1===this.isMobile(e))this.tel=!0;else{if(this.disabled)return!1;this.$http.post("send_sms",{mobile:e}).then(function(t){if(0===t.code)return i.code_sign=t.data.sign,i._calculationTime(),!1;console.log("获取验证码失败")}).catch(function(t){console.log("login_err")})}},btnclick:function(t){var i=this,e=this.codeNum,n=this.mobile,o={code:e,mobile:n,code_sign:this.code_sign};return!1===this.isMobile(n)?(this.tel=!0,!1):!1===this.isCode(e)?(this.codes=!0,!1):void this.$http.post("login",o).then(function(t){console.log(t),0===t.code?(i.$tool.setUserData(t.data),uni.navigateBack({delta:1})):i.codes=!0}).catch(function(t){console.log("login_err")})},q_regiter:function(){uni.redirectTo({url:"../register/register"})},goBack:function(){uni.navigateBack({delta:1})},appOAuthLogin:function(t){var i=this,e=i.$tool.getDataSet(t,"logintype");console.log(e),uni.login({provider:e,success:function(t){uni.getUserInfo({provider:e,success:function(t){console.log(JSON.stringify(t))}})}})},wxLogin:function(t){var i=this,e=t.detail.userInfo;console.log(e),uni.login({provider:"weixin",success:function(t){e.code=t.code,i.$http.post("wx_login",e).then(function(t){console.log(t),0===t.code?(i.$tool.setUserData(t.data),uni.navigateBack({delta:1})):i.$tool.showToast("授权登陆失败")}).catch(function(t){console.log("err")})}})}}};i.default=n},"3a24":function(t,i,e){"use strict";e.r(i);var n=e("c7d3"),o=e("c693");for(var a in o)"default"!==a&&function(t){e.d(i,t,function(){return o[t]})}(a);e("d699");var s=e("2877"),l=Object(s["a"])(o["default"],n["a"],n["b"],!1,null,"391f9994",null);i["default"]=l.exports},"53fa":function(t,i,e){var n=e("d2b2");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var o=e("4f06").default;o("75bef0c8",n,!0,{sourceMap:!1,shadowMode:!1})},b041:function(t,i){t.exports=function(t){return"string"!==typeof t?t:(/^['"].*['"]$/.test(t)&&(t=t.slice(1,-1)),/["'() \t\n]/.test(t)?'"'+t.replace(/"/g,'\\"').replace(/\n/g,"\\n")+'"':t)}},c693:function(t,i,e){"use strict";e.r(i);var n=e("066f"),o=e.n(n);for(var a in n)"default"!==a&&function(t){e.d(i,t,function(){return n[t]})}(a);i["default"]=o.a},c7d3:function(t,i,e){"use strict";var n=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-view",{staticClass:"wrap"},[e("v-uni-view",{staticClass:"top"},[e("v-uni-view",{staticClass:"left-arrow uni-inline-item",on:{click:function(i){i=t.$handleEvent(i),t.goBack(i)}}},[e("v-uni-view")],1),e("v-uni-view",{staticClass:"logo uni-center uni-column"},[e("v-uni-view",{staticClass:"logo_img"},[e("v-uni-image",{attrs:{src:"../../static/images/logo_1.png"}})],1),e("v-uni-view",{staticClass:"title"},[e("v-uni-text",[t._v("鱼头")])],1)],1)],1),e("v-uni-view",{staticClass:"content"},[e("v-uni-view",{staticClass:"list uni-inline-item"},[e("v-uni-view",{staticClass:"tel"},[e("v-uni-text",[t._v("手机号")])],1),e("v-uni-view",{staticClass:"tel-line"}),e("v-uni-view",{staticClass:"input-tel uni-flex"},[e("v-uni-input",{staticClass:"ipt",attrs:{type:"number",maxlength:"11",placeholder:"输入手机号","placeholder-style":"color:#f9baa9;font-size: 30upx"},on:{input:function(i){i=t.$handleEvent(i),t.mobileInput(i)}}})],1)],1),e("v-uni-view",{staticClass:"err-warn"},[e("v-uni-text",{directives:[{name:"show",rawName:"v-show",value:t.tel,expression:"tel"}]},[t._v("手机号不正确或为空")])],1),e("v-uni-view",{staticClass:"list uni-inline-item"},[e("v-uni-view",{staticClass:"code-input uni-flex"},[e("v-uni-input",{staticClass:"codeNum",attrs:{maxlength:"6",placeholder:"请输入验证码","placeholder-style":"color:#f9baa9;font-size: 30upx"},on:{input:function(i){i=t.$handleEvent(i),t.codeInput(i)}}})],1),e("v-uni-view",{staticClass:"code-line"}),e("v-uni-view",{staticClass:"code-btn"},[e("v-uni-text",{staticClass:"code",on:{click:function(i){i=t.$handleEvent(i),t.getCode(i)}}},[t._v(t._s(t.codeTxt))])],1)],1),e("v-uni-view",{staticClass:"err-warn"},[e("v-uni-text",{directives:[{name:"show",rawName:"v-show",value:t.codes,expression:"codes"}]},[t._v("验证码错误或已过期")])],1),e("v-uni-view",{staticClass:"login"},[e("v-uni-button",{staticClass:"btn",attrs:{type:""},on:{click:function(i){i=t.$handleEvent(i),t.btnclick(i)}}},[t._v("登录")])],1),e("v-uni-view",{staticClass:"register",on:{click:function(i){i=t.$handleEvent(i),t.q_regiter(i)}}},[e("v-uni-text",[t._v("快速注册")])],1)],1)],1)},o=[];e.d(i,"a",function(){return n}),e.d(i,"b",function(){return o})},d02e:function(t,i){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADoAAAA6CAYAAADhu0ooAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTAyMDFDNzY1QjZDMTFFOTg4ODNGQTFBOEMzMTQwOUMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTAyMDFDNzc1QjZDMTFFOTg4ODNGQTFBOEMzMTQwOUMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo1MDIwMUM3NDVCNkMxMUU5ODg4M0ZBMUE4QzMxNDA5QyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo1MDIwMUM3NTVCNkMxMUU5ODg4M0ZBMUE4QzMxNDA5QyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PnVBGH4AAAyBSURBVHja7FsJkFTV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"},d2b2:function(t,i,e){var n=e("b041");i=t.exports=e("2350")(!1),i.push([t.i,'uni-page-body[data-v-391f9994]{width:100%;height:100%;background:-webkit-gradient(linear,left top,left bottom,color-stop(0,#fa953b),to(#f74343));background:-o-linear-gradient(top,#fa953b 0,#f74343 100%);background:linear-gradient(180deg,#fa953b 0,#f74343)}.wrap[data-v-391f9994]{position:relative;height:100%}.wrap .left-arrow[data-v-391f9994]{width:%?100?%;height:%?90?%;\r\n\tposition:relative}.wrap .left-arrow[data-v-391f9994] :after{content:"";width:%?25?%;height:%?25?%;position:absolute;margin-top:%?-13?%;left:%?35?%;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);border-left:%?4?% solid #fff;border-bottom:%?4?% solid #fff}.wrap .logo[data-v-391f9994]{position:absolute;top:15%;left:50%;margin-left:%?-73?%}.wrap .logo .logo_img uni-image[data-v-391f9994]{width:%?147?%;height:%?108?%}.wrap .logo .title[data-v-391f9994]{font-size:%?32?%;color:#fff;margin-top:%?20?%;margin-bottom:%?30?%}.content[data-v-391f9994]{position:absolute;top:50%;margin-top:%?-235?%}.content .list[data-v-391f9994]{height:%?84?%;background-color:#f79271;border-radius:%?45?%;margin:%?0?% %?90?%;position:relative}.content .list .tel[data-v-391f9994]{font-size:%?32?%;color:#fff;padding-left:%?30?%}.content .list .tel-line[data-v-391f9994]{width:%?1?%;height:%?36?%;margin:%?0?% %?50?% %?0?% %?10?%;background-color:#fff}.content .err-warn[data-v-391f9994]{height:%?30?%;margin:%?10?% %?0?% %?20?% %?110?%;color:red;font-size:%?24?%}.content .list .codeNum[data-v-391f9994]{padding-left:%?30?%}.content .list .code-input[data-v-391f9994]{margin-right:%?15?%}.content .list .code-line[data-v-391f9994]{width:%?2?%;height:%?37?%;background-color:#fff;z-index:33}.content .list .code-btn[data-v-391f9994]{width:%?210?%;height:%?84?%;text-align:center;line-height:%?84?%;margin-right:%?30?%;font-size:%?32?%;color:#fff}.content .login[data-v-391f9994]{margin:%?35?% %?90?% %?25?% %?90?%}.content .login .btn[data-v-391f9994]{height:%?84?%;line-height:%?84?%;border-radius:%?45?%;background-color:#f4c762;color:#fff}.content .register[data-v-391f9994]{margin-top:%?40?%;text-align:center;color:#fff}.content .bottom[data-v-391f9994]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.bottom .quick[data-v-391f9994]{width:%?650?%;position:fixed;bottom:6%;margin:0 %?50?%}.bottom .quick .quick_login[data-v-391f9994]{height:%?50?%}.bottom .quick_login .line[data-v-391f9994]{width:%?240?%;height:%?2?%;background-color:#f98177}.bottom .quick_login .q-login[data-v-391f9994]{margin:0 auto;color:#f7dedd;font-size:%?26?%}.bottom .prompt[data-v-391f9994]{color:#f7dedd;text-align:center;font-size:%?24?%}.login-way[data-v-391f9994]{text-align:center}.login-way uni-image[data-v-391f9994]{width:%?58?%;height:%?58?%;margin:%?60?% %?90?% %?0?% %?90?%}.wechat-login[data-v-391f9994]{width:%?58?%;height:%?58?%;border-radius:100%;background:url('+n(e("d02e"))+");background-size:%?58?% %?58?%;margin-top:%?20?%}body.?%PAGE?%[data-v-391f9994]{background:-webkit-gradient(linear,left top,left bottom,color-stop(0,#fa953b),to(#f74343));background:-o-linear-gradient(top,#fa953b 0,#f74343 100%);background:linear-gradient(180deg,#fa953b 0,#f74343)}",""])},d699:function(t,i,e){"use strict";var n=e("53fa"),o=e.n(n);o.a}}]);