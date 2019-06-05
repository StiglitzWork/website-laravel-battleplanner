/**************************
	Extention class type
**************************/
const Helpers = require('./Command.js').default;

class DrawCommand extends Command {

    /**************************
            Constructor
    **************************/

    constructor() {
        // Super Class constructor call
        super();
    }

	init(data){
        this.x = "";
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
