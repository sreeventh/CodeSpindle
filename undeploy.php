<?php
session_start();


if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'codespindle');

$id = $_POST['ttid'];
$stat = 0;
mysqli_query($con, "update tcat set deploy_stat = $stat where tid = $id ") or die('Unable to execute query. ' . mysqli_error($con));
?>
<script>
    alert("Test Killed!")
    window.location.href="set_test.php"
</script>
<?php
?>