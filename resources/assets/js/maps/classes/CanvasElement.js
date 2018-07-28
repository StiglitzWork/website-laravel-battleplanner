/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class CanvasElement extends Helpers {

    /**************************
           Constructor
    **************************/

    constructor(id, x, y, height, width, strokeColor = "#007bff", fillColor = "rgba(191, 191, 63, 0.51)", fill = false, stroke = true) {
        // Error handling
        if (!id || typeof x == "undefined" || x == null ||
            typeof y == "undefined" || y == null ||
            typeof height == "undefined" || height == null ||
            typeof width == "undefined" || width == null) {
            throw new Error("Missing vital option class information");
        }

        // Super Class constructor call
        super();

        // Identifiers
        this.type = "CanvasElement"; // Json identifier
        this.id = id;

        // coordinates
        this.coordinates = {
            "x": x,
            "y": y
        };

        this.origins = {
            "x": x,
            "y": y
        };

        // Variables
        this.strokeColor = strokeColor;
        this.fillColor = fillColor;
        this.stroke = stroke;
        this.fill = fill;
        this._height = height; // Private because we have getter/setter
        this._width = width; // Private because we have getter/setter

        // Flags
        this.deleted = false;
    }

    /**************************
            Setters
    **************************/

    set height(value){
        // Adjust the y coordinate incase negative values
        if (value < 0) {
            this.coordinates["y"] = this.origins["y"] + value;
        } else {
            this.coordinates["y"] = this.origins["y"];
        }
        this._height = Math.abs(value);
    }

    set width(value){
        // Adjust the X coordinate incase negative values
        if (value < 0) {
            this.coordinates["x"] = this.origins["x"] + value;
        } else {
            this.coordinates["x"] = this.origins["x"];
        }
        this._width = Math.abs(value);
    }

    /**************************
            Getters
    **************************/

    get height(){
        return this._height;
    }

    get width(){
        return this._width;
    }

    /**************************
        Displacement Methods
    **************************/

    /**
     * @description move along the x and y axis the distance of the parameters
     * @method moveX
     * @param  {int} X distance distance moved (accepts positive or negative)
     * @param  {int} Y distance distance moved (accepts positive or negative)
     * @return {undefined}
     */
    move(distanceX, distanceY) {
        this.moveX(distanceX);
        this.moveY(distanceY);
    }

    moveX(distance) {
        this.origins["x"] = this.coordinates["x"] = this.coordinates["x"] + distance;
    }

    moveY(distance) {
        this.origins["y"] = this.coordinates["y"] = this.coordinates["y"] + distance;
    }

    /**************************
        Resize Methods
    **************************/

    resizeWidth(distance) {
        this.width += distance;
    }

    resizeHeight(distance) {// Adjust the X coordinate
        this.height += distance;
    }

    /**************************
        Coordinate Methods
    **************************/

    /**
     * @description checks if the x and y markers are inside the element
     * @method inside
     * @param  {int} X coordinate to check
     * @param  {int} Y coordinate to check
     * @return {bool} wether the coordinate was withing the element or not
     */
    inside(x, y) {
        if (this.insideX(x) && this.insideY(y)) {
            return true;
        }
        return false;
    }

    insideX(x) {
        if (this.coordinates["x"] <= x && (this.coordinates["x"] + this.width) >= x) {
            return true;
        }
        return false;
    }

    insideY(y) {
        if (this.coordinates["y"] <= y && (this.coordinates["y"] + this.height) >= y) {
            return true;
        }
        return false;
    }

    /**************************
          Display Methods
    **************************/

    /**
     * @description draws the element on the canvas
     * @method inside
     * @param {string} [optional] fill or stroke options. Unprovided will stroke.
     * @return {undefined}
     */
    draw(canvasId, ratio = 1, offsetx=0, offsety=0) {
        if (!this.deleted) {
            var myCanvas = document.getElementById(canvasId);
            var ctx = myCanvas.getContext("2d");
            ctx.beginPath();
            ctx.lineWidth = "2";

            if(this.stroke){
                ctx.strokeStyle = this.strokeColor
                ctx.rect((this.coordinates["x"] * ratio) - offsetx, (this.coordinates["y"] * ratio) - offsety, this.width * ratio, this.height * ratio);
                ctx.strokeStyle = this.color
                ctx.stroke();
            }

            if(this.fill){
                ctx.fillStyle = this.fillColor
                ctx.fillRect((this.coordinates["x"] * ratio) - offsetx, (this.coordinates["y"] * ratio) - offsety, this.width * ratio, this.height * ratio);
            }
        }
    }

    remove() {
        this.deleted = true;
    }
}
export {
    CanvasElement as
    default
}
