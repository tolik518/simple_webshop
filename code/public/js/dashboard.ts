export {};
declare var d3: any;

await import("./lib/d3/7.3.0/dist/d3.min.js").then(function () {
    console.log("d3.version: "  + d3.version);

    renderGraphOrdersToPrice();
    getSetOrderIncome();
    getSetOrderIncomeToday();

    renderBarchchart();

});

function reindex_array_keys(array, start){
    let temp = [];
    start = typeof start == 'undefined' ? 0 : start;
    start = typeof start != 'number' ? 0 : start;
    for(let i in array){
        temp[start++] = array[i];
    }
    return temp;
}

function getSetOrderIncomeToday() {
    let totalIncomeToday: number  = 0.0;
    let totalOrdersToday: number  = 0;

    d3.json("/admin/api/v1/orders/today").then (function(data){
        data.map((d)=> totalIncomeToday += +d.price);
        totalOrdersToday = data.length;

        let totalOrdersTodayElement = document.getElementById("totalOrdersToday")
        totalOrdersTodayElement.innerHTML = String(totalOrdersToday);

        let totalIncomeTodayElement = document.getElementById("totalIncomeToday")
        totalIncomeTodayElement.innerHTML = (Math.round(totalIncomeToday * 100) / 100).toFixed(2) + "€";
    });
}

function getSetOrderIncome(){
    let totalIncome: number  = 0.0;
    let totalOrders: number  = 0;

    d3.json("/admin/api/v1/orders").then (function(data){
        data.map((d)=> totalIncome += +d.price);
        totalOrders = data.length;

        let totalOrdersElement = document.getElementById("totalOrders")
        totalOrdersElement.innerHTML = String(totalOrders);

        let totalIncomeElement = document.getElementById("totalIncome")
        totalIncomeElement.innerHTML = (Math.round(totalIncome * 100) / 100).toFixed(2) + "€";
    });
}

function renderGraphOrdersToPrice() {
    const parseTime = d3.timeParse("%Y-%m-%d %H:%M:%S");
    const formatTime = d3.timeFormat("%Y-%m-%d");
    const toDate = d3.timeParse("%Y-%m-%d");

    // set the dimensions and margins of the graph
    const margin = {top: 20, right: 20, bottom: 50, left: 100};
    const width  = 960 - margin.left - margin.right;
    const height = 500 - margin.top - margin.bottom;
    // parse the date / time
    // set the ranges
    const x = d3.scaleTime().range([0, width]);
    const y = d3.scaleLinear().range([height, 0]);

    // define the area
    var area = d3.area()
        .x(function(d) { return x(d.ordered_at); })
        .y0(height)
        .y1(function(d) { return y(d.price); });

    // define the line
    const valueline = d3.line()
        .x(function(d) {
            return x(d.ordered_at);
        })
        .y(function(d) {
            return y(d.price);
        });

    // append the svg obgect to the body of the page
    // appends a 'group' element to 'svg'
    // moves the 'group' element to the top left margin
    const svg = d3.select("#graphOrdersToPrice").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    // gridlines in x axis function
    function make_x_gridlines() {
        return d3.axisBottom(x)
            .ticks(5)
    }
    // gridlines in y axis function
    function make_y_gridlines() {
        return d3.axisLeft(y)
            .ticks(5)
    }

    var div = d3.select("#graphOrdersToPrice").append("div")
        .attr("class", "tooltip")
        .style("opacity", 0);

    // Get the data
    d3.json("/admin/api/v1/orders").then (function(data){
        // format the data

        let price: number = 0.0;

        data.forEach(function(d) {
            //d.ordered_at = toDate(formatTime(parseTime(d.ordered_at)));
            d.ordered_at = parseTime(d.ordered_at);

            price += +d.price;
            d.price = price;
        });
        // Scale the range of the data
        x.domain(d3.extent(data, function(d) {
            let test = d.ordered_at;
            return test;
        }));
        y.domain([0, d3.max(data, function(d) {
            return d.price;
        })]);

        // add the X gridlines
        svg.append("g")
            .attr("class", "grid")
            .attr("transform", "translate(0," + height + ")")
            .call(make_x_gridlines()
                .tickSize(-height)
                .tickFormat("")
            )
        // add the Y gridlines
        svg.append("g")
            .attr("class", "grid")
            .call(make_y_gridlines()
                .tickSize(-width)
                .tickFormat("")
            )

        //area under the line
        svg.append("path")
            .data([data])
            .attr("class", "area")
            .attr("d", area);

        // Add the valueline path.
        svg.append("path")
            .data([data])
            .attr("class", "line")
            .attr("d", valueline);

        //scatterpoint dots
        svg.selectAll("dot")
            .data(data)
            .enter().append("circle")
            .attr("fill", "steelblue")
            .attr("r", 4)
            .attr("cx", function(d) { return x(d.ordered_at); })
            .attr("cy", function(d) { return y(d.price); })
            .on("mouseover", function(event,d) {
                div.transition()
                    .duration(200)
                    .style("opacity", .9);
                div.html(formatTime(d.ordered_at) + "<br/>" + ((Math.round(d.price * 100) / 100).toFixed(2) + "€"))
                    .style("left", (event.pageX) + 10 + "px")
                    .style("top", (event.pageY) + 5 + "px");
            })
            .on("mouseout", function(d) {
                div.transition()
                    .duration(500)
                    .style("opacity", 0);
            });


        // Add the X Axis
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .attr("class", "xachseunten")
            .call(d3.axisBottom(x).ticks(5));

        // Add the Y Axis
        svg.append("g")
            .attr("class", "yachselinks")
            .call(d3.axisLeft(y));

        svg.append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 0 - margin.left)
            .attr("x",0 - (height / 2))
            .attr("dy", "1em")
            .style("text-anchor", "middle")
            .text("Einnahmen in €");

        svg.append("text")
            .attr("y", height + margin.bottom)
            .attr("x", width/2)
            .attr("dx", "1em")
            .style("text-anchor", "middle")
            .text("Datum");

    });
}

