var width = window.innerWidth,
    height = 850;

var fill = d3.scale.category10();

var nodes = [],
    labels = [],
    foci = [{
        x: 550,
        y: 350
    }, {
        x: 850,
        y: 150
    }, {
        x: 800,
        y: 150
    }];

var svg = d3.select("body").append("svg")
    .attr("width", "100%")
    .attr("height", height)

    //.attr("domflag", '');

var force = d3.layout.force()
    .nodes(nodes)
    .charge(-2400) //衝擊
    //.chargeDistance(200)
    .gravity(0.001) //重力
    .friction(0.3) //摩擦
    .size([width, height])
    .on("tick", tick);

//var node = svg.selectAll("circle");
var node = svg.selectAll("g");

var container = svg.append("svg:g")
    .attr("width", width)
    .attr("height", height);

var counter = 0;

function tick(e) {
    var k = .1 * e.alpha;

    // Push nodes toward their designated focus.
    nodes.forEach(function (o, i) {
        o.y += (foci[0].y - o.y) * k;
        o.x += (foci[0].x - o.x) * k;
    });

    node.attr("transform", function (d) {
        return "translate(" + d.x + "," + d.y + ")";
    });

}


var timer = setInterval(function () {

    if (nodes.length > data.length - 1) {
        clearInterval(timer);
        return;
    }

    var item = data[counter];
    nodes.push({
        id: item.id,
        r: 24,
        name: item.name,
        color: item.color,
        url: item.url,
        img: item.img
    });
    force.start();

    node = node.data(nodes);

    var n = node.enter().append("g")
        .attr("class", "node")
        .attr("transform", function (d) {
            return "translate(" + d.x + "," + d.y + ")";
        })
        .style('cursor', 'pointer')
        .on('mousedown', function () {
            var sel = d3.select(this);
            sel.moveToFront();
        })
        .call(force.drag);


    n.append("circle")
        .attr("r", 12) 
        .style("fill", function (d) {
            return fill(d.color);
        })
        .style("opacity",0.1)
    
    
        

    n.append("a")
        .attr("xlink:href", function (d) {
            return d.url;te
        })
        .attr("target", "_blank")
        .append("svg:image")
        .attr('x', -9)
        .attr('y', -12)
        .attr('width', 80)
        .attr('height', 96)
         .attr("xlink:href", function (d) {
            return d.img;
        })     
    
    n.append("text")
        .text(function (d) {
            return d.name;
        })
        .style("font-size", function (d) {
            //return Math.min(2 * d.r, (2 * d.r - 8) / this.getComputedTextLength() * 16) + "px";
            return  "20px" ;
        })
        .style('fill', '#EEE')
        .attr("dx", "1em")
        .attr("dy", "-1em")
    
    counter++;
}, 100);


d3.selection.prototype.moveToFront = function () {
    return this.each(function () {
        this.parentNode.appendChild(this);
    });
};

function resize() {
    width = window.innerWidth;
    force.size([width, height]);
    force.start();
}

d3.select(window).on('resize', resize);