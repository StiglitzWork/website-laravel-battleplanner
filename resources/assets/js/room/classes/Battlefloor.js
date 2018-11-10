/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Battlefloor extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor() {
        // Super Class constructor call
        super();

        // Instantiatable class types
		this.Line = require('./Line.js').default;
        this.Draw = require('./Draw.js').default;

        // Identifiers
        // this.type = "Battlefloor"; // Json identifier
        // this.id = Battlefloor.id;
        // this.number = Battlefloor.floor.floorNum;
        // this.src = Battlefloor.floor.src;
		//

        this.draws = []
        this.draws_unpushed = [];
        this.draws_transit = [];

		// this.init();
    }

	init(){
		this.initDraws()
	}

	initDraws(){
		for (var i = 0; i < this.draws.length; i++) {
			this.draws[i] = Object.assign(new this.Draw, this.draws[i]);
		}
	}

    /**************************
             Public methods
    **************************/
    line(originCoordinates,destinationCoordinates, color){
      this.draws_unpushed.push(new this.Line(originCoordinates,destinationCoordinates, color, this.id));
    }

    serverDraw(originCoordinates,destinationCoordinates, color){
      this.draws.push(new this.Line(originCoordinates,destinationCoordinates, color, this.id));
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Battlefloor as
    default
}
