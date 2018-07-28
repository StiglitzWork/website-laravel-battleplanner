/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 39);
/******/ })
/************************************************************************/
/******/ ({

/***/ 10:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Helpers; });
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Helpers = function () {

    /**************************
            Constructor
    **************************/

    function Helpers() {
        _classCallCheck(this, Helpers);
    }

    /**************************
        Filter Functions
    **************************/

    _createClass(Helpers, [{
        key: '_objectNotDeleted',
        value: function _objectNotDeleted(object) {
            if (!object.deleted) {
                return object;
            }
        }
    }, {
        key: '_objectIdEquals',
        value: function _objectIdEquals(object, id) {
            if (object.id == id) {
                return object;
            }
        }
    }, {
        key: '_objectDbIdEquals',
        value: function _objectDbIdEquals(object, id) {
            if (object.dbId == id) {
                return object;
            }
        }
    }, {
        key: '_objectInside',
        value: function _objectInside(object, x, y) {
            if (object.inside(x, y)) {
                return object;
            }
        }
    }, {
        key: '_objectSelected',
        value: function _objectSelected(object) {
            if (object.selected) {
                return object;
            }
        }

        /**************************
            Id Generation Methods
        **************************/

        /**
         * @description makes a unique id
         * @method _makeId
         * @return {string}
         */

    }, {
        key: '_makeId',
        value: function _makeId(relevantIds) {
            var id = this._guid();
            while (relevantIds.includes(id)) {
                id = this._guid();
            }
            return id;
        }

        // Helper for _makeId

    }, {
        key: '_guid',
        value: function _guid() {
            return this._s4() + this._s4() + '-' + this._s4() + '-' + this._s4() + '-' + this._s4() + '-' + this._s4() + this._s4() + this._s4();
        }

        // Helper for _guid

    }, {
        key: '_s4',
        value: function _s4() {
            return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
        }

        // Makes array of id from the objects

    }, {
        key: '_getIds',
        value: function _getIds(arrayObjects) {
            var results = [];
            for (var i = 0; i < arrayObjects.length; i++) {
                results.push(arrayObjects[i].id);
            }
            return results;
        }
    }]);

    return Helpers;
}();



/***/ }),

/***/ 11:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Floor; });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

/**************************
	Extention class type
**************************/
var Helpers = __webpack_require__(10).default;

var Floor = function (_Helpers) {
    _inherits(Floor, _Helpers);

    /**************************
            Constructor
    **************************/

    function Floor(id, src) {
        _classCallCheck(this, Floor);

        // Identifiers
        var _this = _possibleConstructorReturn(this, (Floor.__proto__ || Object.getPrototypeOf(Floor)).call(this));
        // Super Class constructor call


        _this.type = "Floor"; // Json identifier
        _this.id = id;
        _this.src = src;
        return _this;
    }

    /**************************
             Getters
    **************************/

    /**************************
        Helper functions
    **************************/

    return Floor;
}(Helpers);



/***/ }),

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(40);


/***/ }),

/***/ 40:
/***/ (function(module, exports, __webpack_require__) {

/**************************
        Inports
**************************/
var bootstrap = window.bootstrap;

/**************************
    Class type definition
**************************/
var App = __webpack_require__(41).default;

/**************************
    Constant declarations
**************************/
var CANVAS_BACKGROUND_ID = "background";
var CANVAS_OVERLAY_ID = "overlay";
var VIEWPORT_ID = "viewport";

/**************************
    Variable Declaration
**************************/
var app;
app = new App(MAP_ID, FLOOR_SOURCES, VIEWPORT_ID, CANVAS_BACKGROUND_ID, CANVAS_OVERLAY_ID);
// app.load();

/**************************
 Remove Default Html Events
**************************/
$("#" + CANVAS_BACKGROUND_ID + ', #' + CANVAS_OVERLAY_ID).on("contextmenu", function (e) {
    return false;
});

// Zoom eventlistener
$("#" + VIEWPORT_ID).on('wheel', function (ev) {
    ev.preventDefault();

    var step;
    var incr = 0.1;

    if (ev.originalEvent.wheelDelta) {
        step = ev.originalEvent.wheelDelta > 0 ? -incr : incr;
    }

    if (ev.originalEvent.deltaY) {
        step = ev.originalEvent.deltaY > 0 ? -incr : incr;
    }

    app.zoom(step, ev.originalEvent.offsetX, ev.originalEvent.offsetY);
});

/**************************
 Windows Event Assignment
**************************/
if (typeof window.app === "undefined") {
    window.app = {};
}

window.app.engine = app;

/***/ }),

