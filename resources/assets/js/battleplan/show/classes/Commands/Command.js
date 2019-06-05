/**************************
	Extention class type
**************************/
const Helpers = require('../Helpers.js').default;

class Command extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor() {
        // Super Class constructor call
        super();
        this.data;
    }

	init(data){
        this.data = data
    }
    
    /**************************
             Public methods
    **************************/

    run(){
        throw "Unimplemented!";
    }

    undo(){
        throw "Unimplemented!";
    }

    /**************************
        Helper functions
    **************************/

}
export {
    CommandManager as
    default
}
