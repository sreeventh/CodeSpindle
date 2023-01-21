<?php
session_start();


if(!isset($_SESSION["username"]))
{
    header('location: index.php');
}

$con = mysqli_connect('localhost' , 'root');

mysqli_select_db($con,'codespindle');

if(isset($_POST["create"])){
    $tdata = "insert into tcat values (NULL , '$_POST[tname]' , '$_POST[ttime]') ";
    $update_result = mysqli_query( $con , $tdata ) or die ('Unable to execute query. '. mysqli_error($con));
    ?>
    <script>
        alert("Test added successfully");
        window.location.href = window.location.href;
    </script>
    <?php
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta
        name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Set Test</title>
        <!-- force refresh stylesheet -->
        <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
        <!-- favicon -->
        <link rel="icon" href="images/favicon.ico">
        <title>Document</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    </head>
    <body>
        <!-------------------------------------------------------- navbar ------------------------------------------------------->
        <div id="navii" class="navi bg-success" style="position:relative;">
            <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                <a class="navbar-brand" href="home.php">CodeSpindle</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
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
                    if($_SESSION['type']=="admin"){
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

                            <a href="" class="text-white text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
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
 
        <!--------------------------------------------------------- add new test -------------------------------------------------------->
        <section id="setest" style="position:relative;">
            <div class="container-fluid">
                    <button onclick="opa('newtdb')" class="btn btn-primary btn-lg btn-dark" style="margin-top: 15px;">
                        Create New Test
                    </button>
            </div>

            <div id="ttable" class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Current Tests</strong>
                    </div>

                    <div class="card-body ccpd">
                        <table class="table table-bordered" style="text-align: center;">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Add Qun</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $count=0;
                                    $test = mysqli_query($con, "select * from tcat");
                                    while($row = mysqli_fetch_array($test)){
                                        $count+=1;
                                        ?>
                                        <tr>
                                            <th><?php echo $count; ?></th>
                                            <td><?php echo $row['tname']; ?></td>
                                            <td><?php echo $row['tdur']; ?></td>
                                            <td><a href="test_qun.php? id=<?php echo $row['tid']; ?>" style="text-decoration: none; color:green; font-size: xx-large; ;">+</a></td>
                                            <td><a href="editt.php? id=<?php echo $row['tid']; ?>" style="text-decoration: none; color:orange">✏</a></td>
                                            <td><a href="delcont.php? id=<?php echo $row['tid']; ?>" style="text-decoration: none; color:crimson">❌</a></td>
                                        </tr>    
                                        <?php
                                        
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!------------------------------------------------ dialog box for new test --------------------------------------------------------------------->
        
        <div class="container" id="newtdb" style="position:relative;bottom:450px;z-index:2;">
            <form id="newtf" name="newtf" action="set_test.php" method="POST" onsubmit="return nullw()"></form>
                <div class="form-group">
                    <label for="tname">Test Name</label>
                    <input form="newtf" type="text" name="tname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ttime">Duration</label>
                    <input form="newtf" type="number" name="ttime" placeholder="(in min)" class="form-control">
                </div>
                <br>
                <input form="newtf" type="submit" name="create" value="Create" class="btn btn-dark">
                <button onclick="close1('newtdb')" class="btn btn-danger">Cancel</button>
        </div>

        <script>
            document.getElementById("newtdb").style.display = "none";
            
            function opa(a) {
                document.getElementById(a).style.display = "block";
                document.getElementById("setest").style.opacity = "20%";
                document.getElementById("navii").style.opacity = "20%";
                document.getElementById("setest").style.zIndex = "-1";
                document.getElementById("navii").style.zIndex = "-1";

            }
            function close1(a) {
                document.getElementById("setest").style.opacity = "initial";
                document.getElementById("navii").style.opacity = "initial";
                document.getElementById("setest").style.zIndex = "initial";
                document.getElementById("navii").style.zIndex = "initial";
                document.getElementById(a).style.display = "none";

            }

            function nullw(){
                let name = document.newtf.tname;
                let dur = document.newtf.ttime;
                if(name.value.length<=0){
                    alert('Enter Test Name please!');
                    name.focus();
                    return false;
                }
                if(dur.value.length<=0){
                    alert('Enter Test Duration please!');
                    dur.focus();
                    return false;
                }
                return true;
            }
        </script>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>
</html>
