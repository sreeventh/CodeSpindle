<?php
session_start();


if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'codespindle');



if (isset($_POST['create'])) {
    mysqli_query($con, "insert into htop values(NULL , '$_POST[topic]')") or die('Unable to execute query. ' . mysqli_error($con));
    ?>
    <script>
        alert("Topic added successfully!!")
    </script>
    <?php
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>html_page</title>
    <!-- css style sheet -->
    <link rel="stylesheet" href="styles.css">
    <!-- favicon -->
    <link rel="icon" href="images/favicon.ico">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>


<body>
    <!------------------------------------------- nav bar ------------------------------------------------------------>
    <div id="navii" class="navi bg-success">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="home.php">CodeSpindle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="spinny.php">Spinny</a>
                    </li>
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
    <!---------------------------------------------- big device content -------------------------------------------->
    <section id="lgcon">
        <div class="sidebar container-fluid">

            <div class="row flex-nowrap" style="margin-top: 20px; margin-left: 5px; margin-bottom: 20px;">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-success" style="border-radius: 15px;">
                    <div
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">

                        <a href=""
                            class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Html Home</span>
                        </a>

                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">
                            <?php
                            if ($_SESSION['type'] == "admin") {
                                ?>
                                <li class="nav-item">
                                    <a onclick="opa('newtdb')" class="nav-link align-middle px-0" style="cursor: pointer;">
                                        <span class="items ms-1 d-none d-sm-inline">➕</span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>

                            <li>
                                <?php
                                $count = 0;
                                $test = mysqli_query($con, "select * from htop");
                                while ($row = mysqli_fetch_array($test)) {
                                    $count += 1;
                                    ?>
                                    <a href="" class="nav-link px-0 align-middle">
                                        <span class="items ms-1 d-none d-sm-inline">
                                            <?php echo $row['topic'] ?>
                                        </span>
                                    </a>
                                    <?php
                                    if ($_SESSION['type'] == "admin") {
                                        ?>
                                        <a href="dht.php?id=<?php echo $row['htid'] ?>"
                                            style="display: inline-block; padding-left: 50px; cursor: pointer; text-decoration: none;">
                                            <h5>🗑</h5>
                                        </a>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                }
                                ?>
                            </li>
                        </ul>
                        <hr>

                    </div>
                </div>
                <!-- bmain content -->
                <div class="col py-3">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary btn-success disabled">Previous</button>
                        <button type="button" class="btn btn-primary btn-success disabled">Take quiz</button>
                        <button type="button" class="btn btn-primary btn-success">Next</button>
                    </div>
                    <h1>Welcome to Html Tutorials</h1>
                </div>
            </div>
        </div>
    </section>

    <!----------------------------------------- small device content ------------------------------------------------->


    <section id="smcon">
        <div class="smch bg-success">
            <a class="courseHome" href="">Html Home</a>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success" style="padding-left: 10px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">Intro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Tables</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Elements</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>

    <section id="smallMainCon">
        <div>
            <h1>Welcome to Html Tutorials</h1>
        </div>
        <div class="btn-group" role="group" aria-label="Basic example"
            style="position:fixed;bottom:20px;left:0;right:0;padding:20px;">
            <button type="button" class="btn btn-primary btn-success disabled">Previous</button>
            <button type="button" class="btn btn-primary btn-success disabled">Take quiz</button>
            <button type="button" class="btn btn-primary btn-success">Next</button>
        </div>
    </section>


    <div class="container-fluid" id="newtdb" style="position:sticky;left: 100px;bottom:300px; z-index:2;">
        <form id="add_topic" name="add_topic" action="" method="POST"></form>
        <div class="form-group">
            <label for="topic">Add Topic</label>
            <input form="add_topic" type="text" name="topic" class="form-control">
        </div>
        <br>
        <input form="add_topic" type="submit" name="create" value="Create" class="btn btn-dark">
        <button onclick="close1('newtdb')" class="btn btn-danger">Cancel</button>
    </div>

    <script>
        document.getElementById("newtdb").style.display = "none";
        function opa(a) {
            document.getElementById(a).style.display = "block";
            document.getElementById("lgcon").style.opacity = "25%"
            document.getElementById("lgcon").style.zIndex = "-1";

            document.getElementById("navii").style.opacity = "25%"
            document.getElementById("navii").style.zIndex = "-1";
        }
        function close1(a) {
            document.getElementById(a).style.display = "none";
            document.getElementById("lgcon").style.opacity = "initial"
            document.getElementById("lgcon").style.zIndex = "initial";

            document.getElementById("navii").style.opacity = "initial"
            document.getElementById("navii").style.zIndex = "initial";
        }
    </script>




    <!-- ------------------------------------------------------------------------------------------------------------------------------- -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>

</html>