/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Map extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor(dbId, floorSources) {
        // Super Class constructor call
        super();

        // Instantiatable class types
        this.Floor = require('./Floor.js').default;

        // Identifiers
        this.dbId = dbId;
        this.type = "Map"; // Json identifier

        // Variables
        this.floor = null;
        this.floors = [];

        this.initialization(floorSources)
    }

    /**************************
        Floor Methods
    **************************/

    getFloor(id){
        return this.floors.filter(floor => this._objectIdEquals(floor,id))[0];
    }

    getFloorDbId(dbId){
        return this.floors.filter(floor => this._objectDbIdEquals(floor,dbId))[0];
    }

    //Positive or negative values accepted
    changeFloor(amount){
      if(amount == 0){
        throw new Error("Cannot change floor by 0.");
        return;
      }

      // positive
      if (amount > 0) {
        for (var i = 0; i != amount; i++) {
          if (this.hasNextFloor()) {
            this.nextFloor();
          } else{
            return;
          }
        }
      //Negative
      } else{
        for (var i = 0; i != amount; i--) {
          if (this.hasPreviousFloor()) {
            this.previousFloor();
          } else{
            return;
          }
        }
      }
      // Error checking
      if (!this.floor){
        throw new Error("Something when wrong when changing floors");
      }
    }

    nextFloor(){
      if (this.hasNextFloor()) {
        this.floor = this.floors[this.floor.number + 1];
      }
    }

    previousFloor(){
      if (this.hasPreviousFloor()) {
        this.floor = this.floors[this.floor.number - 1];
      }
    }

    hasNextFloor(){
      if(this.floor.number < this.floors.length -1 ){
        return true;
      }
      return false;
    }

    hasPreviousFloor(){
        if(this.floor.number - 1 >= 0){
          return true;
        }
        return false;
    }

    setFloor(id){
      var floor = this.getFloor(id)
      if (floor) {
        this.floor = floor;
      }
    }

    /**************************
        Display Methods
    **************************/

    /**
     * @description innitialisation of the DOM. Sets the size of background and overlay and paints the background. Also creates all the questions from sidebar
     * @method _initialization
     * @return {undefined}
     */
    initialization(floorSources) {
        // Innitialize the floors
        this.loadFloors(floorSources);
    }

    loadFloors(floorSources){
        for (var i = 0; i < floorSources.length; i++) {
          this.floors.push(
            new this.Floor(
              floorSources[i].id,
              floorSources[i].src,
              floorSources[i].number
            )
          );
        }

        // init the current floor
        this.floor = this.floors[0];
    }


    /**
     * @description updates the active subclasses
     * @method _update
     * @return {undefined}
     */
    _update() {
      this.floor.update();
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Map as
    default
}
