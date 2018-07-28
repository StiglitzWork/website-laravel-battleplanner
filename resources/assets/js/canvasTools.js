var svg = d3.select("#map-area").append('svg')
    .attr("width", '100%')
    .attr("height", '100%');

document.addEventListener('contextmenu', event => event.preventDefault());

var gkhead = floorsArray;
var visible = new Array();

gkhead.forEach(function(floor) {
    if (floor.src != "") {
        svg.append('svg:image').attr({
            'xlink:href': floor.src,
            x: 0,
            y: 0,
            id: floor.id,
            opacity: 0
        });
        visible.push(false);
    }
});

d3.select("#floor0").attr({
    opacity: 1
});

/*/////////////////////////////////////////////////////////////////
  CUSTOM FUNCTIONS
*/ /////////////////////////////////////////////////////////////////
function selectFloor(id, noBasement) {
    if (id == 0) {
        for (var j = 0; j < visible.length; j++) {
            visible[j] = false;
        }
        visible[0] = true;
    } else if (id == 10) {
        for (var j = 0; j < visible.length; j++) {
            visible[j] = true;
        }
    } else {
        for (var j = 0; j < visible.length; j++) {
            visible[j] = false;
        }
        if (!noBasement) {
            for (var j = 0; j <= id; j++) {
                visible[j] = true;
            }
        } else if (noBasement) {
            for (var j = 0; j < id; j++) {
                visible[j] = true;
            }
        }
    }
};
///////////////////////////////////////////////////////////////////////