<?php
session_start();


if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'codespindle');

$id = $_GET['id'];
$res = mysqli_query($con, "select * from tqn where category = '$id' ");
$count = 0;
while($rr=mysqli_fetch_array($res)){
    echo $rr['qun'];
    echo $_POST["ans" . $count];
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