<body onload="CreateTable(text1.value);">
    <h1>Gauss-Jordan Method</h1>
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
// สร้างตาราง
const CreateTable = (n) => {
    var table = document.getElementById("InputTable");
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



//รับข้อมูลที่กรอกแล้ว
const getdata = () => {
    n = document.getElementById("text1").value;
    var arr = [];
    for (i = 0; i < n; i++) {
        arr.push([]);
        for (j = 0; j <= n; j++) {
            arr[i].push(document.getElementById(i + "|" + j).value);
        }
    }
    // Gauss หลังจากได้ข้อมูล
    Gauss_Jordan(arr);
}

const Gauss_Jordan = (arr) => {
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
                    arr[parseInt(j) + 1][k] = arr[parseInt(j) + 1][k] - (arr[i][k] / temp * temp2);
                }
            }
        }
    }
    // หาคำตอบ
    for (i = (n - 1); i > 0; i--) {
        for (j = i; j > 0; j--) {
            var temp = arr[i][i];
            var temp2 = arr[j - 1][i];
            console.log("do");
            //ทำแค่ขวาสุด
            arr[parseInt(j) - 1][n] = arr[parseInt(j) - 1][n] - (arr[i][n] / temp * temp2)
            for (k = i; k >= 0; k--) {
                arr[parseInt(j) - 1][k] = arr[parseInt(j) - 1][k] - (arr[i][k] / temp * temp2);
            }
        }
    }
    var result = [];
    for (i = n - 1; i >= 0; i--) {
        if (isFinite(arr[i][n] / arr[i][i])) {
            result.push(arr[i][n] / arr[i][i]);
        } else {
            result.push(0);
        }
    }
    var num = 1;
    for (i = n - 1; i >= 0; i--) {
        var row = table.insertRow(num);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.setAttribute("id", "cell");
        cell2.setAttribute("id", "cell");
        cell1.innerHTML = "X|" + num + ":    ";
        cell2.innerHTML = result[i];
        num++;
    }
}

//ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
}


const cleantableinput = () => {
    var table = document.getElementById("InputTable");
    table.innerHTML = "";
}
</script>