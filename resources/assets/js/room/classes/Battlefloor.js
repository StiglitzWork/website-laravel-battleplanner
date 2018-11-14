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
		this.Square = require('./Square.js').default;
		this.Line = require('./Line.js').default;
        this.Draw = require('./Draw.js').default;

		this.lineSize = 10;
        this.draws = []
        this.draws_unpushed = [];
        this.draws_transit = [];

    }

	init(){
		this.initDraws()
	}

	initDraws(){
		for (var i = 0; i < this.draws.length; i++) {
			this.draws[i] = Object.assign(new this.Draw, this.draws[i]);
            this.draws[i].init();
		}
	}

    /**************************
             Public methods
    **************************/
    line(originCoordinates,destinationCoordinates, color){
	  var draw = {
		"battlefloor_id": this.id,
		"destinationX": destinationCoordinates.x,
		"destinationY": destinationCoordinates.y,
		"drawable_type": "Line",
		"originX": originCoordinates.x,
		"originY": originCoordinates.y,
	  };

	  draw.drawable = {
		  "lineSize": this.lineSize,
		  "color": color,
	  }

	  draw = Object.assign(new this.Draw, draw);
      draw.init();
      this.draws_unpushed.push(draw);
    }

	square(originCoordinates,destinationCoordinates, color){
	  var draw = {
		"battlefloor_id": this.id,
		"destinationX": destinationCoordinates.x,
		"destinationY": destinationCoordinates.y,
		"drawable_type": "Line",
		"originX": originCoordinates.x,
		"originY": originCoordinates.y,
	  };

	  draw.drawable = {
		  "lineSize": this.lineSize,
		  "color": color,
	  }

	  draw = Object.assign(new this.Square, draw);
      draw.init();
      this.draws_unpushed.push(draw);
    }

    serverDraw(draw){
      draw = Object.assign(new this.Draw, draw);
      draw.init();
      this.draws.push(draw);
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Battlefloor as
    default
}
