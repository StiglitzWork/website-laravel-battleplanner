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
    }

    serverDraw(originCoordinates,currentCoordinates, color){
      this.draws.push(new this.Draw(originCoordinates,currentCoordinates, color, this.id));
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Battlefloor as
    default
}
