<h1>Euler's method</h1>

<body onload="Euler(); draw();">
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
                                <label for="text2">Start X</label>
                                <input type="text" class="form-control" id="text2" placeholder="1" value="1">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text3">End X</label>
                                <input type="text" class="form-control" id="text3" placeholder="5" value="5">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text4">Y(0)</label>
                                <input type="text" class="form-control" id="text4" placeholder="5" value="5">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text5">H</label>
                                <input type="text" class="form-control" id="text5" placeholder="5" value="5">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text6">input Real Equal</label>
                                <input type="text" class="form-control" id="text6" placeholder="5" value="5">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                        onclick="Euler(); draw(); ">ENTER</button>
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
                            <th width="20%">Currentx</th>
                            <th width="30%">Y</th>
                            <th width="30%">realY</th>
                            <th width="30%">error</th>
                        </tr>
                        <tr class="list-data">
                            <td width="20%" id="Currentx" style="text-align: center;"></td>
                            <td width="30%" id="Y"></td>
                            <td width="30%" id="realY"></td>
                            <td width="30%" id="error"></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
const Euler = () => {
    var table = document.getElementById("output");
    var expression = document.getElementById("text1").value;
    var startx = document.getElementById("text2").value;
    var endx = document.getElementById("text3").value;
    var y = document.getElementById("text4").value;
    var h = document.getElementById("text5").value;
    var rexpression = document.getElementById("text6").value;

    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    var error = 0;
    y = parseFloat(y);
    h = parseFloat(h);
    startx = parseFloat(startx);
    var currentx = startx;
    var realy, check = 0,
        n = 0;
    var arrayX = [],
        arrayY = [],
        arrayRY = [],
        arrayX2 = [];

    arrayX.push(currentx);
    arrayY.push(y);

    realy = funcal(currentx, rexpression);
    arrayX2.push(currentx);
    arrayRY.push(realy);

    while (currentx <= endx) {
        n++;

        y = y + funcalXY(currentx, y, expression) * h;
        realy = funcal(currentx + h, rexpression);

        check = Math.abs(y - realy);
        arrayX2.push(currentx + h);
        arrayX.push(currentx + h);
        arrayY.push(y);
        arrayRY.push(realy);

        // Create an empty <tr> element and add it to the 1st position of the table:
        var row = table.insertRow(n);

        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);

        // Add some text to the new cells:
        cell1.setAttribute("id", "cell");
        cell2.setAttribute("id", "cell");
        cell3.setAttribute("id", "cell");
        cell4.setAttribute("id", "cell");

        cell1.innerHTML = currentx;
        cell2.innerHTML = y;
        cell3.innerHTML = realy;
        cell4.innerHTML = check;


        currentx = currentx + h;


    }
    draw(arrayX, arrayY, arrayRY, arrayX2);
}
/*const test2 = () => {
		var expression = document.getElementById("text1").value;
		console.log(test(2,3,expression));

	}
*/

//แก้ x และ y
const funcalXY = (X, Y, expression) => {
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X),
        y: parseFloat(Y)
    };
    return expr.eval(scope);
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
}

//การวาดที่จะไปใส่ใน plot
const draw = (x, y, realy, x2) => {
    try {
        const data = [{
            x: x2,
            y: realy,
            name: 'Real'
        }, {
            x: x,
            y: y,
            name: 'Euler'
        }]
        Plotly.newPlot(plot, data, {
            margin: {
                t: 0
            }
        });
    } catch (err) {
        console.error(err)
        alert(err)
    }
}
</script>



<!-- <style type="text/css">
#ai-div-advanced_iframe {
    height: 1300px;
    overflow: hidden;
    position: relative;
}

#ai-div-inner-advanced_iframe {
    top: -210px !important;
    position: absolute;
}
</style>
<div id="ai-div-advanced_iframe">
    <div id="ai-div-inner-advanced_iframe">
        <iframe src="https://keisan.casio.com/exec/system/1392171850" width="760px" height="1500px" scrolling="no"
            frameborder="0" allowtransparency="true"></iframe>
    </div>
</div> -->

<!-- <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="https://www.desmos.com/calculator/utbwaotlpj" freamborder="0"
        allowfullscreaen></iframe>
</div> -->