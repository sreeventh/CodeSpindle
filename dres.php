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
    <title>Display Results of Tests</title>
    <!-- force refresh stylesheet -->
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <!-- favicon -->
    <link rel="icon" href="images/favicon.ico">
    <title>Document</title>
    <!-- CSS only -->
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
    <!-- ---------------------------------------------results--------------------------------------------- -->
    <div id="ttable" class="container-fluid">
        <div class="card">
            <div class="card-header" style="text-align: center;">
                <strong class="card-title">Results of Students</strong>
            </div>

            <div class="card-body ccpd">
                <table class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Test</th>
                            <th>Score</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $count = 0;
                        $test = mysqli_query($con, "select * from results");
                        while ($row = mysqli_fetch_array($test)) {
                            $count += 1;
                            ?>
                            <tr>
                                <th>
                                    <?php echo $count; ?>
                                </th>
                                <td>
                                    <?php echo $row['uname']; ?>
                                </td>
                                <td>
                                    <?php echo $row['tname']; ?>
                                </td>
                                <td>
                                    <?php echo $row['marks']; ?>
                                </td>

                            </tr>
                            <?php

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</html>