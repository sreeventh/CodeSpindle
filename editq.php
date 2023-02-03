<?php
session_start();
$con = mysqli_connect('localhost', 'root');
mysqli_select_db($con,'codespindle');

$qid = $_GET['qid'];
$id = $_GET['id'];

$res = mysqli_query($con , "select * from tqn where qid=$qid ");
while($row = mysqli_fetch_array($res)){
    $qun = $row["qun"];
    $opt1 = $row["opt1"];
    $opt2 = $row["opt2"];
    $opt3 = $row["opt3"];
    $opt4 = $row["opt4"];
    $ans = $row["answer"];
}

if(isset($_POST["uqn"])){
    $uqnt = "update tqn set qun = '$_POST[qname]' , opt1 = '$_POST[op1]' , opt2 = '$_POST[op2]' , opt3 = '$_POST[op3]' , opt4 = '$_POST[op4]' , answer = '$_POST[ans]' where qid = $qid ";
    $update_result = mysqli_query( $con , $uqnt ) or die ('Unable to execute query. '. mysqli_error($con));
    ?>
    <script>
        alert("Question Updated Successfully")
        window.location.href = "test_qun.php?id=<?php echo $id; ?>";
    </script>
    <?php
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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

                        <a href="" class="text-white text-decoration-none" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="nav-link">Profile</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="">Settings</a></li>
                            <li><a class="dropdown-item" href="">User Details</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>

                    </li>

                </ul>
            </div>
        </nav>
    </div>
    
    <!--------------------------------------------------------------- edit qun ----------------------------------->
    
    <div class="container_fluid">
        <div class="card">
            <div class="card-header" style="text-align:center;">
                <strong class="card-title">Edit Quesion</strong>
            </div>

            <div class="card-body ccpd">
                <form id="uqf" action="" method="post"></form>
                <div class="form-group">
                    <label for="qname" style="font-size: large; font-weight: bold;">Question</label>
                    <textarea cols="30" rows="10" form="uqf" type="text" name="qname" class="form-control"><?php echo $qun ?></textarea>
                </div>
                <div class="form-group">
                    <label for="op1" style="font-size: large; font-weight: bold;">Option 1</label>
                    <textarea cols="10" rows="2" form="uqf" type="text" name="op1" class="form-control"><?php echo $opt1 ?></textarea>
                </div>
                <div class="form-group">
                    <label for="op2" style="font-size: large; font-weight: bold;">Option 2</label>
                    <textarea cols="10" rows="2" form="uqf" type="text" name="op2" class="form-control"><?php echo $opt2 ?></textarea>
                </div>
                <div class="form-group">
                    <label for="op3" style="font-size: large; font-weight: bold;">Option 3</label>
                    <textarea cols="10" rows="2" form="uqf" type="text" name="op3" class="form-control"><?php echo $opt3 ?></textarea>
                </div>
                <div class="form-group">
                    <label for="op4" style="font-size: large; font-weight: bold;">Option 4</label>
                    <textarea cols="10" rows="2" form="uqf" type="text" name="op4" class="form-control"><?php echo $opt4 ?></textarea>
                </div>
                <div class="form-group">
                    <label for="ans" style="font-size: large; font-weight: bold;">Answer</label>
                    <textarea cols="10" rows="2" form="uqf" type="text" name="ans" class="form-control"><?php echo $ans ?></textarea>
                </div>
                <br>
                <input form="uqf" type="submit" name="uqn" value="Update Qun" class="btn btn-dark">
                <a href="test_qun.php?id=<?php echo $id; ?>"><button class="btn btn-danger">Cancel</button></a>
                </form>
            </div>

        </div>

    </div>
    
    
    
    
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>