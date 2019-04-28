<h1>Jacobi Iteration Method</h1>

<body onload="CreateTable(text1.value);">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <h5>input 'n' Create table input</h5>
                    <input type="text" class="form-control" id="text1" placeholder="3" name="text" placeholder="x^3-x-2"
                        value="3" required>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-blockbtn btn-primary btn-lg btn-block"
                        onclick="CreateTable(text1.value)">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5>Table Input</h5>
                    <table id="InputTable"></table>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="getdata()">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5>output (Result)</h5>
                    <table id="output" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">X</th>
                                <th scope="col">resultX</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="list-data">
                                <td id="X"></td>
                                <td id="resultX"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h5>output Iteration</h5>
                    <table id="outputIter" class="table table-bordered"></table>
                </div>
            </div>

        </div>
    </div>
</body>



<script>
const getdata = () => {
    n = document.getElementById("text1").value;
    var arr = [];
    for (i = 0; i < n; i++) {
        arr.push([]);
        for (j = 0; j <= parseInt(n) + 1; j++) {
            arr[i].push(document.getElementById(i + "|" + j).value);
        }
    }

    var a = [];
    var b = [];
    var x = [];
    for (i = 0; i < n; i++) {
        a.push([]);
        for (j = 0; j <= parseInt(n) + 1; j++) {
            if (j < parseInt(n)) {
                a[i].push(arr[i][j]);
            } else if (j == n) {
                b.push(arr[i][j]);
            } else {
                x.push(arr[i][j]);
            }
        }
    }
    //call
    Jacobi_Ireration(a, b, x);
}

const Jacobi_Ireration = (a, b, x) => {
    var n = a.length;

    var table = document.getElementById("output");
    var table2 = document.getElementById("outputIter");
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    var xold = [];
    var temp = [];
    var check = [];
    var checkT;
    var Iteration = 1;
    for (i = 0; i < n; i++) {
        temp.push(0.0);
        check.push(0.0);
        xold.push(0.0);
    }

    var row = table2.insertRow(0);
    for (i = 0; i < parseInt(n) * 2 + 1; i++) {
        if (i == 0) {
            var cell = row.insertCell(i);
            cell.setAttribute("id", "cell");
            cell.innerHTML = "Iteration";
        } else if (i < parseInt(n) + 1) {
            var cell = row.insertCell(i);
            cell.setAttribute("id", "cell");
            cell.innerHTML = "x" + i;
        } else {
            var cell = row.insertCell(i);
            cell.setAttribute("id", "cell");
            cell.innerHTML = "Error(x" + (i - n) + ")";
        }
    }

    do {
        checkT = false;
        for (i = 0; i < n; i++) {
            temp[i] = b[i];
            for (j = 0; j < n; j++) {
                if (i != j) {
                    temp[i] = temp[i] - a[i][j] * x[j];
                }
            }
            temp[i] = temp[i] / a[i][i];
        }
        xold = x.slice();
        x = temp.slice();

        for (i = 0; i < n; i++) {
            console.log(x[i] - xold[i]);
            check[i] = Math.abs((x[i] - xold[i]) / x[i]);
            if (check[i] > 0.00001) {
                checkT = true;
            }
        }
        if (Iteration == 1) {
            checkT = true;
        }

        row = table2.insertRow(Iteration);
        for (i = 0; i < parseInt(n) * 2 + 1; i++) {
            if (i == 0) {
                var cell = row.insertCell(i);
                cell.setAttribute("id", "cell");
                cell.innerHTML = Iteration;
            } else if (i < parseInt(n) + 1) {
                var cell = row.insertCell(i);
                cell.setAttribute("id", "cell");
                cell.innerHTML = parseFloat(x[i - 1]).toPrecision(8);
            } else {
                var cell = row.insertCell(i);
                cell.setAttribute("id", "cell");
                cell.innerHTML = parseFloat(check[i - n - 1]).toPrecision(4);
            }
        }
        Iteration++;

    } while (checkT && Iteration < 100)

    var num = 1;
    for (i = 0; i < n; i++) {
        var row = table.insertRow(num);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = "X|" + num + ":    ";
        cell2.innerHTML = x[i];
        num++;
    }
}



// แก้สมาการ X
const funcal = (X, expression) => {
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X)
    };
    return expr.eval(scope);
}

//ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
    var count = document.getElementById("outputIter").getElementsByTagName("tr").length;
    for (j = 0; j < count; j++) {
        document.getElementById("outputIter").deleteRow(0);
    }
}

const CreateTable = (n) => {
    var table = document.getElementById("InputTable");
    console.log(document.getElementById("InputTable").getElementsByTagName("tr").length)
    if (document.getElementById("InputTable").getElementsByTagName("tr").length > 0) {
        cleantableinput();
    }

    var row = table.insertRow(0);

    console.log(n);
    for (i = 0; i <= parseInt(n) + 2; i++) {
        if (i == 0) {
            var cell = row.insertCell(i);
            cell.innerHTML = "";
        } else {
            if (i == parseInt(n) + 1) {
                var cell = row.insertCell(i);
                cell.innerHTML = "Y";
            } else if (i == parseInt(n) + 2) {
                var cell = row.insertCell(i);
                cell.innerHTML = "initial X";
            } else {
                var cell = row.insertCell(i);
                cell.innerHTML = "X" + parseInt(i - 1);
            }
        }
    }
    for (i = 1; i <= n; i++) {
        var row = table.insertRow(i);
        for (j = 0; j <= parseInt(n) + 2; j++) {
            if (j == 0) {
                var cell = row.insertCell(j);
                cell.innerHTML = "a" + parseInt(i);
            } else {
                var cell = row.insertCell(j);
                var x = document.createElement("INPUT");
                x.setAttribute("type", "text");
                x.setAttribute("id", (parseInt(i - 1) + "|" + parseInt(j - 1)));
                x.setAttribute("class", "form-control");
                cell.appendChild(x);
            }
        }
    }

}

const cleantableinput = () => {
    var table = document.getElementById("InputTable");
    table.innerHTML = "";
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
        }
        const data = [trace1]
        Plotly.newPlot('plot', data)
    } catch (err) {
        console.error(err)
        alert(err)
    }
}
</script>


<!-- <style type="text/css">
#ai-div-advanced_iframe {
    height: 5000px;
    overflow: hidden;
    position: relative;
}

#ai-div-inner-advanced_iframe {
    top: -320px !important;
    left: -200px !important;
    position: absolute;
}
</style>
<div id="ai-div-advanced_iframe">
    <div id="ai-div-inner-advanced_iframe">
        <iframe src="https://atozmath.com/CONM/GaussEli.aspx?q=GJ2" width="760" height="5000px" scrolling="no"
            frameborder="0" allowtransparency="true"></iframe>
    </div>
</div> -->