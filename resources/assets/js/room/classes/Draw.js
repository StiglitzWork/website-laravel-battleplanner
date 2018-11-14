/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Draw extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor() {
        // Super Class constructor call
        super();
		this.Line = require('./Line.js').default;
		this.Square = require('./Square.js').default;
    }

    init(){
        var type = this.getType(this);
        // this.draws.push(new this[type](originCoordinates,destinationCoordinates, draw.morph.color, this.id));

        this.drawable = Object.assign(new this[type], this.drawable);
        this.drawable.init();
    }

    draw(ctx,ui){
        this.drawable.draw(this,ctx,ui);//.bind(this.drawable);
    }

    /**************************
        Helper functions
    **************************/
    getType(draw){
        var exploded = draw.drawable_type.split("\\");
        return exploded[exploded.length -1];
    }
}
export {
    Draw as
    default
}
