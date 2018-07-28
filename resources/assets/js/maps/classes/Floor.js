/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Floor extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor(id, src, number) {
        // Super Class constructor call
        super();

        // Identifiers
        this.type = "Floor"; // Json identifier
        this.id = id;
        this.number = number;
        this.src = src;
        this.paint = []
    }

    /**************************
             Public methods
    **************************/
    addPaint(coordinates, isDrag){
      coordinates["color"] = "red";
      coordinates["isDrag"] = isDrag;
      this.paint.push(coordinates);
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Floor as
    default
}
