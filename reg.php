<?php

session_start();
//header('location:index.php');
$con = mysqli_connect('localhost','root');
// if($con){
//     echo "conn success <br>";
// }
// else{
//     echo "conn not success";
// }

mysqli_select_db($con,'codespindle');

$username = $_POST['username'];
$password = $_POST['password'];
$rpass = $_POST['rpassword'];

if($password==$rpass){
$q = " select * from signin where username='$username' && password='$password' ";
$result = mysqli_query($con,$q);

$num_of_same_users = mysqli_num_rows($result);

if($num_of_same_users == true){
    echo "You are already a user!";
}
else{
    $qy = "insert into signin(username , password) values ('$username' , '$password') ";
    mysqli_query($con,$qy);
}
}
else{
    header('location:index.php');
}

?>
    

    
