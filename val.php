<?php
// starting session
session_start();
// connecting to local host ... root is device name
$con = mysqli_connect('localhost','root');
// checking conn
if($con){
    echo "conn success <br>";
}
else{
    echo "conn not success";
}
// conn to db
mysqli_select_db($con,'codespindle');

// collect data from form
$username = $_POST['username'];
$password = $_POST['password'];
// passing query 
$q = " select * from signin where username='$username' && password='$password' ";
// firing query
$result = mysqli_query($con,$q);
$row = mysqli_fetch_assoc($result);
if($row==true){
    $_SESSION['username'] = $row['username'];
    $_SESSION['type'] = $row['type'];
    header('location:home.php');
}
else{
    header('location:index.php');
}



?>
