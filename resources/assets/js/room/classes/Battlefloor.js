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

        this.draws = []
        this.draws_unpushed = [];
        this.draws_transit = [];


    }

    /**************************
             Public methods
    **************************/
    draw(originCoordinates,currentCoordinates, color){
      this.draws_unpushed.push(new this.Draw(originCoordinates,currentCoordinates, color, this.id));
      // if(!this.acquiringDelayedDraws){
      //     this.acquiringDelayedDraws = true;
      //     setTimeout(this.pushServer.bind(this), this.delayUpdateTimer);
      // }
    }

    serverDraw(originCoordinates,currentCoordinates, color){
      this.draws.push(new this.Draw(originCoordinates,currentCoordinates, color, this.id));
    }

    // pushServer(){
    //     this.acquiringDelayedDraws = false;
    //     this.draws_transit = this.draws_unpushed;
    //     this.draws_unpushed = [];
    //     var self = this;
    //
    //       $.ajax({
    //         method: "POST",
    //         url: "/battlefloor/draw",
    //         data: {battlefloorId: self.id, "draws" : self.draws_transit},
    //         success: function(result){
    //           self.draws = self.draws.concat(self.draws_transit);
    //           self.draws_transit = [];
    //         },
    //         error: function(result,code){
    //           console.log(result);
    //         }
    //       });
    // }

    // updateServer(){
    //   var self = this;
    //   // if (this.active) {
    //     this.paints_transit = this.draws;
    //     this.draws = [];
    //
    //     if(self.paints_transit.length > 0){
    //       $.ajax({
    //         method: "POST",
    //         url: "/battlefloor/update",
    //         data: {battlefloorId: self.id, "draws":self.paints_transit},
    //         success: function(result){
    //           self.paints_transit = [];
    //           self.saveServerDraw(result);
    //           setTimeout(self.updateServer.bind(self), self.delayUpdateTimer);
    //         },
    //         error: function(result,code){
    //           console.log(result);
    //           setTimeout(self.updateServer.bind(self), self.delayUpdateTimer);
    //         }
    //       });
    //     } else{
    //     setTimeout(self.updateServer.bind(self), self.delayUpdateTimer);
    //   }
    // }

    // addServerDrawToLocal(serverDraw){
    //   var origin={
    //       "x": serverDraw.originX,
    //       "y": serverDraw.originY
    //   }
    //   var destination = {
    //       "x": serverDraw.destinationX,
    //       "y": serverDraw.destinationY
    //   }
    //   var aDraw = new this.Draw(origin, destination, serverDraw.color);
    //   aDraw.id = serverDraw.id;
    //   this.drawIds.push(serverDraw.id);
    // }
    //
    // saveServerDraw(result){
    //   for (var i = 0; i < result.length; i++) {
    //     this.addServerDrawToLocal(result[i]);
    //   }
    // }

    // loadServerDraw(result){
    //   var self = this;
    //   // if (this.active) {
    //
    //     $.ajax({
    //       method: "POST",
    //       url: "/battlefloor/getDraws",
    //       data: {battlefloorId: self.id, alreadyHaveIds: self.drawIds},
    //       success: function(result){
    //         self.paints_transit = [];
    //         self.updateDrawList(result);
    //         setTimeout(self.loadServerDraw.bind(self), self.delayUpdateTimer);
    //       },
    //       error: function(result,code){
    //         console.log(result);
    //         setTimeout(self.loadServerDraw.bind(self), self.delayUpdateTimer);
    //       }
    //     });
    //   // } else{
    //   //   setTimeout(self.loadServerDraw.bind(self), self.delayUpdateTimer);
    //   // }
    //
    // }

    // updateDrawList(serverDrawList){
    //   for (var i = 0; i < serverDrawList.length; i++) {
    //     if (!this.paints_saved.filter(localDraw => this._objectIdEquals(localDraw,serverDrawList[i].id))[0]) {
    //       this.addServerDrawToLocal(serverDrawList[i]);
    //     }
    //   }
    // }

    /**************************
        Helper functions
    **************************/

}
export {
    Battlefloor as
    default
}
