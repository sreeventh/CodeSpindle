<?php
session_start();
$con = mysqli_connect('localhost', 'root');
mysqli_select_db($con, 'codespindle');

$id = $_GET['id'];

$res = mysqli_query($con, "select * from tcat where tid = $id");
while ($row = mysqli_fetch_array($res)) {
    $ename = $row["tname"];
}

function del()
{
    $con = mysqli_connect('localhost', 'root');
    mysqli_select_db($con, 'codespindle');
    // query must always be in double quotes!
    $id = $_GET['id'];
    mysqli_query($con, "delete from tcat where tid = $id");
    ?>
    <script>
        window.location.href = "set_test.php"
    </script>

    <?php
}

if (array_key_exists('delbtn', $_POST)) {
    del();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <!-- css boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Delete Test</title>
</head>

<body>
    <!-------------------------------------------------------- navbar ------------------------------------------------------->
    <div class="navi bg-success">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="home.php">CodeSpindle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="java.php">Java</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="html.html">Html</a>
                    </li>
                    <?php
                    if ($_SESSION['type'] == "admin") {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="set_test.php">Set Test</a>
                        </li>
                        <?php
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="take_test.html">Take Test</a>
                    </li>

                    <li>

                        <a href="" class="text-white text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="nav-link">Profile</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li>
                                <a class="dropdown-item" href="">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="">User Details</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php">Sign out</a>
                            </li>
                        </ul>

                    </li>

                </ul>
            </div>
        </nav>
    </div>

    <div class="container" id="newtdb" style="position:fixed; top: 10%; bottom: 0; left: 0; right: 0;">
        <form id="delform" method="post"></form>
        <h5>Delete Test->
            <?php echo $ename ?>
        </h5>
        <input form="delform" type="submit" class="btn btn-dark" name="delbtn" value="yes">
        <button onclick="location.href='set_test.php'" class="btn btn-danger">no</button>
    </div>


    <!-- javascript boot -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>

</html>