<h1>Jacobi Iteration Method</h1>
<!-- <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
    asciimath2jax: {
      delimeters:  [ ['`','`'] ]
    },
    tex2jax: {
      inlineMath:  [ ['$','$'],   ['\\(','\\)'] ],
      displayMath: [ ['$$','$$'], ['\\[','\\]'] ]
    }
  });
</script>
<script type="text/javascript" async
    src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-MML-AM_HTMLorMML-full">
</script>
<script type="text/javascript" src="http://math.utoledo.edu/~codenth/Scripts/MatrixMathJax.js"></script>
<script type="text/javascript" src="http://math.utoledo.edu/~codenth/Scripts/BoilerPlate.js"></script>

<script language="JavaScript" type="text/javascript">

// The calculations are all done by functions from 'MatrixMath.js'.
// The conversion from ASCII and/or LaTeX to MathML is done by
// functions from 'ASCIIMathML.js'.

// Global variables to store data in.
var problem = new Object;
var A = new Matrix()
var B = new Matrix()
var Q = new Matrix()
var R = new Matrix()

function initialize_page() {
    // Initialize the matrix size and get a random matrix.
    document.getElementById("matrix_size").selectedIndex = 1
    new_matrix()
}

function get_size() {
    var select_size = document.getElementById("matrix_size");
    problem.matrix_size = select_size.selectedIndex + 2;
}

function get_pos1() {
    var pos1_num = document.getElementById("pos1");
    problem.pos1 = parseInt(pos1_num.value);
}

function get_pos2() {
    var pos2_num = document.getElementById("pos2");
    problem.pos2 = parseInt(pos2_num.value);
}

function new_matrix() {
    // Generate a new matrix.
    // Maybe we should allow for noninteger values.
    get_size()
    var n = problem.matrix_size

    // We'll choose the type of matrix randomly.
    var p = ran(0, 1)

    switch (p) {
        // Symmetric with nice eigenvalues.
        case 0:
            var X = nonsingular_matrix(n, n, -99, 99).div(100)
            var P = X.qr()[0]

            // Eigenvalues in tenths or hundreths.
            var q = ran(0, 1)
            switch (q) {
                case 0:
                    var E = random_vector(n, -9, 9)
                    for (var k = 1; k < n; k++) {
                        while (E[k] == 0) {
                            E[k] = ran(-9, 9)
                        }
                    }
                    E = E.div(10)
                    break

                default:
                    var E = random_vector(n, -99, 99)
                    for (var k = 1; k < n; k++) {
                        while (E[k] == 0) {
                            E[k] = ran(-99, 99)
                        }
                    }
                    E = E.div(100)
                    break

            }
            var D = E.diagonal()

            A = P.mul(D.mul(P.transpose()))
            break

            // Symmetric with not so nice eigenvalues.
        default:
            var X = nonsingular_matrix(n, n, -9, 9).div(10)
            A = X.mul(X.transpose())
            break
    }


    // Store the matrix in the calculator input text field.
    document.getElementById('in1').value = A.jscript()

    // Format the display of the matrix and
    // reset the pos1 and pos2 selection fields.
    reset()
}

// The next function was taken (and modified) from ASCIIMathML.js
// Version 2.0.1 Sept 27, 2007, (c) Peter Jipsen
// http://www.chapman.edu/~jipsen
function alter_matrix(inputId, outputId) {
    var str = document.getElementById(inputId).value;
    var err = "";
    var ind = str.lastIndexOf("\n");
    if (ind == str.length - 1) str = str.slice(0, ind);
    str = str.slice(str.lastIndexOf("\n") + 1);

    try {
        var res = eval(str)
    } catch (e) {
        err = "syntax incomplete"
    }

    if (str != "") str = "`" + str + "`"

    var outnode = document.getElementById(outputId);
    var n = outnode.childNodes.length;
    for (var i = 0; i < n; i++)
        outnode.removeChild(outnode.firstChild);
    outnode.appendChild(document.createTextNode(str));
    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);

    A = new Matrix(res)
    B = A.copy()
}

function rotate() {
    R = B.jacobi(problem.pos1 - 1, problem.pos2 - 1)
    B = R.transpose().mul(B.mul(R))
    Q = Q.mul(R);

    var outnode = document.getElementById('out1')
    outnode.innerHTML = "` B = " + B.ascii(12) + " ` "

    var outnode = document.getElementById('out2')
    outnode.innerHTML = "`Q = " + Q.ascii(12) + "`"
    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
}

function sweep() {
    var n = A.length
    for (var i = 1; i < n; i++) {
        for (var j = i + 1; j < n + 1; j++) {
            problem.pos1 = i
            problem.pos2 = j
            rotate()
        }
    }
}

function reset() {
    // Reset B and Q.
    Q = eye(problem.matrix_size)
    B = A.copy()

    get_pos1()
    get_pos2()

    // Reset display.
    var outnode = document.getElementById('out0')
    outnode.innerHTML = "`A=" + A.ascii(12) + "`"

    var outnode = document.getElementById('out1')
    outnode.innerHTML = "`B =" + B.ascii(12) + "`"

    var outnode = document.getElementById('out2')
    outnode.innerHTML = "`Q =" + Q.ascii(12) + "`"
    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);

}


</script>

<p class="calculator">
    Either choose a size
    <select id="matrix_size" size="1" onchange="get_size()">
        <option value="2" selected="selected">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    and press this button
    <input type="button" value="new matrix" onclick="new_matrix()" />
    to get a randomly generated matrix,
    or enter your matrix in the box below.
    (Look at the example to see the format.)
</p>

<p>
    Matrix `A`:<br />
    <textarea id="in1" rows="2" cols="70" onkeyup="alter_matrix('in1','out1')">

</textarea>
</p>
<p><span id="out0"></span></p>
<p><span id="out1"></span></p>
<p><span id="out2"></span></p>

<p style="margin:15pt 0 15pt 0pt">
    <input type="button" value="rotate" name="rotate" onclick="rotate('out1')"
        style="margin:0pt 10pt; padding:0 20pt" />
    Perform a <b>Jacobi rotation</b> about positions <input type="text" id="pos1" size="1" onkeyup="get_pos1()"
        style="margin:0 0 0 2pt" /> </input>
    and <input type="text" id="pos2" size="1" onkeyup="get_pos2()" /> </input>
</p>

<p>
    <input type="button" value="sweep" name="sweep" onclick="sweep()" style="margin:0pt 10pt; padding:0 20pt" />
    Perform, in sequence, a rotation for each possible choice of positions.
</p>

<p>
    <input type="button" value="reset" name="reset" onclick="reset()" style="margin:0pt 10pt; padding:0 23pt" />
    The reset button leaves the `A` matrix alone, but restarts the algorithm
    from the beginning with `B=A` and `Q=I.`
</p> -->

<style type="text/css">
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
</div>