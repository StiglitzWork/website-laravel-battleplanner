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
    Setup Ajax CSRF
**************************/
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**************************
    Variable Declaration
**************************/
var app;
app = new App(ROOM_CONN_STRING, VIEWPORT_ID, CANVAS_BACKGROUND_ID, CANVAS_OVERLAY_ID, LISTEN_SOCKET, USER_ID, IS_OWNER)

/**************************
 Remove Default Html Events
**************************/
$("#" + CANVAS_BACKGROUND_ID + ', #' + CANVAS_OVERLAY_ID).on("contextmenu", function(e) {
    return false;
});

// Resize needs to reasjust the canvas sizes
$( window ).resize(function() {

  app.ui.floorChange = true;
  app.ui.overlayUpdate = true;
  app.ui.backgroundUpdate = true;

  app.ui._initViewports();
  app.ui.update();
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

//listen for battleplan Change event
LISTEN_SOCKET.on(`BattleplanChange.${ROOM_CONN_STRING}:App\\Events\\Room\\BattleplanChange`, function(message){
    app.getRoomsBattleplan(app.load.bind(app));
});

//listen for someone elses draws
LISTEN_SOCKET.on(`BattlefloorDraw.${ROOM_CONN_STRING}:App\\Events\\Battlefloor\\CreateDraws`, function(message){
    app.serverDraw(message);
});

//listen for someone elses draws
LISTEN_SOCKET.on(`ChangeOperatorSlot.${ROOM_CONN_STRING}:App\\Events\\Battleplan\\ChangeOperatorSlot`, function(message){
    app.changeOperatorSlotDom(message.operatorSlot.id,message.operator);
});


/**************************
 Windows Event Assignment
**************************/
if(typeof window.app === "undefined"){
     window.app = {}
}

window.app.engine = app;