/***/ 41:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return App; });
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * Main appication class, includes all ui functionality and application flow of the various parts
 *
 * @version 0.1
 * @author Erik Smith
 */
var App = function () {

    /**************************
            Constructor
    **************************/

    function App(Map_dbId, floorSources, viewportId, canvasBackgroundId, canvasOverlayId) {
        _classCallCheck(this, App);

        // Instantiatable class types
        this.Map = __webpack_require__(42).default;
        this.Floor = __webpack_require__(11).default;
        this.Ui = __webpack_require__(43).default;

        // Identifiers
        this.type = "App"; // Json identifier

        // Varable declarations
        this.map = new this.Map(Map_dbId, floorSources);
        this.ui = new this.Ui(viewportId, canvasBackgroundId, canvasOverlayId, this.map);

        // Event variables
        this.originPoints = {
            "x": 0,
            "y": 0

            // Eventing variables
        };this.lmb = false;
        this.rmb = false;

        this.resizeRangeX = false;
        this.resizeRangeY = false;
        this.placeholderResizing = null;
    }

    /**************************
            App Methods
    **************************/

    _createClass(App, [{
        key: 'zoom',
        value: function zoom(amount, x, y) {
            var coordinates = this._calculateOffset(x, y);
            this.ui.zoomCanvases(amount, x, y);
            this.ui.backgroundUpdate = true;
            this.ui.overlayUpdate = true;
            this.ui.update();
        }

        /**************************
              Floor Methods
        **************************/

    }, {
        key: 'changeFloor',
        value: function changeFloor(amount) {
            this.map.changeFloor(amount);
            this.ui.floorChange = true;
            this.ui.update();
        }

        /**************************
            Canvas Methods
        **************************/

    }, {
        key: 'canvasUp',
        value: function canvasUp(ev) {
            var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);
            this._clickDeactivateEventListen(ev);

            if (!this.lmb) {
                this.ui.overlayUpdate = true;
                this.ui.update();
            }
        }
    }, {
        key: 'canvasDown',
        value: function canvasDown(ev) {
            // var eventX = (ev.offsetX)/ this.ui.ratio;
            // var eventY = (ev.offsetY) / this.ui.ratio;
            var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);
            this._clickActivateEventListen(ev);
            if (this.lmb) {

                // Update UI
                this.ui.overlayUpdate = true;
                this.ui.update();
            }
        }
    }, {
        key: 'canvasMove',
        value: function canvasMove(ev) {
            var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);

            if (this.rmb) {
                this.ui.move(this.originPoints["x"] - ev.offsetX / this.ui.ratio, this.originPoints["y"] - ev.offsetY / this.ui.ratio);
                this.ui.backgroundUpdate = true;
            }

            if (this.lmb) {
                this.ui.overlayUpdate = true;
                this.ui.update();
            } else {
                // Resize event check
                this.resizeRangeY = false;
                this.resizeRangeX = false;
            }

            if (this.rmb || this.lmb) {
                this.originPoints = {
                    "x": ev.offsetX / this.ui.ratio,
                    "y": ev.offsetY / this.ui.ratio //2 dimentional
                };
            }
        }
    }, {
        key: 'canvasEnter',
        value: function canvasEnter(ev) {
            var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);
            this._deactivateClickEventListen();

            // Update UI
            this.ui.overlayUpdate = true;
            this.ui.update();
        }
    }, {
        key: 'canvasLeave',
        value: function canvasLeave(ev) {
            var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);
            this._deactivateClickEventListen();

            // Update UI
            this.ui.overlayUpdate = true;
            this.ui.update();
        }

        /**************************
            Event detection
        **************************/

        /**
         * @description activates button press that triggered the event
         * @method _clickActivateEventListen
         * @param  {event} event that trigger this method
         * @return {undefined}
         */

    }, {
        key: '_clickActivateEventListen',
        value: function _clickActivateEventListen(ev) {
            var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);

            this.originPoints = {
                "x": ev.offsetX / this.ui.ratio,
                "y": ev.offsetY / this.ui.ratio //2 dimentional
            };if (ev.button == 0) this.lmb = true;
            if (ev.button == 2) this.rmb = true;
        }

        /**
         * @description unsets event provided it was pressed/released
         * @method _clickDeactivateEventListen
         * @param  {event} event that trigger this method
         * @return {undefined}
         */

    }, {
        key: '_clickDeactivateEventListen',
        value: function _clickDeactivateEventListen(ev) {
            if (ev.button == 0) this.lmb = false;
            if (ev.button == 2) this.rmb = false;
            this.resizeRangeY = false;
            this.resizeRangeX = false;
            this.placeholderResizing = null;
        }

        /**
         * @description removes any event handlers for a mouse
         * @method _deactivateClickEventListen
         * @return {undefined}
         */

    }, {
        key: '_deactivateClickEventListen',
        value: function _deactivateClickEventListen() {
            this.lmb = false;
            this.rmb = false;
        }

        /**************************
            Helper Methods
        **************************/

        /**
         * @description determine if an array contains one or more items from another array.
         * @param {array} haystack the array to search.
         * @param {array} arr the array providing items to check for in the haystack.
         * @return {boolean} true|false if haystack contains at least one item from arr.
         */

    }, {
        key: '_contains',
        value: function _contains(haystack, arr) {
            return arr.some(function (v) {
                return haystack.indexOf(v) >= 0;
            });
        }
    }, {
        key: '_calculateOffset',
        value: function _calculateOffset(evx, evy) {
            var jsonResponse = {};
            jsonResponse.x = evx / this.ui.ratio + this.ui.offsetX / this.ui.ratio;
            jsonResponse.y = evy / this.ui.ratio + this.ui.offsetY / this.ui.ratio;
            return jsonResponse;
        }
    }]);

    return App;
}();



