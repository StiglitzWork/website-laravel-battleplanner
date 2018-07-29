/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Battlefloor extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor(Battlefloor) {
        // Super Class constructor call
        super();

        // Instantiatable class types
        this.Draw = require('./Draw.js').default;
        // this.active = false;
        // Identifiers
        this.type = "Battlefloor"; // Json identifier
        this.id = Battlefloor.id;
        this.number = Battlefloor.floor.floorNum;
        this.src = Battlefloor.floor.src;
        this.paints_saved = []
        this.paints_unsaved = []
        this.paints_transit = []
        this.delayUpdateTimer = 500;
        // we use this var to keep tract or the list of Draw ids we we can send them to the server to ignore on return
        this.drawIds = [];
        this.updateServer();
        this.loadServerDraw();
    }

    /**************************
             Public methods
    **************************/
    addPaint(originCoordinates,currentCoordinates, color){
      this.paints_unsaved.push(new this.Draw(originCoordinates,currentCoordinates, color));
    }

    checkPaint(db_dump){
      for (var i = 0; i < db_dump.length; i++) {
        db_dump[i];
      }
    }

    updateServer(){
      var self = this;
      // if (this.active) {
        this.paints_transit = this.paints_unsaved;
        this.paints_unsaved = [];

        if(self.paints_transit.length > 0){
          $.ajax({
            method: "POST",
            url: "/battlefloor/update",
            data: {battlefloorId: self.id, "draws":self.paints_transit},
            success: function(result){
              self.paints_transit = [];
              self.saveServerDraw(result);
              setTimeout(self.updateServer.bind(self), self.delayUpdateTimer);
            },
            error: function(result,code){
              console.log(result);
              setTimeout(self.updateServer.bind(self), self.delayUpdateTimer);
            }
          });
        } else{
        setTimeout(self.updateServer.bind(self), self.delayUpdateTimer);
      }
    }

    addServerDrawToLocal(serverDraw){
      var origin={
          "x": serverDraw.originX,
          "y": serverDraw.originY
      }
      var destination = {
          "x": serverDraw.destinationX,
          "y": serverDraw.destinationY
      }
      var aDraw = new this.Draw(origin, destination, serverDraw.color);
      aDraw.id = serverDraw.id;
      this.drawIds.push(serverDraw.id);
      this.paints_saved.push(aDraw);
    }

    saveServerDraw(result){
      for (var i = 0; i < result.length; i++) {
        this.addServerDrawToLocal(result[i]);
      }
    }

    loadServerDraw(result){
      var self = this;
      // if (this.active) {

        $.ajax({
          method: "POST",
          url: "/battlefloor/getDraws",
          data: {battlefloorId: self.id, alreadyHaveIds: self.drawIds},
          success: function(result){
            self.paints_transit = [];
            self.updateDrawList(result);
            setTimeout(self.loadServerDraw.bind(self), self.delayUpdateTimer);
          },
          error: function(result,code){
            console.log(result);
            setTimeout(self.loadServerDraw.bind(self), self.delayUpdateTimer);
          }
        });
      // } else{
      //   setTimeout(self.loadServerDraw.bind(self), self.delayUpdateTimer);
      // }

    }

    updateDrawList(serverDrawList){
      for (var i = 0; i < serverDrawList.length; i++) {
        if (!this.paints_saved.filter(localDraw => this._objectIdEquals(localDraw,serverDrawList[i].id))[0]) {
          this.addServerDrawToLocal(serverDrawList[i]);
        }
      }
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Battlefloor as
    default
}
