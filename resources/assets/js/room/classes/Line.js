/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Line extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor(origin,destination,color, battlefloorId) {
        // Super Class constructor call
        super();

        this.type = "Line"; // Json identifier
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
    Line as
    default
}
