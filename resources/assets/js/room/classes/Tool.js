/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Tool extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor() {
        // Super Class constructor call
        super();
    }

	action(){
		// Must override in children classes
		console.error("This should have been overloaded");
	}

    /**************************
        Helper functions
    **************************/

}
export {
    Tool as
    default
}
