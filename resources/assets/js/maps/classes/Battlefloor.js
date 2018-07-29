/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Battlefloor extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor(id, src, number) {
        // Super Class constructor call
        super();

        // Identifiers
        this.type = "Battlefloor"; // Json identifier
        this.id = id;
        this.number = number;
        this.src = src;
        this.paint = []
    }

    /**************************
             Public methods
    **************************/
    addPaint(coordinates, isDrag, color){
      coordinates["color"] = color;
      coordinates["isDrag"] = isDrag;
      this.paint.push(coordinates);
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Battlefloor as
    default
}