/***/ }),

/***/ 42:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Map; });
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

/**************************
	Extention class type
**************************/
var Helpers = __webpack_require__(10).default;

var Map = function (_Helpers) {
    _inherits(Map, _Helpers);

    /**************************
            Constructor
    **************************/

    function Map(dbId, floorSources) {
        _classCallCheck(this, Map);

        // Instantiatable class types
        var _this = _possibleConstructorReturn(this, (Map.__proto__ || Object.getPrototypeOf(Map)).call(this));
        // Super Class constructor call


        _this.Floor = __webpack_require__(11).default;

        // Identifiers
        _this.dbId = dbId;
        _this.type = "Map"; // Json identifier

        // Variables
        _this.floor = null;
        _this.floors = [];

        _this.initialization(floorSources);
        return _this;
    }

    /**************************
        Floor Methods
    **************************/

    _createClass(Map, [{
        key: 'getFloor',
        value: function getFloor(id) {
            var _this2 = this;

            return this.floors.filter(function (floor) {
                return _this2._objectIdEquals(floor, id);
            })[0];
        }
    }, {
        key: 'getFloorDbId',
        value: function getFloorDbId(dbId) {
            var _this3 = this;

            return this.floors.filter(function (floor) {
                return _this3._objectDbIdEquals(floor, dbId);
            })[0];
        }

        //Positive or negative values accepted

    }, {
        key: 'changeFloor',
        value: function changeFloor(amount) {
            if (amount == 0) {
                throw new Error("Cannot change floor by 0.");
                return;
            }

            // positive
            if (amount > 0) {
                for (var i = 0; i != amount; i++) {
                    if (this.hasNextFloor()) {
                        this.nextFloor();
                    } else {
                        return;
                    }
                }
                //Negative
            } else {
                for (var i = 0; i != amount; i--) {
                    if (this.hasPreviousFloor()) {
                        this.previousFloor();
                    } else {
                        return;
                    }
                }
            }
            // Error checking
            if (!this.floor) {
                throw new Error("Something when wrong when changing floors");
            }
        }
    }, {
        key: 'nextFloor',
        value: function nextFloor() {
            if (this.hasNextFloor()) {
                this.floor = this.floors[this.floor.number + 1];
            }
        }
    }, {
        key: 'previousFloor',
        value: function previousFloor() {
            if (this.hasPreviousFloor()) {
                this.floor = this.floors[this.floor.number - 1];
            }
        }
    }, {
        key: 'hasNextFloor',
        value: function hasNextFloor() {
            if (this.floor.number < this.floors.length - 1) {
                return true;
            }
            return false;
        }
    }, {
        key: 'hasPreviousFloor',
        value: function hasPreviousFloor() {
            if (this.floor.number - 1 >= 0) {
                return true;
            }
            return false;
        }
    }, {
        key: 'setFloor',
        value: function setFloor(id) {
            var floor = this.getFloor(id);
            if (floor) {
                this.floor = floor;
            }
        }

        /**************************
            Display Methods
        **************************/

        /**
         * @description innitialisation of the DOM. Sets the size of background and overlay and paints the background. Also creates all the questions from sidebar
         * @method _initialization
         * @return {undefined}
         */

    }, {
        key: 'initialization',
        value: function initialization(floorSources) {
            // Innitialize the floors
            this.loadFloors(floorSources);
        }
    }, {
        key: 'loadFloors',
        value: function loadFloors(floorSources) {
            for (var i = 0; i < floorSources.length; i++) {
                this.floors.push(new this.Floor(floorSources[i].id, floorSources[i].src));
            }

            // init the current floor
            this.floor = this.floors[0];
        }

        /**
         * @description updates the active subclasses
         * @method _update
         * @return {undefined}
         */

    }, {
        key: '_update',
        value: function _update() {
            this.floor.update();
        }

        /**************************
            Helper functions
        **************************/

    }]);

    return Map;
}(Helpers);



