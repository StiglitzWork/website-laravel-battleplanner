/**************************
        Inports
**************************/
var bootstrap  = window.bootstrap;

/**************************
    Class type definition
**************************/
var App = require('./classes/App.js').default;

/**************************
    Constant declarations
**************************/
const CANVAS_BACKGROUND_ID = "background";
const CANVAS_OVERLAY_ID = "overlay";
const VIEWPORT_ID = "viewport";

/**************************
    Variable Declaration
**************************/
var app;
app = new App(MAP_ID,FLOOR_SOURCES, VIEWPORT_ID, CANVAS_BACKGROUND_ID, CANVAS_OVERLAY_ID)
// app.load();

/**************************
 Remove Default Html Events
**************************/
$("#" + CANVAS_BACKGROUND_ID + ', #' + CANVAS_OVERLAY_ID).on("contextmenu", function(e) {
    return false;
});

// Zoom eventlistener
$("#" + VIEWPORT_ID).on('wheel', function (ev) {
    ev.preventDefault();

    var step;
    var incr = 0.1;

    if (ev.originalEvent.wheelDelta) {
      step = (ev.originalEvent.wheelDelta > 0) ? -incr : incr
    }

    if (ev.originalEvent.deltaY) {
      step = (ev.originalEvent.deltaY > 0) ?  -incr:  incr
    }

    app.zoom(step,ev.originalEvent.offsetX,ev.originalEvent.offsetY);
});

/**************************
 Windows Event Assignment
**************************/
if(typeof window.app === "undefined"){
     window.app = {}
}

window.app.engine = app;
