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
		this.Icon = require('./Icon.js').default;
    }

    init(){
        var type = this.getType(this);
        // this.draws.push(new this[type](originCoordinates,destinationCoordinates, draw.morph.color, this.id));

        this.checkSides()

        this.drawable = Object.assign(new this[type], this.drawable);
        this.drawable.init();
    }

    draw(ctx,ui){
        this.checkSides()
        this.drawable.draw(this,ctx,ui);//.bind(this.drawable);
    }

    /**************************
        Helper functions
    **************************/
    getType(draw){
        var exploded = draw.drawable_type.split("\\");
        return exploded[exploded.length -1];
    }

    checkSides(){
        var tmp;

        if(parseInt(this.originX) > parseInt(this.destinationX)){
            tmp = this.originX;
            this.originX = this.destinationX
            this.destinationX = tmp;
        }

        if(parseInt(this.originY) > parseInt(this.destinationY)){
            tmp = this.originY;
            this.originY = this.destinationY
            this.destinationY = tmp;
        }

    }
}
export {
    Draw as
    default
}
