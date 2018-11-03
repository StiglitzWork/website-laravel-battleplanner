/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Draw extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor(origin,destination,color, battlefloorId) {
        // Super Class constructor call
        super();

        this.type = "Draw"; // Json identifier
        this.id = null;
        this.origin = origin;
        this.destination = destination;
        this.color = color;
        this.battlefloorId = battlefloorId;
    }


    /**************************
        Helper functions
    **************************/

}
export {
    Draw as
    default
}
