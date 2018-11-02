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

    constructor(conn_string, viewportId, canvasBackgroundId , canvasOverlayId) {
        // Instantiatable class types
        this.Battleplan = require('./Battleplan.js').default;
        this.Battlefloor = require('./Battlefloor.js').default;
        this.Ui = require('./Ui.js').default;

        // Identifiers
        this.type = "App"; // Json identifier

        // Varable declarations
        this.color = "#e66465"; //draw color
        this.conn_string = conn_string
        this.viewportId = viewportId
        this.canvasBackgroundId = canvasBackgroundId
        this.canvasOverlayId = canvasOverlayId

        // hide them until a map is chosen
        $("#"+this.viewportId).hide();
        $("#"+this.canvasBackgroundId).hide();
        $("#"+this.canvasOverlayId).hide();

        // Event variables
        this.lastCoordinates = {
            "x": 0,
            "y": 0
        }
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

        this.RoomMapChangeCheck();
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

    RoomMapChangeCheck(){
      this.getRoomsBattleplan(function(result){
        if(result != null){
          if (!this.battleplan || this.battleplan.id != result.battleplan.id) {
            this.load(result.battleplan,result.battlefloors);
          }
        }
        // Check again in 1 second
        setTimeout(this.RoomMapChangeCheck.bind(this), 5000);
      }.bind(this));
    }

    changeColor(newColor){
      this.color = newColor
    }

    newBattlePlan(mapId){
      var self = this;
      $.ajax({
        method: "POST",
        url: "/battleplan/new",
        data: { map: mapId, room : this.conn_string},
        success: function(result){
          self.load(result.battleplan,result.battlefloors);
          self.setRoomsBattleplan(result.battleplan.id);
        },
        error: function(result,code){
          console.log(result);
        }
      });
    }

    deleteBattlePlan(battleplanId){
      var self = this;
      $.ajax({
        method: "POST",
        url: "/room/battleplan/delete",
        data: { "battleplanId": battleplanId},
        success: function(result){
            alert("Successfully deleted!");
        },
        error: function(result,code){
            console.log(result);
        }
      });
    }

    loadBattlePlan(battleplanId){
        // set the battleplan
        var self = this;
        this.setRoomsBattleplan(battleplanId, function(){
            // Reset
            self.getRoomsBattleplan(function(result){
              if(result != null){
                  self.load(result.battleplan,result.battlefloors);
              }
          })
        });
    }

    save(){
      var self = this;
      $.ajax({
        method: "POST",
        url: "/room/battleplan/save",
        data: { conn_string : this.conn_string, name : $("#battleplan_name").val()},
        success: function(result){
          alert("Saved!");
        },
        error: function(result,code){
          console.log(result);
        }
      });
    }

    load(battleplan,battlefloors){
      if (battleplan && battlefloors) {
        $("#battleplan_name").val(battleplan.name);
        this.battleplan = new this.Battleplan(battleplan, battlefloors);
        this.ui = new this.Ui(this.viewportId, this.canvasBackgroundId, this.canvasOverlayId, this.battleplan);
      }
    }

    setRoomsBattleplan(battleplanId, callback = null){
      var self = this;
      $.ajax({
        method: "POST",
        url: "/room/battleplan/set",
        data: { battleplan: battleplanId, conn_string : this.conn_string},
        success: function(result){
          console.log(result);
          if (callback) {
              callback(result)
          }
        },
        error: function(result,code){
          console.log(result);
        }
      });
    }

    getRoomsBattleplan(callback){
      var self = this;
      $.ajax({
        method: "POST",
        url: "/room/battleplan/get",
        data: { conn_string : this.conn_string},
        success: function(result){
          if (callback) {
            callback(result);
          }
        },
        error: function(result,code){
          console.log(result);
        }
      });
    }
    /**************************
          Floor Methods
    **************************/

    changeFloor(amount){
        this.battleplan.changeFloor(amount);
        this.ui.floorChange = true;
        this.ui.update();
    }

    changeFloorById(floorId){
        this.battleplan.changeFloorById(floorId);
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
            this.battleplan.battlefloor.addPaint(coordinates, coordinates , this.color);
            this.lastCoordinates = coordinates;
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
            this.battleplan.battlefloor.addPaint(this.lastCoordinates, coordinates, this.color);
            this.ui.overlayUpdate = true;
            this.ui.update();

        } else {
            // Resize event check
            this.resizeRangeY = false;
            this.resizeRangeX = false;
        }

        if(this.rmb || this.lmb){
            this.lastCoordinates = coordinates;
            this.originPoints =
            {
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
