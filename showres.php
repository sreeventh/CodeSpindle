<?php
session_start();

if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'codespindle');
$id = $_GET['id'];
$res1 = mysqli_query($con , "select * from tcat where tid = '$id'");
while($rr1=mysqli_fetch_array($res1)){
    $tn = $rr1['tname'];
}

$res = mysqli_query($con , "select * from results where sid = '$_SESSION[id]' && tname = '$tn' ");
while($rr=mysqli_fetch_array($res)){
    $tname = $rr['tname'];
    $marks = $rr['marks'];
    $sname = $rr['uname'];
}

echo "score is $marks for test: $tname.";
?>
<h1><a href="take_test.php">HOME</a></h1>