var canvas = document.getElementsByTagName('canvas')[0];
canvas.width = document.getElementsByTagName('canvas')[0].getAttribute('width');
canvas.height = document.getElementsByTagName('canvas')[0].getAttribute('height');
document.addEventListener('contextmenu', event => event.preventDefault());

var gkhead = floorsArray;
var visible = new Array();

var clickSVGPt = new Array();
var clickPtX = new Array();
var clickPtY = new Array();
var clickDrag = new Array();
var paint, ptFromX, ptFromY, ptToX, ptToY;

gkhead.forEach(function() {
    visible.push(false);
});

visible[0] = true;

var ctx = canvas.getContext('2d');
trackTransforms(ctx);

var ptFrom = ctx.createNewPoint();
var ptTo = ctx.createNewPoint();

function redraw() {

    // Clear the entire canvas
    var p1 = ctx.transformedPoint(0, 0);
    var p2 = ctx.transformedPoint(canvas.width, canvas.height);
    ctx.clearRect(p1.x, p1.y, p2.x - p1.x, p2.y - p1.y);

    ctx.save();
    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.restore();

    ctx.strokeStyle = "#32df26";
    ctx.lineJoin = "round";
    ctx.lineWidth = 5;

    for (var i = 0; i < gkhead.length; i++) {
        if (visible[i]) {
            ctx.drawImage(gkhead[i], 0, 0);
        }
    }
    // for (var i = 0; i < clickSVGPt.length; i++) {
    //
    //     if (clickDrag[i] && i) {
    //         ptFrom = clickSVGPt[i - 1];
    //     } else {
    //         ptFrom.x = clickSVGPt[i].x - 1;
    //         ptFrom.y = clickSVGPt[i].y;
    //     }
    //     ptTo = clickSVGPt[i];
    //
    //     ctx.beginPath();
    //
    //     ctx.moveTo(ptFrom.x, ptFrom.y);
    //
    //     ctx.lineTo(ptTo.x, ptTo.y);
    //
    //     ctx.closePath();
    //
    //     ctx.stroke();
    // }
    for (var i = 0; i < clickPtX.length; i++) {

        if (clickDrag[i] && i) {
            ptFromX = clickPtX[i - 1];
            ptFromY = clickPtY[i - 1];
        } else {
            ptFromX = clickPtX[i] - 1;
            ptFromY = clickPtY[i];
        }
        ptToX = clickPtX[i];
        ptToY = clickPtY[i];

        ctx.beginPath();

        ctx.moveTo(ptFromX, ptFromY);

        ctx.lineTo(ptToX, ptToY);

        ctx.closePath();

        ctx.stroke();
    }
}

window.onload = function() {

    redraw();

    var lastX = canvas.width / 2,
        lastY = canvas.height / 2;

    var dragStart, dragged;

    canvas.addEventListener('mousedown', function(evt) {
        document.body.style.mozUserSelect = document.body.style.webkitUserSelect = document.body.style.userSelect = 'none';
        lastX = evt.offsetX || (evt.pageX - canvas.offsetLeft);
        lastY = evt.offsetY || (evt.pageY - canvas.offsetTop);
        var pt = ctx.transformedPoint(lastX, lastY);

        //alert("x:" + lastX + " y:" + lastY);
        //alert("x:" + pt.x + " y:" + pt.y);
        if (evt.which == 3) {
            dragStart = pt;
            dragged = false;
        }
        if (evt.which == 1) {

            paint = true;

            addClick(py.x, pt.y, false);

            // addClickPt(pt, false);

            redraw();
        }
    }, false);

    canvas.addEventListener('mousemove', function(evt) {
        lastX = evt.offsetX || (evt.pageX - canvas.offsetLeft);
        lastY = evt.offsetY || (evt.pageY - canvas.offsetTop);
        var pt = ctx.transformedPoint(lastX, lastY);

        if (dragStart) {
            dragged = true;
            ctx.translate(pt.x - dragStart.x, pt.y - dragStart.y);
            redraw();
        }
        if (paint) {
            addClick(pt.x, pt.y, true);
            // addClickPt(pt, true);
            redraw();
        }

    }, false);

    canvas.addEventListener('mouseup', function(evt) {
        dragStart = null;
        paint = false;
        redraw();
    }, false);

    canvas.addEventListener('mouseleave', function(e) {
        paint = false;
        redraw();
    });

    var scaleFactor = 1.1;

    var zoom = function(clicks) {
        var pt = ctx.transformedPoint(lastX, lastY);
        ctx.translate(pt.x, pt.y);
        var factor = Math.pow(scaleFactor, clicks);
        ctx.scale(factor, factor);
        ctx.translate(-pt.x, -pt.y);
        redraw();
    }

    var handleScroll = function(evt) {
        var delta = evt.wheelDelta ? evt.wheelDelta / 40 : evt.detail ? -evt.detail : 0;
        if (delta) zoom(delta);
        return evt.preventDefault() && false;
    };

    canvas.addEventListener('DOMMouseScroll', handleScroll, false);
    canvas.addEventListener('mousewheel', handleScroll, false);

};

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

    redraw();
};
///////////////////////////////////////////////////////////////////////

function addClickPt(point, dragging) {

    clickSVGPt.push(point);
    clickDrag.push(dragging);
};

function addClick(x, y, dragging) {

    clickPtX.push(x);
    clickPtY.push(y);
    clickDrag.push(dragging);
}

// Adds ctx.getTransform() - returns an SVGMatrix
// Adds ctx.transformedPoint(x,y) - returns an SVGPoint
function trackTransforms(ctx) {
    var svg = document.createElementNS("http://www.w3.org/2000/svg", 'svg');
    var xform = svg.createSVGMatrix();
    ctx.getTransform = function() {
        return xform;
    };

    var savedTransforms = [];
    var save = ctx.save;
    ctx.save = function() {
        savedTransforms.push(xform.translate(0, 0));
        return save.call(ctx);
    };

    var restore = ctx.restore;
    ctx.restore = function() {
        xform = savedTransforms.pop();
        return restore.call(ctx);
    };

    var scale = ctx.scale;
    ctx.scale = function(sx, sy) {
        xform = xform.scaleNonUniform(sx, sy);
        return scale.call(ctx, sx, sy);
    };

    var rotate = ctx.rotate;
    ctx.rotate = function(radians) {
        xform = xform.rotate(radians * 180 / Math.PI);
        return rotate.call(ctx, radians);
    };

    var translate = ctx.translate;
    ctx.translate = function(dx, dy) {
        xform = xform.translate(dx, dy);
        return translate.call(ctx, dx, dy);
    };

    var transform = ctx.transform;
    ctx.transform = function(a, b, c, d, e, f) {
        var m2 = svg.createSVGMatrix();
        m2.a = a;
        m2.b = b;
        m2.c = c;
        m2.d = d;
        m2.e = e;
        m2.f = f;
        xform = xform.multiply(m2);
        return transform.call(ctx, a, b, c, d, e, f);
    };

    var setTransform = ctx.setTransform;
    ctx.setTransform = function(a, b, c, d, e, f) {
        xform.a = a;
        xform.b = b;
        xform.c = c;
        xform.d = d;
        xform.e = e;
        xform.f = f;
        return setTransform.call(ctx, a, b, c, d, e, f);
    };

    var pt = svg.createSVGPoint();
    ctx.createNewPoint = function() {
        return svg.createSVGPoint();
    }

    ctx.transformedPoint = function(x, y) {
        pt.x = x;
        pt.y = y;
        return pt.matrixTransform(xform.inverse());
    }
}