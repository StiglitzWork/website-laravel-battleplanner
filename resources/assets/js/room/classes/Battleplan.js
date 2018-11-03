/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Battleplan extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor(battleplan) {
        // Super Class constructor call
        super();

        // Instantiatable class types
        this.Battlefloor = require('./Battlefloor.js').default;

        // Identifiers
        this.id = battleplan.id;
        this.type = "Battleplan"; // Json identifier

        // Variables
        this.battlefloor = null;
        this.battlefloors = [];

        this.initialization(battleplan.battlefloors)
    }

    /**************************
        Floor Methods
    **************************/

    getFloor(id){
        return this.battlefloors.filter(floor => this._objectIdEquals(floor,id))[0];
    }

    getFloorDbId(dbId){
        return this.battlefloors.filter(floor => this._objectDbIdEquals(floor,dbId))[0];
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
      if (!this.battlefloor){
        throw new Error("Something when wrong when changing floors");
      }
    }

    changeFloorById(floorId){
        // if (this.battlefloor) {
        //   this.battlefloor.active=false;
        // }
       this.battlefloor = this.getFloor(floorId);
       // this.battlefloor.active=true;
    }

    nextFloor(){
      if (this.hasNextFloor()) {
        // if (this.battlefloor) {
        //   this.battlefloor.active=false;
        // }
        this.battlefloor = this.battlefloors[this.battlefloor.number + 1];
        // this.battlefloor.active=true;
      }
    }

    previousFloor(){
      if (this.hasPreviousFloor()) {

        // if (this.battlefloor) {
        //   this.battlefloor.active=false;
        // }
        this.battlefloor = this.battlefloors[this.battlefloor.number - 1];
        // this.battlefloor.active=true;
      }
    }

    hasNextFloor(){
      if(this.battlefloor.number < this.battlefloors.length -1 ){
        return true;
      }
      return false;
    }

    hasPreviousFloor(){
        if(this.battlefloor.number - 1 >= 0){
          return true;
        }
        return false;
    }

    setFloor(id){
      var floor = this.getFloor(id)
      if (floor) {

        // if (this.battlefloor) {
        //   this.battlefloor.active=false;
        // }
        this.battlefloor = floor;
        // this.battlefloor.active=true;
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
          var battlefloor = new this.Battlefloor(floorSources[i])
          this.battlefloors.push(battlefloor);

          for (var j = 0; j < floorSources[i].draws.length; j++) {


              battlefloor.serverDraw({
                  "x":floorSources[i].draws[j]["originX"],
                  "y":floorSources[i].draws[j]["originY"],
              },
              {
                  "x":floorSources[i].draws[j]["destinationX"],
                  "y":floorSources[i].draws[j]["destinationY"],
              },
              floorSources[i].draws[j].color);
          }

        }

        // init the current floor
        this.battlefloor = this.battlefloors[0];
    }


    /**
     * @description updates the active subclasses
     * @method _update
     * @return {undefined}
     */
    _update() {
      this.battlefloor.update();
    }

    /**************************
        Helper functions
    **************************/

}
export {
    Battleplan as
    default
}
