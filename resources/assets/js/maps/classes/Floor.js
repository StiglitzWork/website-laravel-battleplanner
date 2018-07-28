/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Floor extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor(id, src) {
        // Super Class constructor call
        super();

        // Identifiers
        this.type = "Floor"; // Json identifier
        this.id = id;
        this.src = src;
    }

    /**************************
             Getters
    **************************/


    /**************************
        Helper functions
    **************************/

}
export {
    Floor as
    default
}
