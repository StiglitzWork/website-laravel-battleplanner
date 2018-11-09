function init(LISTEN_SOCKET,ROOM_CONN_STRING,app){
    //listen for battleplan Change event
    LISTEN_SOCKET.on(`BattleplanChange.${ROOM_CONN_STRING}:App\\Events\\Room\\BattleplanChange`, function(message){
        app.getRoomsBattleplan(app.load.bind(app));
    });

    //listen for someone elses draws
    LISTEN_SOCKET.on(`BattlefloorLine.${ROOM_CONN_STRING}:App\\Events\\Battlefloor\\CreateLines`, function(message){
        app.serverLine(message);
    });

    //listen for someone elses draws
    LISTEN_SOCKET.on(`ChangeOperatorSlot.${ROOM_CONN_STRING}:App\\Events\\Battleplan\\ChangeOperatorSlot`, function(message){
        app.changeOperatorSlotDom(message.operatorSlot.id,message.operator);
    });
} export {
    init as
    init
}
