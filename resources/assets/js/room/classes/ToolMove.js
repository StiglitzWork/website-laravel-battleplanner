/**************************
	Extention class type
**************************/
const Tool = require('./Tool.js').default;

class ToolMove extends Tool {

    /**************************
            Constructor
    **************************/

    constructor(app) {
        // Super Class constructor call
        super(app);
        this.origin;
    }
    
    actionDown(coordinates){
		this.origin = coordinates;
    }

    actionMove(coordinates){
        // this.app.ui.move(this.origin.x - coordinates.x, this.origin.y - coordinates.y);
        this.app.ui.move(this.origin.x - (coordinates.x / this.app.ui.ratio), this.origin.y - (coordinates.y / this.app.ui.ratio));
        // this.app.ui.move(5,5);
        this.app.ui.backgroundUpdate = true;
        this.origin = coordinates;
    }
    
}
export {
    ToolMove as
    default
}
