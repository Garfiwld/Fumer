<!-- <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Fumer</div>
    <div class="list-group list-group-flush">
        <a href="index.php?page=Bisection" class="list-group-item list-group-item-action bg-light">Bisection</a>
        <a href="index.php?page=Newton-raphson-Method"
            class="list-group-item list-group-item-action bg-light">Newton-raphson-Method</a>
        <a href="index.php?page=Secant-Method" class="list-group-item list-group-item-action bg-light">Secant-Method</a>
        <a href="index.php?page=" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="index.php?page=" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="index.php?page=" class="list-group-item list-group-item-action bg-light">Status</a>
    </div>
</div>
<div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav> -->


<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Fumer</h3>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#rootSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">ROOT OF
                    EQUATION</a>
                <ul class="collapse list-unstyled" id="rootSubmenu">
                    <li>
                        <a href="index.php?page=Bisection-Method">Bisection Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=False-position-Method">False position Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=One-point-iteration-Method">One-point iteration Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=Newton-raphson-Method">Newton raphson Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=Secant-Method">Secant Method</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#matirxSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">MATRIX
                    ALGEBRA</a>
                <ul class="collapse list-unstyled" id="matirxSubmenu">
                    <li>
                        <a href="index.php?page=Cramer-s-Rule">Cramer's Rule</a>
                    </li>
                    <li>
                        <a href="index.php?page=Gauss-Elimination-Method">Gauss Elimination Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=Gauss-Jordan-Method">Gauss-Jordan Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=Matrix-Inversion-Method">Matrix Inversion Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=LU-Decomposition-Method">LU Decomposition Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=Cholesky-Decomposition-Method">Cholesky Decomposition Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=Jacobi-Iteration-Method">Jacobi Iteration Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=Gauss-Seidel-Method">Gauss-Seidel Method</a>
                    </li>
                    <li>
                        <a href="index.php?page=Conjugate-Gradient-Method">Conjugate Gradient Method</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>
            </div>
        </nav>
        <?php 
            error_reporting(0);
            switch ($_GET["page"]) {
            //ROOT-OF-EQUATION
            case "Bisection-Method":
                include("ROOT-OF-EQUATION\Bisection-Method.php");
                break;
            case "Newton-raphson-Method":
                include("ROOT-OF-EQUATION\Newton-raphson-Method.php");
                break;
            case "Secant-Method":
                include("ROOT-OF-EQUATION\Secant-Method.php");
                break;
            case "False-position-Method":
                include("ROOT-OF-EQUATION\False-position-Method.php");
                break;
            case "One-point-iteration-Method":
                include("ROOT-OF-EQUATION\One-point-iteration-Method.php");
                break;
            //MATRIX-ALGEBRA
            case "LU-Decomposition-Method":
                include("MATRIX-ALGEBRA\LU-Decomposition-Method.php");
                break;
            case "Cramer-s-Rule":
                include("MATRIX-ALGEBRA\Cramer-s-Rule.php");
            break;
            case "Gauss-Elimination-Method":
                include("MATRIX-ALGEBRA\Gauss-Elimination-Method.php");
                break;
            case "Gauss-Jordan-Method":
                include("MATRIX-ALGEBRA\Gauss-Jordan-Method.php");
                break;
            case "Matrix-Inversion-Method":
                include("MATRIX-ALGEBRA\Matrix-Inversion-Method.php");
                break;
            case "":
                include("MATRIX-ALGEBRA\.php");
                break;

            default:
                include("ROOT-OF-EQUATION\Bisection-Method.php");
            }
        ?>

    </div>
</div>