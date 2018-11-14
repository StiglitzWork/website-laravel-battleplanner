/**
 * Main appication class, includes all ui functionality and application flow of the various parts
 *
 * @version 0.1
 * @author Erik Smith
 */
class App {

    /**************************
            Constructor
    **************************/

    constructor(conn_string, viewports, user_id) {
        // Instantiatable class types
        this.Battleplan = require('./Battleplan.js').default;
		this.Battlefloor = require('./Battlefloor.js').default;
		this.ToolLine = require('./ToolLine.js').default; // useable tool
        this.ToolSquare = require('./ToolSquare.js').default; // useable tool
        this.Ui = require('./Ui.js').default;

        // Settings
        this.acquisitionTime = 200;  // changeable for different

        // Varable declarations
        this.acquisitionLock = false;
        this.color = "#e66465"; //draw color
        this.conn_string = conn_string
        this.viewports = viewports
		this.user_id = user_id;
        this.tool;

        // Event variables
        this.lastCoordinates = {
            "x": 0,
            "y": 0
        }
        this.originPoints = {
            "x": 0,
            "y": 0
        }

        // Eventing variables
        this.lmb = false;
        this.rmb = false;

		this.init();

    }

    /**************************
            App Methods
    **************************/
    init(){
		// Set curent tool type
		// this.tool = new this.ToolLine();
		this.tool = new this.ToolSquare();

        // hide them until a map is chosen
		for (var property in this.viewports) {
	        $("#"+this.viewports[property]).hide();
		}

        // load battleplan if already set
        this.getRoomsBattleplan(
            this.load.bind(this)
        );
    }

    zoom(amount, x, y) {
        var coordinates = this._calculateOffset(x, y);
        this.ui.zoomCanvases(amount, x, y);
        this.ui.backgroundUpdate = true;
        this.ui.overlayUpdate = true;
        this.ui.update();
    }

    changeColor(newColor) {
        this.color = newColor
    }

    /**************************
        Battleplan Methods
    **************************/

    createBattleplan(mapId) {
        var self = this;
        $.ajax({
            method: "POST",
            url: "/battleplan/create",
            data: {
                map: mapId,
                room: this.conn_string
            },
            success: function(battleplan) {
                self.setRoomsBattleplan(battleplan.id);
            },
            error: function(result, code) {
                console.log(result);
            }
        });
    }

    getRoomsBattleplan(callback) {
        var self = this;
        $.ajax({
            method: "GET",
            url: `${this.conn_string}/getBattleplan`,
            success: function(result) {
                if (callback) {
                    callback(result);
                }
            },
            error: function(result, code) {
                console.log(result);
            }
        });
    }

    deleteBattlePlan(battleplanId) {
        var r = confirm("Are you sure you want to delete? There is no going back!");
        if (r == true) {
            var self = this;
            $.ajax({
                method: "POST",
                url: "/battleplan/delete",
                data: {
                    "battleplanId": battleplanId
                },
                success: function(result) {
                    alert("Successfully deleted! Refresh page to update 'load' list");
                },
                error: function(result, code) {
                    console.log(result);
                }
            });
        }
    }

	// Loading a saved battleplan
    loadBattlePlan(battleplanId) {
        var self = this;
        this.setRoomsBattleplan(battleplanId, function() {
            // Reset
            self.getRoomsBattleplan(function(result) {
                if (result != null) {
                    self.load(result.battleplan, result.battlefloors);
                }
            })
        });
    }

	// Tell the server to save its current state
    save() {
        var tmp = $("#battleplan_notes").val();
        var self = this;
        $.ajax({
            method: "POST",
            url: "/battleplan/save",
            data: {
                conn_string: this.conn_string,
                name: $("#battleplan_name").val(),
                notes: $("#battleplan_notes").val()
            },
            success: function(result) {
                alert("Saved!");
            },
            error: function(result, code) {
                console.log(result);
            }
        });
    }

	// Load a battle plan into the app
    load(battleplan) {
        if (battleplan) {

			// Init battleplan
			this.battleplan = Object.assign(new this.Battleplan, battleplan);
			this.battleplan.init();

			// Init UI class
            this.ui = new this.Ui(this.viewports, this.battleplan);
        }
    }

	// Set the rooms current battleplan
    setRoomsBattleplan(battleplanId, callback = null) {
        var self = this;
        $.ajax({
            method: "POST",
            url: "/room/setBattleplan",
            data: {
                battleplanId: battleplanId,
                conn_string: this.conn_string
            },
            success: function(result) {
                if (callback) {
                    callback(result)
                }
            },
            error: function(result, code) {
                console.log(result);
            }
        });
    }

	// Push changes to the server to propagate to others on the socket + add them to the DB
    pushServer() {

		// Var declarations
        this.acquisitionLock = false;
        this.battleplan.draws_transit = [];
        var self = this;

		this.battleplan.draws_transit = this.battleplan.acquireUnsavedDraws();

		// Strip object of prototypes
		var tmop = JSON.parse(JSON.stringify(this.battleplan.draws_transit));

		// Push to server API
        $.ajax({
            method: "POST",
            url: "/battlefloor/draw",
            data: {
                conn_string: this.conn_string,
                userId: this.user_id,
                "draws": JSON.parse(JSON.stringify(this.battleplan.draws_transit))
            },
            success: function(result) {
                this.ui.overlayUpdate = true;
                this.ui.update();
				// console.log(result);
            }.bind(this),
            error: function(result, code) {
                console.log(result);
            }
        });
    }

	// Draw the lines that the server has propagated to you
    serverDraw(result) {
        for (var i = 0; i < result.draws.length; i++) {

            var battlefloor = this.battleplan.getFloor(result.draws[i].battlefloor_id);

            battlefloor.serverDraw(result.draws[i]);
        }
        this.ui.overlayUpdate = true;
        this.ui.update();
    }

