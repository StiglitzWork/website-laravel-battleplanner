/**************************
	Extention class type
**************************/
const Helpers = require('./Helpers.js').default;

class Slot extends Helpers {

    /**************************
            Constructor
    **************************/

    constructor() {
        // Super Class constructor call
        super();
    }

	init(){
		
	}
    setOperator(operator){
        if(operator != null){
            this.operatorId = operator.id;
            this.color = operator.colour;
            this.operatorName = operator.name;
            this.image_src = operator.icon;
        } else{
            this.operatorId = null;
            this.color = "000000";
            this.operatorName = null;
            this.image_src = null;
        }
    }

    generateDom(){
        var dom = "";
        if (this.isOwner) {
            if (this.operatorId == null) {
                dom += `<input type="image" id="operatorSlot-${this.id}" data-id="${this.id}" src="/media/ops/empty.png" class="op-icon operator-slot operator-border" data-toggle="modal" data-target="#opModal" onclick="setEditingSlot($(this).data('id'))" style="border-color: #${this.color}" />`
            } else{
                dom += `<input type="image" id="operatorSlot-${this.id}" data-id="${this.id}" src="${this.image_src}" class="op-icon operator-slot operator-border" data-toggle="modal" data-target="#opModal" onclick="setEditingSlot($(this).data('id'))" style="border-color: #${this.color}"/>`
            }
        } else{
            if (this.operatorId == null) {
                dom += `<input type="image" id="operatorSlot-${this.id}" data-id="${this.id}" src="/media/ops/empty.png" class="op-icon operator-slot operator-border no-pointer" style="border-color: #${this.color}" />`
            } else{
                dom += `<input type="image" id="operatorSlot-${this.id}" data-id="${this.id}" src="${this.image_src}" class="op-icon operator-slot operator-border" style="border-color: #${this.color}"/>`
            }
        }
        return dom;
    }

    /**************************
        Public functions
    **************************/

}
export {
    Slot as
    default
}
