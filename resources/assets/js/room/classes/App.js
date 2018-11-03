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

    constructor(conn_string, viewportId, canvasBackgroundId , canvasOverlayId, listenSocket, user_id, isOwner) {
        // Instantiatable class types
        this.Battleplan = require('./Battleplan.js').default;
        this.Battlefloor = require('./Battlefloor.js').default;
        this.Ui = require('./Ui.js').default;

        // Identifiers
        this.type = "App"; // Json identifier

        // Varable declarations
        this.color = "#e66465"; //draw color
        this.conn_string = conn_string
        this.viewportId = viewportId
        this.canvasBackgroundId = canvasBackgroundId
        this.canvasOverlayId = canvasOverlayId
        this.socket = listenSocket;
        this.user_id = user_id;
        this.isOwner = isOwner;

        // When we draw once, we start a timer to send to server so that we do not send a request per draw
        this.acquiringDelayedDraws = false;
        this.delayUpdateTimer = 200;

        // hide them until a map is chosen
        $("#" + this.viewportId).hide();
        $("#" + this.canvasBackgroundId).hide();
        $("#" + this.canvasOverlayId).hide();

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

        this.resizeRangeX = false;
        this.resizeRangeY = false;
        this.placeholderResizing = null;

        // load battleplan if already set
        this.getRoomsBattleplan(this.load.bind(this));
    }

    /**************************
            App Methods
    **************************/

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

    deleteBattlePlan(battleplanId) {
        var r = confirm("Are you sure you want to delete? There is no goint back!");
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

    loadBattlePlan(battleplanId) {
        // set the battleplan
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

    load(battleplan) {
        if (battleplan) {
            $("#battleplan_name").val(battleplan.name);
            this.battleplan = new this.Battleplan(battleplan, this.isOwner);
            this.ui = new this.Ui(this.viewportId, this.canvasBackgroundId, this.canvasOverlayId, this.battleplan);

            // Update operator doms
            this.battleplan.loadSlots(battleplan.slots);
        }
    }

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

    getRoomsBattleplan(callback) {
        var self = this;
        $.ajax({
            method: "GET",
            url: `${this.conn_string}/getBattleplan`,
            // data: { conn_string : this.conn_string},
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

    pushDrawServer() {
        this.acquiringDelayedDraws = false;
        var draws_transit = [];

        for (var i = 0; i < this.battleplan.battlefloors.length; i++) {
            draws_transit = draws_transit.concat(this.battleplan.battlefloors[i].draws_unpushed);
            this.battleplan.battlefloors[i].draws = this.battleplan.battlefloors[i].draws.concat(this.battleplan.battlefloors[i].draws_unpushed);
            this.battleplan.battlefloors[i].draws_unpushed = [];
        }

        this.draws_transit = this.draws_unpushed;
        this.draws_unpushed = [];
        var self = this;

        $.ajax({
            method: "POST",
            url: "/battlefloor/draw",
            data: {
                conn_string: this.conn_string,
                userId: this.user_id,
                "draws": draws_transit
            },
            success: function(result) {
                // debugging only
            },
            error: function(result, code) {
                console.log(result);
            }
        });
    }

    serverDraw(result) {
        for (var i = 0; i < result.draws.length; i++) {

            var battlefloor = this.battleplan.getFloor(result.draws[i].battlefloor_id);

            battlefloor.serverDraw({
                    "x": result.draws[i]["originX"],
                    "y": result.draws[i]["originY"],
                }, {
                    "x": result.draws[i]["destinationX"],
                    "y": result.draws[i]["destinationY"],
                },
                result.draws[i].color);
        }
        this.ui.overlayUpdate = true;
        this.ui.update();
    }

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

    }

    canvasDown(ev) {
        // var eventX = (ev.offsetX)/ this.ui.ratio;
        // var eventY = (ev.offsetY) / this.ui.ratio;
        var coordinates = this._calculateOffset(ev.offsetX, ev.offsetY);
        this._clickActivateEventListen(ev)
        if (this.lmb) {
            this.battleplan.battlefloor.draw(coordinates, coordinates, this.color);

            // Push new drawings to server
            if (!this.acquiringDelayedDraws) {
                this.acquiringDelayedDraws = true;
                setTimeout(this.pushDrawServer.bind(this), this.delayUpdateTimer);
            }

            this.lastCoordinates = coordinates;
            // Update UI
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
            this.battleplan.battlefloor.draw(this.lastCoordinates, coordinates, this.color);

            // Push new drawings to server
            if (!this.acquiringDelayedDraws) {
                this.acquiringDelayedDraws = true;
                setTimeout(this.pushDrawServer.bind(this), this.delayUpdateTimer);
            }

            this.ui.overlayUpdate = true;
            this.ui.update();

        } else {
            // Resize event check
            this.resizeRangeY = false;
            this.resizeRangeX = false;
        }

        if (this.rmb || this.lmb) {
            this.lastCoordinates = coordinates;
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
    _contains(haystack, arr) {
        return arr.some(function(v) {
            return haystack.indexOf(v) >= 0;
        });
    };

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
