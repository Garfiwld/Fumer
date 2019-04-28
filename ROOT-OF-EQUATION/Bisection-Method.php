<body onload="bisection(); draw();">
    <h1>Bisection Method</h1>
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="text1">input Equal</label>
                                <input type="text" class="form-control" id="text1" placeholder="x^3-x-2"
                                    value="x^3-x-2">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text2">Number Start (XL)</label>
                                <input type="text" class="form-control" id="text2" placeholder="1" value="1">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text3">Number End (XR)</label>
                                <input type="text" class="form-control" id="text3" placeholder="5" value="5">
                            </div>
                            <!-- <div class="form-group col-md-4">
                                <label for="inputPassword4">Error</label>
                                <input type="text" class="form-control" id="findErr" placeholder="0.00001"
                                    value="0.00001">
                            </div> -->
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                        onclick="bisection(); draw(); ">ENTER</button>
                </div>
            </div>
            <br>
            <!-- <div class="card">
                <div class="card-body"> -->
            <div id="plot" class="pot1"></div>
            <!-- </div>
            </div> -->
            <br>
            <div class="card">
                <div class="card-body">
                    <table id="output" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Iteration</th>
                                <th scope="col">L</th>
                                <th scope="col">R</th>
                                <th scope="col">M</th>
                                <th scope="col">Error</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="list-data">
                                <td id="Iteration"></td>
                                <td id="xl1"></td>
                                <td id="xr1"></td>
                                <td id="x"></td>
                                <td id="error"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>



<script>
const bisection = () => {

    var table = document.getElementById("output");
    var xl = document.getElementById("text2").value;
    var xr = document.getElementById("text3").value;
    var findErr = 0.00001;
    // var findErr = document.getElementById("findErr").value;
    var x_old = xr;
    var xm = 0;
    var n = 0;
    // แปลงค่าตัวแปรเป็นตัวแปร Number ด้วยฟังก์ชัน parseInt() และ parseFloat()
    var check = parseFloat(0.000000);
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    do {

        if (xl != xr) {
            xm = findxm(xl, xr);
            // check = Math.abs(xm - x_old);
            check = Math.abs(xm - x_old).toFixed(8);
        } else {
            check = 0;
        }

        n++;

        // Create an empty <tr> element and add it to the 1st position of the table:
        var row = table.insertRow(n);

        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);

        // Add some text to the new cells:

        cell1.innerHTML = n;
        cell1.setAttribute("id", "cell");
        cell2.innerHTML = xl;
        cell2.setAttribute("id", "cell");
        cell3.innerHTML = xr;
        cell3.setAttribute("id", "cell");
        cell4.innerHTML = xm;
        cell4.setAttribute("id", "cell");
        cell5.innerHTML = check;
        cell5.setAttribute("id", "cell");

        if (parseFloat(xl) < parseFloat(xr)) {
            if (funcal(xl) < funcal(xr)) {
                if (funcal(xm) > 0) {
                    xr = xm
                } else if (funcal(xm) < 0) {
                    xl = xm
                } else if (funcal(xm) == 0) {
                    xr = xm;
                    xl = xm;
                }
            } else if (funcal(xl) > funcal(xr)) {
                if (funcal(xm) < 0) {
                    xr = xm
                } else if (funcal(xm) > 0) {
                    xl = xm
                } else if (funcal(xm) == 0) {
                    xr = xm;
                    xl = xm;
                }
            }
        }
        x_old = xm;
    } while (check > findErr && n < 100)
    var tempXm = xm;
}


// หา Xm
const findxm = (xl, xr) => {
    return (parseFloat(xl) + parseFloat(xr)) / 2
}

// แก้สมาการ X
const funcal = (X) => {
    var expression = document.getElementById("text1").value;
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X)
    };
    return expr.eval(scope);
}

// ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
}

//การวาดที่จะไปใส่ใน plot
const draw = () => {
    try {
        // compile the expression once
        const expression = document.getElementById('text1').value

        const expr = math.compile(expression)

        // evaluate the expression repeatedly for different values of x
        const xValues = math.range(-10, 10, 0.5).toArray()
        const yValues = xValues.map(function(x) {
            return expr.eval({
                x: x
            })
        })


        // render the plot using plotly
        const trace1 = {
            x: xValues,
            y: yValues,
            type: 'scatter'
        };

        const trace2 = {
            x: this.tempXm,
            y: [0],
            mode: 'markers',
            type: 'scatter'
        };

        const data = [trace1, trace2]
        Plotly.newPlot('plot', data, {
            responsive: true
        });

    } catch (err) {
        console.error(err)
        alert(err)
    }
}
</script>