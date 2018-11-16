/**************************
	Extention class type
**************************/
const Tool = require('./Tool.js').default;

class ToolZoom extends Tool {

    /**************************
            Constructor
    **************************/

    constructor(app) {
        // Super Class constructor call
        super(app);
        this.origin;
        this.step = .1;
    }

    actionScroll(direction, coordinates) {
        this.app.ui.zoomCanvases(this.step * direction, coordinates.x, coordinates.y);
        // var width = this.app.ui.imgWidth;
        // var height = this.app.ui.imgHeight;


        // var Nwidth = this.app.ui.imgWidth * this.app.ui.ratio;
        // var Nheight = this.app.ui.imgHeight * this.app.ui.ratio;


        // var x = Nwidth - width;
        // var y = Nheight - height;

        // this.app.ui.offsetX = this.app.ui.offsetX * this.app.ui.ratio
        // this.app.ui.offsetY = this.app.ui.offsetY * this.app.ui.ratio

        this.app.ui.backgroundUpdate = true;
        this.app.ui.overlayUpdate = true;
    }

}
export {
    ToolZoom as
        default
}
