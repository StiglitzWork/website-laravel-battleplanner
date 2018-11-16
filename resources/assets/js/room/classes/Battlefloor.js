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
        this.draws_deleted = [];
        this.draws_transit = [];
        this.transit_deleted = [];
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
    
    addDelete(draw){
        // Draw on server
        var index = this.draws.indexOf(draw);
        if(index > 0){
            this.draws.splice(index, 1);
            this.draws_deleted.push(draw);
        } else{
            index = this.draws_unpushed.indexOf(draw);
            if(index > 0){
                this.draws_unpushed.splice(index, 1);
            }
        }

        // var index = this.unpushed_draws.indexOf(draw);
        // if(index > 0){
        //     this.transit_.splice(index, 1);
        // }
	}

    // removeLocalDraw(draw){
    //     var index = this.draws.indexOf(draw);
    //     if(index > 0){
    //         this.draws.splice(index, 1);
    //     }

    //     index = this.unpushed_draws.indexOf(draw);
    // }

    serverDraw(draw){
      draw = Object.assign(new this.Draw, draw);
      draw.init();
      this.draws.push(draw);

    //   var foundDeleted = false;
    //   for (let index = 0; index < this.transit_deleted.length; index++) {
    //       const element = this.transit_deleted[index];
    //       var foundAt = this.draws.indexOf(draw);
    //       if(foundAt > 0){
    //         addDelete(draw)
    //       }
    //   }
    }

    serverDelete(draw){
        var index = this.draws.indexOf(draw);
        this.draws.splice(index, 1);
        return index;
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Battlefloor as
    default
}
