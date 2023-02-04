<?php
    session_start();


    if (!isset($_SESSION["username"])) {
        header('location: index.php');
    }
    
    $con = mysqli_connect('localhost', 'root');
    
    mysqli_select_db($con, 'codespindle');

$id = $_GET['id'];


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
        localStorage.removeItem("timer-"+<?php echo $id; ?>)
    </script>
    better luck next tym :)
</body>
</html>