function renderBarchchart() {
    let removedDuplicates  = {};
    let itemCounts = [];

    d3.json("/admin/api/v1/fullorders").then (function(data)
    {
        data.map((d)=>{
            removedDuplicates[d.item_id] = d.name;
        });

        Object.keys(removedDuplicates).forEach((index) =>
        {
            if (itemCounts[removedDuplicates[index]]){
                itemCounts[removedDuplicates[index]].anzahl  += 1;
            } else {
                itemCounts[removedDuplicates[index]] = {name: removedDuplicates[index], anzahl: 1};
            }
        });

        data = reindex_array_keys(itemCounts,0);

        // set the dimensions and margins of the graph
        const margin = {top: 20, right: 20, bottom: 50, left: 100};
        const width  = 960 - margin.left - margin.right;
        const height = 500 - margin.top - margin.bottom;
        // set the ranges
        var x = d3.scaleBand()
            .range([0, width])
            .padding(0.1);
        var y = d3.scaleLinear()
            .range([height, 0]);
        // append the svg object to the body of the page
        // append a 'group' element to 'svg'
        // moves the 'group' element to the top left margin
        var svg = d3.select("#graphOrdersToPrice").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform",
                "translate(" + margin.left + "," + margin.top + ")");


        const palette: string[]  = ['#177dd7','#259ebf', '#44519b','#3545a8', '#5460a2'];
        const colors: Function = d3.scaleOrdinal()
            .domain(data)
            .range(palette);

        // format the data
        data.forEach(function(d) {
            d.anzahl = +d.anzahl;
        });
        // Scale the range of the data in the domains
        x.domain(data.map(function(d) { return d.name; }));
        y.domain([0, d3.max(data, function(d) { return d.anzahl; })]);
        // append the rectangles for the bar chart
        svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            //.attr("class", "bar")
            .style("fill",  (d) => colors(d.name))
            .style("opacity", "0.4")
            .style("outline", "2px solid")
            .style("outline-color", (d) => colors(d.name))
            .attr("x", function(d) { return x(d.name); })
            .attr("width", x.bandwidth())
            .attr("y", function(d) { return y(d.anzahl); })
            .attr("height", function(d) { return height - y(d.anzahl); });

        // add the x Axis
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .attr("class", "xachseunten")
            .style("font-size", "5rem !important")
            .call(d3.axisBottom(x));

        // add the y Axis
        svg.append("g")
            .attr("class", "yachselinks")
            .call(d3.axisLeft(y));

        svg.append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 0 - margin.left)
            .attr("x",0 - (height / 2))
            .attr("dy", "1em")
            .style("text-anchor", "middle")
            .text("Items");

    });
    //console.log(itemCounts); //TODO: ab hier weitermachen
}