	// Tell the server to change the operator in a given slot
    changeOperatorSlot(slotId, operatorId) {

        $.ajax({
            method: "POST",
            url: "/operatorSlot/update",
            data: {
                conn_string: this.conn_string,
                userId: this.user_id,
                operatorSlotId: slotId,
                operatorId: operatorId
            },
            success: function(result) {
                this.changeOperatorSlotDom(result.operatorSlot.id, result.operator)
            }.bind(this),
            error: function(result, code) {
                console.log(result);
            }
        });
    }

	// Update the DOM to reflect an operator change
    changeOperatorSlotDom(operatorSlotId,operator){
        var slot = this.battleplan.getOperatorSlot(operatorSlotId);
        slot.setOperator(operator);
        this.battleplan.updateSlotsDom();
    }

    /**************************
          Floor Methods
    **************************/

    changeFloor(amount) {
        this.battleplan.changeFloor(amount);
        this.ui.floorChange = true;
        this.ui.update();
    }

    changeFloorById(floorId) {
        this.battleplan.changeFloorById(floorId);
        this.ui.floorChange = true;
        this.ui.update();
    }

    /**************************
        Canvas Methods
    **************************/

    canvasUp(ev) {
        var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);
        this._clickDeactivateEventListen(ev);

        if (!this.lmb) {
            this.ui.overlayUpdate = true;
            this.ui.update();
        }

		// Update last know coordinated
        this.lastCoordinates = coordinates;
    }

    canvasDown(ev) {
        var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);
        this._clickActivateEventListen(ev)

        if (this.lmb) {
			this.tool.action(this.battleplan.battlefloor,this.lastCoordinates, coordinates, this.color);
            // this.battleplan.battlefloor.line(coordinates, coordinates, this.color);

            // Push new lines to server
            if (!this.acquisitionLock) {
                this.acquisitionLock = true;
                setTimeout(this.pushServer.bind(this), this.acquisitionTime);
            }

			// Update last know coordinated
            this.lastCoordinates = coordinates;

            // signal Update UI
            this.ui.overlayUpdate = true;
            this.ui.update();
        }
    }

    canvasMove(ev) {
        var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);

        if (this.rmb) {
            this.ui.move(this.originPoints["x"] - (ev.offsetX / this.ui.ratio), this.originPoints["y"] - (ev.offsetY / this.ui.ratio));
            this.ui.backgroundUpdate = true;
        }

        if (this.lmb) {
            this.battleplan.battlefloor.line(this.lastCoordinates, coordinates, this.color);

            // Push new lines to server
            if (!this.acquisitionLock) {
                this.acquisitionLock = true;
                setTimeout(this.pushServer.bind(this), this.acquisitionTime);
            }

            this.ui.overlayUpdate = true;
            this.ui.update();

        }

        this.lastCoordinates = coordinates;

		// Update last known location of mouse
        if (this.rmb || this.lmb) {
            // this.lastCoordinates = coordinates;
            this.originPoints = {
                "x": (ev.offsetX / this.ui.ratio),
                "y": (ev.offsetY / this.ui.ratio)
            } //2 dimentional
        }

    }

    canvasEnter(ev) {
        var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);
        this._deactivateClickEventListen();

        // Update UI
        this.ui.overlayUpdate = true;
        this.ui.update();
    }

    canvasLeave(ev) {
        var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);
        this._deactivateClickEventListen();

        if (this.lmb) {
            // Update UI
            this.ui.overlayUpdate = true;
            this.ui.update();
        }

        // Update UI
        this.ui.overlayUpdate = true;
        this.ui.update();
    }

    /**************************
        Event detection
    **************************/

    /**
     * @description activates button press that triggered the event
     * @method _clickActivateEventListen
     * @param  {event} event that trigger this method
     * @return {undefined}
     */
    _clickActivateEventListen(ev) {
        var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);

        this.originPoints = {
            "x": ev.offsetX / this.ui.ratio,
            "y": ev.offsetY / this.ui.ratio
        } //2 dimentional
        if (ev.button == 0) this.lmb = true;
        if (ev.button == 2) this.rmb = true;
    }

    /**
     * @description unsets event provided it was pressed/released
     * @method _clickDeactivateEventListen
     * @param  {event} event that trigger this method
     * @return {undefined}
     */
    _clickDeactivateEventListen(ev) {
        if (ev.button == 0) this.lmb = false;
        if (ev.button == 2) this.rmb = false;
        this.resizeRangeY = false;
        this.resizeRangeX = false;
        this.placeholderResizing = null;
    }

    /**
     * @description removes any event handlers for a mouse
     * @method _deactivateClickEventListen
     * @return {undefined}
     */
    _deactivateClickEventListen() {
        this.lmb = false;
        this.rmb = false;
    }

    /**************************
        Helper Methods
    **************************/

    /**
     * @description determine if an array contains one or more items from another array.
     * @param {array} haystack the array to search.
     * @param {array} arr the array providing items to check for in the haystack.
     * @return {boolean} true|false if haystack contains at least one item from arr.
     */
    // _contains(haystack, arr) {
    //     return arr.some(function(v) {
    //         return haystack.indexOf(v) >= 0;
    //     });
    // };

    _calculateOffset(evx, evy) {
        var jsonResponse = {}
        jsonResponse.x = (evx / this.ui.ratio) + (this.ui.offsetX / this.ui.ratio);
        jsonResponse.y = (evy / this.ui.ratio) + (this.ui.offsetY / this.ui.ratio);
        return jsonResponse;
    }

}
export {
    App as
    default
}
