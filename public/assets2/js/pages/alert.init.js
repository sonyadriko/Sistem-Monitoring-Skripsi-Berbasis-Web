/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/pages/alert.init.js":
/*!******************************************!*\
  !*** ./resources/js/pages/alert.init.js ***!
  \******************************************/
/***/ (() => {

/*
Template Name: Dason - Admin & Dashboard Template
Author: Themesdesign
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: Alert init js
*/
var alertPlaceholder = document.getElementById('liveAlertPlaceholder');
var alertTrigger = document.getElementById('liveAlertBtn');

function alert(message, type) {
  var wrapper = document.createElement('div');
  wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
  alertPlaceholder.append(wrapper);
}

if (alertTrigger) {
  alertTrigger.addEventListener('click', function () {
    alert('Nice, you triggered this alert message!', 'primary');
  });
}

/***/ }),

/***/ "./resources/scss/bootstrap.scss":
/*!***************************************!*\
  !*** ./resources/scss/bootstrap.scss ***!
  \***************************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nModuleBuildError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\nTypeError: Cannot read properties of undefined (reading 'indexOf')\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:95408:12\n    at Object.applyHooksTransformer (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6915:14)\n    at Object.initHooks (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6895:251)\n    at Object.initNativeDispatchContinue (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6861:9)\n    at Object.initNativeDispatch (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6855:9)\n    at Object.getNativeInterceptor (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:8749:13)\n    at Object.getInterceptor$x (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:9005:16)\n    at Object.set$info$x (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:9036:16)\n    at Object.main (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:2479:9)\n    at main1 (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:17960:9)\n    at processResult (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:751:19)\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:853:5\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:399:11\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:251:18\n    at runSyncOrAsync (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:156:3)\n    at iterateNormalLoaders (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:250:2)\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:223:4\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:827:15\n    at Array.eval (eval at create (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:12:1)\n    at runCallbacks (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\enhanced-resolve\\lib\\CachedInputFileSystem.js:27:15)");

/***/ }),

/***/ "./resources/scss/icons.scss":
/*!***********************************!*\
  !*** ./resources/scss/icons.scss ***!
  \***********************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nModuleBuildError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\nTypeError: Cannot read properties of undefined (reading 'indexOf')\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:95408:12\n    at Object.applyHooksTransformer (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6915:14)\n    at Object.initHooks (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6895:251)\n    at Object.initNativeDispatchContinue (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6861:9)\n    at Object.initNativeDispatch (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6855:9)\n    at Object.getNativeInterceptor (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:8749:13)\n    at Object.getInterceptor$x (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:9005:16)\n    at Object.set$info$x (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:9036:16)\n    at Object.main (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:2479:9)\n    at main1 (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:17960:9)\n    at processResult (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:751:19)\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:853:5\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:399:11\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:251:18\n    at runSyncOrAsync (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:156:3)\n    at iterateNormalLoaders (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:250:2)\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:223:4\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:827:15\n    at Array.eval (eval at create (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:12:1)\n    at runCallbacks (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\enhanced-resolve\\lib\\CachedInputFileSystem.js:27:15)");

/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nModuleBuildError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\nTypeError: Cannot read properties of undefined (reading 'indexOf')\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:95408:12\n    at Object.applyHooksTransformer (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6915:14)\n    at Object.initHooks (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6895:251)\n    at Object.initNativeDispatchContinue (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6861:9)\n    at Object.initNativeDispatch (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6855:9)\n    at Object.getNativeInterceptor (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:8749:13)\n    at Object.getInterceptor$x (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:9005:16)\n    at Object.set$info$x (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:9036:16)\n    at Object.main (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:2479:9)\n    at main1 (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:17960:9)\n    at processResult (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:751:19)\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:853:5\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:399:11\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:251:18\n    at runSyncOrAsync (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:156:3)\n    at iterateNormalLoaders (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:250:2)\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:223:4\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:827:15\n    at Array.eval (eval at create (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:12:1)\n    at runCallbacks (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\enhanced-resolve\\lib\\CachedInputFileSystem.js:27:15)");

/***/ }),

/***/ "./resources/scss/preloader.scss":
/*!***************************************!*\
  !*** ./resources/scss/preloader.scss ***!
  \***************************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nModuleBuildError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\nTypeError: Cannot read properties of undefined (reading 'indexOf')\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:95408:12\n    at Object.applyHooksTransformer (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6915:14)\n    at Object.initHooks (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6895:251)\n    at Object.initNativeDispatchContinue (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6861:9)\n    at Object.initNativeDispatch (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:6855:9)\n    at Object.getNativeInterceptor (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:8749:13)\n    at Object.getInterceptor$x (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:9005:16)\n    at Object.set$info$x (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:9036:16)\n    at Object.main (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:2479:9)\n    at main1 (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\sass\\sass.dart.js:17960:9)\n    at processResult (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:751:19)\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:853:5\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:399:11\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:251:18\n    at runSyncOrAsync (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:156:3)\n    at iterateNormalLoaders (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:250:2)\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\loader-runner\\lib\\LoaderRunner.js:223:4\n    at C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\webpack\\lib\\NormalModule.js:827:15\n    at Array.eval (eval at create (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:12:1)\n    at runCallbacks (C:\\xampp\\htdocs\\Dason-Laravel_v1.0.0\\Admin\\node_modules\\enhanced-resolve\\lib\\CachedInputFileSystem.js:27:15)");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	__webpack_modules__["./resources/js/pages/alert.init.js"]();
/******/ 	// This entry module doesn't tell about it's top-level declarations so it can't be inlined
/******/ 	__webpack_modules__["./resources/scss/bootstrap.scss"]();
/******/ 	__webpack_modules__["./resources/scss/icons.scss"]();
/******/ 	__webpack_modules__["./resources/scss/app.scss"]();
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/scss/preloader.scss"]();
/******/ 	
/******/ })()
;