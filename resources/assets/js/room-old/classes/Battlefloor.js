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
        this.Line = require('./Line.js').default;

        // Identifiers
        this.type = "Battlefloor"; // Json identifier
        this.id = Battlefloor.id;
        this.number = Battlefloor.floor.floorNum;
        this.src = Battlefloor.floor.src;

        this.lines = []
        this.lines_unpushed = [];
        this.lines_transit = [];


    }

    /**************************
             Public methods
    **************************/
    line(originCoordinates,currentCoordinates, color){
      this.lines_unpushed.push(new this.Line(originCoordinates,currentCoordinates, color, this.id));
    }

    serverLine(originCoordinates,currentCoordinates, color){
      this.lines.push(new this.Line(originCoordinates,currentCoordinates, color, this.id));
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Battlefloor as
    default
}
