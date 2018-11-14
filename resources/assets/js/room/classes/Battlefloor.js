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
        this.Draw = require('./Draw.js').default;
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
	
	addDraw(draw){
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
