function init(VIEWPORTS, app){

    /**************************
     Remove Default Html Events
    **************************/
    $("#" + VIEWPORTS.CANVAS_BACKGROUND_ID + ', #' + VIEWPORTS.CANVAS_OVERLAY_ID).on("contextmenu", function(e) {
        return false;
    });

    /**************************
     Resize needs to reasjust the canvas sizes
    **************************/
    $( window ).resize(function() {

      app.ui.floorChange = true;
      app.ui.overlayUpdate = true;
      app.ui.backgroundUpdate = true;

      app.ui._initViewports();
      app.ui.update();
    });

    /**************************
     Zoom eventlistener
    **************************/
    $("#" + VIEWPORTS.VIEWPORT_ID).on('mousewheel', function (ev) {
        ev.preventDefault();
        app.canvasScroll(ev);
        // var step;
        // var incr = 0.1;

        // if (ev.originalEvent.wheelDelta) {
        //   step = (ev.originalEvent.wheelDelta > 0) ? -incr : incr
        // }

        // if (ev.originalEvent.deltaY) {
        //   step = (ev.originalEvent.deltaY > 0) ?  -incr:  incr
        // }

        // app.zoom(step,ev.originalEvent.offsetX,ev.originalEvent.offsetY);
    });

} export {
    init as
    init
}
