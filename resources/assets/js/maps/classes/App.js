/**
 * Main appication class, includes all ui functionality and application flow of the various parts
 *
 * @version 0.1
 * @author Erik Smith
 */
class App {

    /**************************
            Constructor
    **************************/

    constructor(Map_dbId, floorSources, viewportId, canvasBackgroundId , canvasOverlayId) {
        // Instantiatable class types
        this.Map = require('./Map.js').default;
        this.Floor = require('./Floor.js').default;
        this.Ui = require('./Ui.js').default;

        // Identifiers
        this.type = "App"; // Json identifier

        // Varable declarations
        this.color = "#e66465"; //draw color
        this.map = new this.Map(Map_dbId, floorSources);
        this.ui = new this.Ui(viewportId, canvasBackgroundId, canvasOverlayId, this.map);

        // Event variables
        this.originPoints = {
            "x": 0,
            "y": 0
        }

        // Eventing variables
        this.lmb = false;
        this.rmb = false;

        this.resizeRangeX = false;
        this.resizeRangeY = false;
        this.placeholderResizing = null;

    }

    /**************************
            App Methods
    **************************/

    zoom(amount,x,y){
        var coordinates = this._calculateOffset(x,y);
        this.ui.zoomCanvases(amount, x, y);
        this.ui.backgroundUpdate = true;
        this.ui.overlayUpdate = true;
        this.ui.update();
    }

    changeColor(newColor){
      this.color = newColor
    }
    /**************************
          Floor Methods
    **************************/

    changeFloor(amount){
        this.map.changeFloor(amount);
        this.ui.floorChange = true;
        this.ui.update();
    }

    changeFloorById(floorId){
        this.map.changeFloorById(floorId);
        this.ui.floorChange = true;
        this.ui.update();
    }


    /**************************
        Canvas Methods
    **************************/

    canvasUp(ev) {
        var coordinates = this._calculateOffset(ev.offsetX,ev.offsetY);
        this._clickDeactivateEventListen(ev);

        if(!this.lmb){
            this.ui.overlayUpdate = true;
            this.ui.update();
        }

    }

    canvasDown(ev) {
        // var eventX = (ev.offsetX)/ this.ui.ratio;
        // var eventY = (ev.offsetY) / this.ui.ratio;
        var coordinates = this._calculateOffset(ev.offsetX,ev.offsetY);
        this._clickActivateEventListen(ev)
        if (this.lmb) {
            this.map.floor.addPaint(coordinates, false , this.color);

            // Update UI
            this.ui.overlayUpdate = true;
            this.ui.update();
        }
    }

    canvasMove(ev) {
        var coordinates = this._calculateOffset(ev.offsetX,ev.offsetY);

        if (this.rmb) {
            this.ui.move(this.originPoints["x"] - (ev.offsetX / this.ui.ratio), this.originPoints["y"] - (ev.offsetY/ this.ui.ratio));
            this.ui.backgroundUpdate = true;
        }

        if (this.lmb) {
            this.map.floor.addPaint(coordinates, true, this.color);
            this.ui.overlayUpdate = true;
            this.ui.update();

        } else {
            // Resize event check
            this.resizeRangeY = false;
            this.resizeRangeX = false;
        }

        if(this.rmb || this.lmb){
            this.originPoints = {
                "x": (ev.offsetX / this.ui.ratio),
                "y": (ev.offsetY / this.ui.ratio)
            } //2 dimentional
        }

    }

    canvasEnter(ev) {
        var coordinates = this._calculateOffset(ev.offsetX,ev.offsetY);
        this._deactivateClickEventListen();

        // Update UI
        this.ui.overlayUpdate = true;
        this.ui.update();
    }

    canvasLeave(ev) {
        var coordinates = this._calculateOffset(ev.offsetX,ev.offsetY);
        this._deactivateClickEventListen();

        if (this.lmb) {
            this.map.floor.addPaint(coordinates, true, this.color);

            // Update UI
            this.ui.overlayUpdate = true;
            this.ui.update();
        }
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
    _clickActivateEventListen(ev) {
        var coordinates = this._calculateOffset(ev.offsetX,ev.offsetY);

        this.originPoints = {
            "x": ev.offsetX / this.ui.ratio,
            "y": ev.offsetY / this.ui.ratio
        } //2 dimentional
        if (ev.button == 0) this.lmb = true;
        if (ev.button == 2) this.rmb = true;
    }

    /**
     * @description unsets event provided it was pressed/released
     * @method _clickDeactivateEventListen
     * @param  {event} event that trigger this method
     * @return {undefined}
     */
    _clickDeactivateEventListen(ev) {
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
    _deactivateClickEventListen() {
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
    _contains(haystack, arr) {
        return arr.some(function(v) {
            return haystack.indexOf(v) >= 0;
        });
    };

    _calculateOffset(evx,evy){
        var jsonResponse = {}
        jsonResponse.x = (evx / this.ui.ratio) + (this.ui.offsetX / this.ui.ratio);
        jsonResponse.y = (evy / this.ui.ratio) + (this.ui.offsetY / this.ui.ratio);
        return jsonResponse;
    }

}
export {
    App as
    default
}
