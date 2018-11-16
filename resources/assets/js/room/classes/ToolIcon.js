/**************************
	Extention class type
**************************/
const Tool = require('./Tool.js').default;

class ToolIcon extends Tool {

    /**************************
            Constructor
    **************************/

    constructor(app) {
        // Super Class constructor call
        super(app);
        this.Draw = require('./Draw.js').default;
        this.height = 40;
        this.width = 40;
    }

    actionDrop(coordinates,src) {
        if(src){
            this.app.battleplan.battlefloor.addDraw(this.icon(coordinates,src));
            this.app.ui.overlayUpdate = true;
            this.app.logPush();
        }
    }

    icon(coordinates, src) {
        var start = JSON.parse(JSON.stringify(coordinates));
        var end = JSON.parse(JSON.stringify(coordinates));
        start.x = coordinates.x - (this.width/2);
        start.y = coordinates.y - (this.height/2);

        end.x = coordinates.x + (this.width/2);
        end.y = coordinates.y + (this.height/2);


        var draw = {
            "battlefloor_id": this.app.battleplan.battlefloor.id,
            "destinationX": end.x,
            "destinationY": end.y,
            "drawable_type": "Icon",
            "originX": start.x,
            "originY": start.y,
        };

        draw.drawable = {
            "src": src,
        }

        draw = Object.assign(new this.Draw, draw);
        draw.init();
        return draw;
    }
    
}
export {
    ToolIcon as
    default
}
