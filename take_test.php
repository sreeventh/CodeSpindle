<?php

session_start();

if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');
mysqli_select_db($con, 'codespindle');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Tests</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <!-------------------------------------------------------- navbar ------------------------------------------------------->
    <div id="navii" class="navi bg-success" style="position:relative;">
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
                        <a class="nav-link" href="html.php">Html</a>
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
                        <a class="nav-link" href="take_test.php">Take Test</a>
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
    <!------------------------------------------------ tests available -------------------------------------------------------------->

    <div id="ttable" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Tests Available</strong>
            </div>

            <div class="card-body ccpd">
                <table class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="font-size: xx-large;">✍</th>
                            <th style="font-size: xx-large;">🕕</th>
                            <th>Take Test</th>
                            <th>Result</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $che = 0;
                        $check = mysqli_num_rows(mysqli_query($con, "select * from tcat where deploy_stat=$che"));
                        $cc = mysqli_num_rows(mysqli_query($con, "select * from tcat"));
                        if ($check == $cc) {
                            ?>
                            <p style="text-align: center; font-size: xx-large; font-weight: lighter;">No Tests Available!
                            </p>
                            <?php
                        } else {
                            $ct = 0;
                            $stat = 1;
                            $res = mysqli_query($con, "select * from tcat where deploy_stat=$stat");
                            while ($row = mysqli_fetch_array($res)) {
                                $tid = $row['tid'];
                                $ct += 1;
                                $att = 0;
                                ?>
                                <tr>
                                    <th>
                                        <?php echo $ct; ?>
                                    </th>
                                    <td>
                                        <?php echo $row['tname'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['tdur'] ?>
                                    </td>
                                    <?php
                                    $rrr = mysqli_query($con, "select * from stud_result where tid = $tid && sid=$_SESSION[id]");
                                    while ($rr = mysqli_fetch_array($rrr)) {
                                        $att = $rr['tstat'];
                                    }
                                    if ($att == 1) {
                                        ?>
                                        <td><a href="take_test.php?tname=<?php echo $row['tname'] ?>" onclick="att()"
                                                style="text-decoration: none; font-size: xx-large; cursor:pointer">🚩</a></td>
                                        <td><a href="results.php?id=<?php echo $tid; ?>"
                                                style="text-decoration: none; font-size: xx-large; cursor:pointer">📜</a></td>
                                        <?php

                                    } else {
                                        ?>

                                        <td><a href="start_test.php?tname=<?php echo $row['tname'] ?>"
                                                style="text-decoration: none; font-size: xx-large; cursor: pointer;">🚩</a></td>
                                        <td><a onclick="resti()"
                                                style="text-decoration: none; font-size: xx-large; cursor:pointer">📜</a></td>
                                        <?php
                                    }

                                    ?>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>

        </div>

    </div>

    <script>
        function resti() {
            alert("Please attempt the quiz!")
        }
        function att() {
            alert("Only one attempt allowed!")
        }
    </script>
    <script>
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };  
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>