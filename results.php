<?php
session_start();


if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

echo $_SESSION['username'];

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'codespindle');
// here id is tname
$id = $_GET['id'];
$res1 = mysqli_query($con, "select * from tcat where tname = '$id' ");
while($rrr=mysqli_fetch_array($res1)){
    $tt = $rrr['tid'];
}
$res = mysqli_query($con, "select * from tqn where category = '$id' ");
$count = 0;
while($rr=mysqli_fetch_array($res)){
    $qid = $rr['qid'];
    if (isset($_POST["ans" . $count])){
        $ans = $_POST["ans" . $count];
        mysqli_query($con , "insert into stud_result values('$tt' , '$qid' , '$_SESSION[username]' , '$ans' , 1)");
    } 
    else{
        mysqli_query($con , "insert into stud_result values('$tt' , '$qid' , '$_SESSION[username]', NULL , 1)");
    }
    $count++;
}




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>





    <script>
        localStorage.removeItem("timer-" +<?php echo $id; ?>)
    </script>
</body>

</html>