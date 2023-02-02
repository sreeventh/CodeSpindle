<?php
session_start();


if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'codespindle');

$id = $_POST['tid'];
$res = mysqli_query($con, "select * from tcat where tid=$id");
while ($rr = mysqli_fetch_array($res)) {
    $ds = $rr['deploy_stat'];
}
$stat = 1;
if ($ds == 1) {
    ?>
    <script>
        alert("Test already Deployed")
        window.location.href="set_test.php"
    </script>
    <?php
} else {
    mysqli_query($con, "update tcat set deploy_stat = $stat where tid = $id ") or die('Unable to execute query. ' . mysqli_error($con));
    ?>
    <script>
        alert("Deployed Successfully");
        window.location.href = "set_test.php";
    </script>
    <?php

}
?>