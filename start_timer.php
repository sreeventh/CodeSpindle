<?php
session_start();
if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');
mysqli_select_db($con, 'codespindle');

$test = $_GET['test'];
$_SESSION['test'] = $test;

$res = mysqli_query($con, "select * from tcat where tname = '$test' ");
while($row=mysqli_fetch_assoc($res)){
    $_SESSION["tdur"] = $row["tdur"];
}

$date = date("Y-m-d H:i:s");
$_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date . " + $_SESSION[tdur] minutes"));
$_SESSION["test_start"] = "yes";

?>


