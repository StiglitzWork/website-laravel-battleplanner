/**************************
	Extention class type
**************************/
const Draw = require('./Draw.js').default;

class Square extends Draw {

    /**************************
            Constructor
    **************************/

    constructor(origin,destination,color, battlefloorId) {
        super();
    }

    init(){

    }

    draw(draw,ctx,ui){
		ctx.fillStyle= draw.drawable.color;
		ctx.globalAlpha = 0.2;

		oX = draw.originX * ui.ratio - ui.offsetX;
		oY = draw.originY * ui.ratio - ui.offsetY;
		dX = draw.destinationX * ui.ratio - ui.offsetX;
		dY = draw.destinationY * ui.ratio - ui.offsetY;

		ctx.fillRect(
			oX,
			oY,
			oX - dX,
			oY - dY
		);

		ctx.globalAlpha = 1.0;

    }
    /**************************
        Helper functions
    **************************/

}
export {
    Square as
    default
}
