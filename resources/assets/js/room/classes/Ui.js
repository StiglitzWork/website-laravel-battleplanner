class Ui {

    /**************************
            Constructor
    **************************/

    constructor(viewportId, canvasBackgroundId, canvasOverlayId, map) {
        // Identifiers
        this.type = "Ui"; // Json identifier

        // Document Ids
        this.canvasBackgroundId = canvasBackgroundId;
        this.canvasOverlayId = canvasOverlayId;
        this.viewportId = viewportId;

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
        this.battleplan = map;

        // updateFlags
        this.floorChange = true;
        this.overlayUpdate = false;
        this.backgroundUpdate = false;

        this._initViewports();
        this.update();
    }

    /**************************
        Initialisation methods
    **************************/
    _initFloor(){
        this.clearAllScreen();

        // Variable declarations
        var myBackground = document.getElementById(this.canvasBackgroundId);
        var ctx = myBackground.getContext('2d');
        var img = new Image;

        // acquire image
        img.src = this.battleplan.battlefloor.src;

        // Fille background color
        ctx.fillStyle = 'black';
        ctx.fillRect(0,0,myBackground.width, myBackground.height);

        // Load the image in memory
        img.onload = function() {
            // Draw the image
            ctx.drawImage(img, -this.offsetX, -this.offsetY ,img.width * this.ratio ,img.height * this.ratio);
            this.backgroundImage = img;
            this.overlayUpdate = true;
            this.floorChange = false;
            this.update();
            $("#loading").hide();
        }.bind(this);

        // Update floor Button
        $(".floorSelector").removeClass("active");
        $("#floorSelector-" + this.battleplan.battlefloor.id).addClass("active");
    }

    // Set the size of the viewports
    _initViewports(){

        // hide them until a map is chosen
        $("#"+this.viewportId).show();
        $("#"+this.canvasBackgroundId).show();
        $("#"+this.canvasOverlayId).show();

        var myBackground = document.getElementById(this.canvasBackgroundId);
        var myOverlay = document.getElementById(this.canvasOverlayId);
        myBackground.height = $("#viewport").height();
        myBackground.width = $("#viewport").width();
        myOverlay.height = $("#viewport").height();
        myOverlay.width = $("#viewport").width();
    }

    /**************************
        Clear methods
    **************************/
    clearAllScreen(){
        this.clearBackground()
        this.clearOverlay()
    }

    clearBackground(){
        var myCanvas = document.getElementById(this.canvasBackgroundId);
        var ctx = myCanvas.getContext('2d');
        ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
    }

    clearOverlay(){
        var myCanvas = document.getElementById(this.canvasOverlayId);
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
            this._initFloor();
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
        var myCanvas = document.getElementById(this.canvasOverlayId);
        var ctx = myCanvas.getContext('2d');

        // Clear all
        this.clearOverlay()

        // var lastDrag = null;

        // Redraw saved
        for (var i = 0; i < this.battleplan.battlefloor.paints_saved.length; i++) {

          ctx.beginPath();
          ctx.moveTo(this.battleplan.battlefloor.paints_saved[i].origin.x * this.ratio - this.offsetX, this.battleplan.battlefloor.paints_saved[i].origin.y * this.ratio - this.offsetY);
          ctx.lineTo(this.battleplan.battlefloor.paints_saved[i].destination.x * this.ratio - this.offsetX + 1, this.battleplan.battlefloor.paints_saved[i].destination.y * this.ratio - this.offsetY + 1);
          ctx.strokeStyle = this.battleplan.battlefloor.paints_saved[i].color;
          ctx.closePath();
          ctx.stroke();
        }

        // Redraw
        for (var i = 0; i < this.battleplan.battlefloor.paints_unsaved.length; i++) {

          ctx.beginPath();
          ctx.moveTo(this.battleplan.battlefloor.paints_unsaved[i].origin.x * this.ratio - this.offsetX, this.battleplan.battlefloor.paints_unsaved[i].origin.y * this.ratio - this.offsetY);
          ctx.lineTo(this.battleplan.battlefloor.paints_unsaved[i].destination.x * this.ratio - this.offsetX + 1, this.battleplan.battlefloor.paints_unsaved[i].destination.y * this.ratio - this.offsetY + 1);
          ctx.strokeStyle = this.battleplan.battlefloor.paints_unsaved[i].color;
          ctx.closePath();
          ctx.stroke();
        }

        // Redraw
        for (var i = 0; i < this.battleplan.battlefloor.paints_transit.length; i++) {

          ctx.beginPath();
          ctx.moveTo(this.battleplan.battlefloor.paints_transit[i].origin.x * this.ratio - this.offsetX, this.battleplan.battlefloor.paints_transit[i].origin.y * this.ratio - this.offsetY);
          ctx.lineTo(this.battleplan.battlefloor.paints_transit[i].destination.x * this.ratio - this.offsetX + 1, this.battleplan.battlefloor.paints_transit[i].destination.y * this.ratio - this.offsetY + 1);
          ctx.strokeStyle = this.battleplan.battlefloor.paints_transit[i].color;
          ctx.closePath();
          ctx.stroke();
        }

        this.overlayUpdate = false;
    }

    updateBackground(){
        this.clearBackground();
        var myCanvas = document.getElementById(this.canvasBackgroundId);
        var ctx = myCanvas.getContext('2d');

        // Fill background color
        ctx.fillStyle = 'black';
        ctx.fillRect(0,0,myCanvas.width, myCanvas.height);

        ctx.drawImage(this.backgroundImage, -this.offsetX, -this.offsetY ,this.backgroundImage.width * this.ratio ,this.backgroundImage.height * this.ratio);
        this.overlayUpdate = true;
    }

    /**************************
        Action Methods
    **************************/
    zoomCanvases(step, x, y){
        // update ratio and dimentsions
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

    /**************************
        Id Generation Methods
    **************************/

    /**
     * @description makes a unique id
     * @method _makeId
     * @return {string}
     */
    _makeId() {
        var id = this._guid();
        while (this.getQuestion(id)) {
            id = this._guid();
        }
        return id;
    }

    // Helper for _makeId
    _guid() {
        return "UILM-" + this._s4() + this._s4() + '-' + this._s4() + '-' + this._s4() + '-' +
            this._s4() + '-' + this._s4() + this._s4() + this._s4();
    }

    // Helper for _guid
    _s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }

    /**************************
        Helper Methods
    **************************/

}
export {
    Ui as
    default
}
