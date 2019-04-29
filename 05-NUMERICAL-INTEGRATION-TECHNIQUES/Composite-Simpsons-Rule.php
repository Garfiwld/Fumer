<h1>Composite Simpson's Rule</h1>

<body onload="Composite_Simpson(); draw();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="text1">input Equal</label>
                                <input type="text" class="form-control" id="text1" placeholder="1/(x^5+7)^(1/3)"
                                    value="1/(x^5+7)^(1/3)">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="text2">Number Start (XL)</label>
                                <input type="text" class="form-control" id="text2" placeholder="0" value="0">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="text3">Number End (XR)</label>
                                <input type="text" class="form-control" id="text3" placeholder="1" value="1">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="text4">input N split</label>
                                <input type="text" class="form-control" id="text4" placeholder="4" value="4">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                        onclick="Composite_Simpson(); draw();">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div id="plot" class="pot1"></div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h1 class="h2" style="margin-top:10px">output</h1>
                    <table id="output" style="padding: 0px 8px;" class="table table-hover">
                        <tr style="text-align: center;">
                            <th width="20%">result</th>
                            <th width="20%">real</th>
                            <th width="20%">error</th>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
const Composite_Simpson = () => {
    var table = document.getElementById("output");
    var expression = document.getElementById("text1").value;
    var xstart = document.getElementById("text2").value;
    var xend = document.getElementById("text3").value;
    var n = document.getElementById("text4").value;
    n = parseInt(n);
    xstart = parseFloat(xstart);
    xend = parseFloat(xend);
    var arrayx = [],
        arrayy = [];
    var error = 0;

    var temp = h / 2;
    var temp2 = 0;
    var temp3 = 0;
    var tempy = 0;
    var tempn = 1;
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    var h = Math.abs((xstart - xend) / n);
    var currentx = xstart;


    tempy = funcal(currentx, expression);
    var result = tempy;
    arrayx.push(currentx);
    arrayy.push(tempy);
    currentx = currentx + h;

    for (i = 0; i < n - 1; i++) {
        if (tempn % 2 == 0) {
            tempy = funcal(currentx, expression);
            temp3 = temp3 + tempy;
            arrayx.push(currentx);
            arrayy.push(tempy);
            currentx = currentx + h;
        } else {
            tempy = funcal(currentx, expression);
            temp2 = temp2 + tempy;
            arrayx.push(currentx);
            arrayy.push(tempy);
            currentx = currentx + h;
        }
        tempn++;
    }

    tempy = funcal(currentx, expression);
    result = result + tempy + temp2 * 4 + temp3 * 2;
    result = result * (h / 3)
    arrayx.push(currentx);
    arrayy.push(tempy);

    var realarea = infuncal(xstart, xend, expression);
    error = Math.abs(result - realarea);

    draw(arrayx, arrayy);

    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.setAttribute("id", "cell");
    cell2.setAttribute("id", "cell");
    cell2.setAttribute("id", "cell");
    cell1.innerHTML = result;
    cell2.innerHTML = realarea;
    cell3.innerHTML = error;

}




// แก้สมาการ X
const funcal = (X, expression) => {
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X)
    };
    return expr.eval(scope);
}

const infuncal = (a, b, expression) => {
    var integral = Algebrite.integral(Algebrite.eval(expression)).toString();
    console.log(integral);
    expr = math.compile(integral);
    let scope_a = {
        x: parseFloat(a)
    };
    let scope_b = {
        x: parseFloat(b)
    };
    return expr.eval(scope_b) - expr.eval(scope_a);
}

//ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
}

//การวาดที่จะไปใส่ใน plot
const draw = (x, y) => {
    try {
        /*// compile the expression once
        const expression = document.getElementById('text1').value
        const expr = math.compile(expression)

        // evaluate the expression repeatedly for different values of x
        const xValues = math.range(-10, 10, 0.5).toArray()
        const yValues = xValues.map(function (x) {
        	return expr.eval({x: x})
        })

        // render the plot using plotly
        const trace1 = {
        	x: xValues,
        	y: yValues,
        	type: 'scatter'
        }
        const trace2 = {
        	x: xValues,
        	y: yValues,
        	type: 'scatter'
        }*/
        const data = [{
            x: x,
            y: y
        }]
        Plotly.newPlot(plot, data, {
            margin: {
                t: 0
            }
        });

        /*const data = [trace1,trace2]
        Plotly.newPlot('plot', data)*/
    } catch (err) {
        console.error(err)
        alert(err)
    }
}
</script>



<script src="js/algebrite.bundle-for-browser.js"></script>



<!-- <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item"
        src="https://www.wolframcloud.com/objects/demonstrations/NumericalIntegrationBySimpsons13And38Rules?_width=700&_view=frameless"
        freamborder="0" allowfullscreaen></iframe>
</div> -->