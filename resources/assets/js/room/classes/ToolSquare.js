/**************************
	Extention class type
**************************/
const Tool = require('./Tool.js').default;

class ToolSquare extends Tool {

    /**************************
            Constructor
    **************************/

    constructor() {
        // Super Class constructor call
        super();
    }

	action(battlefloor, coordinates_start, coordinated_end, color){
		battlefloor.square(coordinates_start, coordinated_end, color);
	}

}
export {
    ToolSquare as
    default
}
