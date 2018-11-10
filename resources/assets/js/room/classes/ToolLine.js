/**************************
	Extention class type
**************************/
const Tool = require('./Tool.js').default;

class ToolLine extends Tool {

    /**************************
            Constructor
    **************************/

    constructor() {
        // Super Class constructor call
        super();
    }

	action(battlefloor, coordinates_start, coordinated_end, color){
		battlefloor.line(coordinates_start, coordinated_end, color);
	}

}
export {
    ToolLine as
    default
}
