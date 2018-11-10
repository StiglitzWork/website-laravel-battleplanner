class Ui {

    /**************************
            Constructor
    **************************/

    constructor(viewports, battleplan) {

        // Document Ids
        this.viewports = viewports;

        // Public variables
        this.backgroundImage = null;

        // Zoom variables
        this.ratio = 1;
        this.height = 0;
        this.width = 0;
        this.offsetX = 0;
        this.offsetY = 0;
        this.vpx = 0;
        this.vpy = 0;
        this.vpw = $("#" + this.viewportId).innerWidth;
        this.vph = $("#" + this.viewportId).innerHeight;

        // Subscribed objects
        this.battleplan = battleplan;

        // updateFlags
        this.floorChange = true;
        this.overlayUpdate = false;
        this.backgroundUpdate = false;

		this.init();
    }

    /**************************
        Initialisation methods
    **************************/
	init(){
		this.initViewports();
		this.initBackground();
        this.update();
	}

	showViewports(){
		for (var property in this.viewports) {
	        $("#"+this.viewports[property]).show();
		}
	}

    // Set the size of the viewports
    initViewports(){

		// show the viewport now that we have a battleplan
        this.showViewports()

		// Acquire DOMS
        var background = document.getElementById(this.viewports.CANVAS_BACKGROUND_ID);
		var overlay = document.getElementById(this.viewports.CANVAS_OVERLAY_ID);
        var viewport = document.getElementById(this.viewports.VIEWPORT_ID);

		// Set Heights
        background.height = $(viewport).height();
        background.width = $(viewport).width();
        overlay.height = $(viewport).height();
        overlay.width = $(viewport).width();
    }

	initBackground(){
		// Fresh slate
		this.clearAllScreen();

        // Variable declarations
        var background = document.getElementById(this.viewports.CANVAS_BACKGROUND_ID);
        var ctx = background.getContext('2d');
        var img = new Image;

        // acquire image
        img.src = this.battleplan.battlefloor.floor.src;

        // Fill background color
        ctx.fillStyle = 'black';
        ctx.fillRect(0,0,background.width, background.height);

        // Load the image in memory
        img.onload = function() {
            // Draw the image
            ctx.drawImage(img, -this.offsetX, -this.offsetY ,img.width * this.ratio ,img.height * this.ratio);
            this.backgroundImage = img;
            this.overlayUpdate = true;
            this.floorChange = false;
            this.update();
        }.bind(this);
	}

    /**************************
        Clear methods
    **************************/
    clearAllScreen(){
        this.clearBackground()
        this.clearOverlay()
    }

    clearBackground(){
        var myCanvas = document.getElementById(this.viewports.CANVAS_BACKGROUND_ID);
        var ctx = myCanvas.getContext('2d');
        ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
    }

    clearOverlay(){
        var myCanvas = document.getElementById(this.viewports.CANVAS_OVERLAY_ID);
        var ctx = myCanvas.getContext('2d');
        ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
    }

    /**************************
        Update methods
    **************************/

    // Master update call to all other updaters
    update() {

        // floor needs to be initialized
        if(this.floorChange){
            this.initBackground();
        }

        // floor needs to be initialized
        if(this.backgroundUpdate){
            this.updateBackground();
        }

        // floor needs to be updated
        if(this.overlayUpdate){
            this.updateOverlay();
        }
    }

    updateOverlay(){

		// variable declaration
        var myCanvas = document.getElementById(this.viewports.CANVAS_OVERLAY_ID);
        var ctx = myCanvas.getContext('2d');

        // Clear all
        this.clearOverlay()

        // // Redraw saved
        // for (var i = 0; i < this.battleplan.battlefloor.lines.length; i++) {
		//
        //   ctx.beginPath();
        //   ctx.moveTo(this.battleplan.battlefloor.lines[i].origin.x * this.ratio - this.offsetX, this.battleplan.battlefloor.lines[i].origin.y * this.ratio - this.offsetY);
        //   ctx.lineTo(this.battleplan.battlefloor.lines[i].destination.x * this.ratio - this.offsetX + 1, this.battleplan.battlefloor.lines[i].destination.y * this.ratio - this.offsetY + 1);
        //   ctx.strokeStyle = this.battleplan.battlefloor.lines[i].color;
        //   ctx.closePath();
        //   ctx.stroke();
        // }
		//
        // // Redraw unpushed ones
        // for (var i = 0; i < this.battleplan.battlefloor.lines_unpushed.length; i++) {
		//
        //   ctx.beginPath();
        //   ctx.moveTo(this.battleplan.battlefloor.lines_unpushed[i].origin.x * this.ratio - this.offsetX, this.battleplan.battlefloor.lines_unpushed[i].origin.y * this.ratio - this.offsetY);
        //   ctx.lineTo(this.battleplan.battlefloor.lines_unpushed[i].destination.x * this.ratio - this.offsetX + 1, this.battleplan.battlefloor.lines_unpushed[i].destination.y * this.ratio - this.offsetY + 1);
        //   ctx.strokeStyle = this.battleplan.battlefloor.lines_unpushed[i].color;
        //   ctx.closePath();
        //   ctx.stroke();
        // }
		//
        // // Redraw transit ones
        // for (var i = 0; i < this.battleplan.battlefloor.lines_transit.length; i++) {
		//
        //   ctx.beginPath();
        //   ctx.moveTo(this.battleplan.battlefloor.lines_transit[i].origin.x * this.ratio - this.offsetX, this.battleplan.battlefloor.lines_transit[i].origin.y * this.ratio - this.offsetY);
        //   ctx.lineTo(this.battleplan.battlefloor.lines_transit[i].destination.x * this.ratio - this.offsetX + 1, this.battleplan.battlefloor.lines_transit[i].destination.y * this.ratio - this.offsetY + 1);
        //   ctx.strokeStyle = this.battleplan.battlefloor.lines_transit[i].color;
        //   ctx.closePath();
        //   ctx.stroke();
        // }

        this.overlayUpdate = false;
    }

    updateBackground(){
        this.clearBackground();
        var canvas = document.getElementById(this.viewports.CANVAS_BACKGROUND_ID);
        var ctx = canvas.getContext('2d');

        // Fill background color
        ctx.fillStyle = 'black';
        ctx.fillRect(0,0, canvas.width, canvas.height);

        ctx.drawImage(this.backgroundImage, -this.offsetX, -this.offsetY ,this.backgroundImage.width * this.ratio ,this.backgroundImage.height * this.ratio);
        this.overlayUpdate = true;
    }

    /**************************
        Action Methods
    **************************/

    zoomCanvases(step, x, y){
        // update ratio and dimentions
        this.ratio = this.ratio + step
        this.vpx = x * -1
        this.vpy = y * -1
    }

    move(distanceX, distanceY){
        this.offsetX += distanceX * this.ratio;
        this.offsetY += distanceY * this.ratio;
        this.backgroundUpdate = true;
        this.overlayUpdate = true;
        this.update();
    }
}
export {
    Ui as
    default
}
