<body onload="CreateTable(text1.value);">
    <h1>Gauss Elimination</h1>
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <label for="text1">input 'n' Create table input</label>
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
                    <div>
                        <label for="InputTable">Table Input</label>
                        <table id="InputTable"></table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="getdata()">ENTER</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
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

        </div>
    </div>

</body>


<script>
const getdata = () => {
    n = document.getElementById("text1").value;
    var arr = [];
    for (i = 0; i < n; i++) {
        arr.push([]);
        for (j = 0; j <= n; j++) {
            arr[i].push(document.getElementById(i + "|" + j).value);
        }
    }
    //call Gauss หลังจากได้ข้อมูล
    Gauss_Elimination(arr);
}

const Gauss_Elimination = (arr) => {
    var n = arr.length;
    var m = parseInt(n) + 1;
    var table = document.getElementById("output");
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    //ทำลง
    for (i = 0; i < (n - 1); i++) {
        for (j = i; j < n - 1; j++) {
            var temp = arr[i][i];
            var temp2 = arr[parseInt(j) + 1][i];
            for (k = i; k < m; k++) {
                if (isFinite(arr[j][k] / temp * temp2)) {
                    arr[parseInt(j) + 1][k] = arr[parseInt(j) + 1][k] - (arr[i][k] / temp *
                        temp2);
                }
            }
        }
    }
    // หาคำตอบ
    var result = [];
    for (i = n - 1; i >= 0; i--) {
        //ย้ายข้างไปลบ
        for (j = n - 1; j > i; j--) {
            arr[i][n] = arr[i][n] - arr[i][j];
        }
        //ย้ายไปหาร
        if (isFinite(arr[i][n] / arr[i][i])) {
            result.push(arr[i][n] / arr[i][i]);
        } else {
            result.push(0);
        }
        for (j = i - 1; j >= 0; j--) {
            //เอาคำตอบไปคูณ
            arr[j][i] = result[parseInt(n) - 1 - parseInt(i)] * arr[j][i];
        }
    }

    console.log("--------");
    for (i = 0; i < n; i++) {
        for (j = 0; j < m; j++) {
            console.log(arr[i][j]);
        }
    }
    console.log("-------------");
    for (i = 0; i < n; i++) {
        console.log(result[i]);
    }
    //add data table
    var num = 1;
    for (i = n - 1; i >= 0; i--) {
        var row = table.insertRow(num);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.setAttribute("id", "cell");
        cell2.setAttribute("id", "cell");
        cell1.innerHTML = "X | " + num + ":    ";
        cell2.innerHTML = result[i];
        num++;
    }
    /*do{

    		x = x1-((funcal(x1,expression)*(x1-x0))/(funcal(x1,expression)-funcal(x0,expression)));
    		check = Math.abs((x-x1)/x).toFixed(8);
    		console.log(check);
    		n++;
    		console.log(n);
    		// Create an empty <tr> element and add it to the 1st position of the table:
    		var row = table.insertRow(n);

    		// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    		var cell1 = row.insertCell(0);
    		var cell2 = row.insertCell(1);
    		var cell3 = row.insertCell(2);

    		// Add some text to the new cells:
    		cell1.innerHTML = n;
    		cell2.innerHTML = x;
    		cell3.innerHTML = check;
    		x0 = x1;
    		x1 = x;

    }while(check>0.00001 && n<100)*/

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

const CreateTable = (n) => {
    var table = document.getElementById("InputTable");
    console.log(document.getElementById("InputTable").getElementsByTagName("tr").length)
    if (document.getElementById("InputTable").getElementsByTagName("tr").length > 0) {
        cleantableinput();
    }

    var row = table.insertRow(0);
    for (i = 0; i <= n; i++) {
        if (i == 0) {
            var cell = row.insertCell(i);
            cell.innerHTML = "";
        } else {
            if (i == parseInt(n)) {
                var cell = row.insertCell(i);
                cell.innerHTML = "Y";
            }
            var cell = row.insertCell(i);
            cell.innerHTML = "X" + parseInt(i - 1);
        }
    }
    for (i = 1; i <= n; i++) {
        var row = table.insertRow(i);
        for (j = 0; j <= parseInt(n) + 1; j++) {
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


<!-- <div><a href="https://planetcalc.com/3566/" data-lang="en" data-code=""
        data-colors="#263238,#435863,#090c0d,#fa7014,#fb9b5a,#c25004" data-v="3342"></a>
    <script src="https://embed.planetcalc.com/widget.js?v=3342"></script>
</div> -->