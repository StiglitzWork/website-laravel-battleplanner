/**************************
	Extention class type
**************************/
const Helpers = require('../Helpers.js').default;

class CommandManager extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor() {
        // Super Class constructor call
        super();
        this.stack = [];
    }
    
    execute(command){
        stack.append(command);
        command.run();
        return command;
    }

    
    /**************************
             Public methods
    **************************/

    /**************************
        Helper functions
    **************************/

}
export {
    CommandManager as
    default
}