/***/ }),

/***/ 43:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Ui; });
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Ui = function () {

    /**************************
            Constructor
    **************************/

    function Ui(viewportId, canvasBackgroundId, canvasOverlayId, map) {
        _classCallCheck(this, Ui);

        // Identifiers
        this.type = "Ui"; // Json identifier

        // Document Ids
        this.canvasBackgroundId = canvasBackgroundId;
        this.canvasOverlayId = canvasOverlayId;
        this.viewportId = viewportId;

        // Public variables
        this.backgroundImage = null;

        // Zoom variables
        this.ratio = 1;
        this.height = 0;
        this.width = 0;
        this.offsetX = 0;
        this.offsetY = 0;
        this.vpx = 0;
        this.vpy = 0;
        this.vpw = $("#" + this.viewportId).innerWidth;
        this.vph = $("#" + this.viewportId).innerHeight;

        // Subscribed objects
        this.map = map;

        // updateFlags
        this.floorChange = true;
        this.overlayUpdate = false;
        this.backgroundUpdate = false;
        this.listUpdate = true;

        this._initViewports();
        this.update();
    }

    /**************************
        Initialisation methods
    **************************/


    _createClass(Ui, [{
        key: "_initFloor",
        value: function _initFloor() {
            this.clearAllScreen();

            // Variable declarations
            var myBackground = document.getElementById(this.canvasBackgroundId);
            var ctx = myBackground.getContext('2d');
            var img = new Image();

            // acquire image
            img.src = "/" + this.map.floor.src;

            // Load the image in memory
            img.onload = function () {
                // Draw the image
                ctx.drawImage(img, -this.offsetX, -this.offsetY, img.width * this.ratio, img.height * this.ratio);
                this.backgroundImage = img;
                this.overlayUpdate = true;
                this.floorChange = false;
                this.update();
                $("#loading").hide();
            }.bind(this);
        }

        // Set the size of the viewports

    }, {
        key: "_initViewports",
        value: function _initViewports() {
            var myBackground = document.getElementById(this.canvasBackgroundId);
            var myOverlay = document.getElementById(this.canvasOverlayId);
            myBackground.height = $("#viewport").height();
            myBackground.width = $("#viewport").width();
            myOverlay.height = $("#viewport").height();
            myOverlay.width = $("#viewport").width();
        }

        /**************************
            Clear methods
        **************************/

    }, {
        key: "clearAllScreen",
        value: function clearAllScreen() {
            this.clearBackground();
            this.clearOverlay();
        }
    }, {
        key: "clearBackground",
        value: function clearBackground() {
            var myCanvas = document.getElementById(this.canvasBackgroundId);
            var ctx = myCanvas.getContext('2d');
            ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
        }
    }, {
        key: "clearOverlay",
        value: function clearOverlay() {
            var myCanvas = document.getElementById(this.canvasOverlayId);
            var ctx = myCanvas.getContext('2d');
            ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
        }

        /**************************
            Update methods
        **************************/

        // Master update call to all other updaters

    }, {
        key: "update",
        value: function update() {

            // floor needs to be initialized
            if (this.floorChange) {
                this._initFloor();
            }

            // floor needs to be initialized
            if (this.backgroundUpdate) {
                this.updateBackground();
            }

            // floor needs to be updated
            if (this.overlayUpdate) {
                this.updateOverlay();
            }
        }
    }, {
        key: "updateOverlay",
        value: function updateOverlay() {
            this.clearOverlay();
            // TODO: Update overlay here
            this.overlayUpdate = false;
        }
    }, {
        key: "updateBackground",
        value: function updateBackground() {
            this.clearBackground();
            var myCanvas = document.getElementById(this.canvasBackgroundId);
            var ctx = myCanvas.getContext('2d');
            ctx.drawImage(this.backgroundImage, -this.offsetX, -this.offsetY, this.backgroundImage.width * this.ratio, this.backgroundImage.height * this.ratio);
            this.overlayUpdate = true;
        }

        /**************************
            Action Methods
        **************************/

    }, {
        key: "zoomCanvases",
        value: function zoomCanvases(step, x, y) {
            // update ratio and dimentsions
            this.ratio = this.ratio + step;
            this.vpx = x * -1;
            this.vpy = y * -1;
        }
    }, {
        key: "move",
        value: function move(distanceX, distanceY) {
            this.offsetX += distanceX * this.ratio;
            this.offsetY += distanceY * this.ratio;
            this.backgroundUpdate = true;
            this.overlayUpdate = true;
            this.update();
        }

        /**************************
            Id Generation Methods
        **************************/

        /**
         * @description makes a unique id
         * @method _makeId
         * @return {string}
         */

    }, {
        key: "_makeId",
        value: function _makeId() {
            var id = this._guid();
            while (this.getQuestion(id)) {
                id = this._guid();
            }
            return id;
        }

        // Helper for _makeId

    }, {
        key: "_guid",
        value: function _guid() {
            return "UILM-" + this._s4() + this._s4() + '-' + this._s4() + '-' + this._s4() + '-' + this._s4() + '-' + this._s4() + this._s4() + this._s4();
        }

        // Helper for _guid

    }, {
        key: "_s4",
        value: function _s4() {
            return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
        }

        /**************************
            Helper Methods
        **************************/

    }]);

    return Ui;
}();



/***/ })

/******/ });