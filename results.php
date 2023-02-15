<?php
session_start();

if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'codespindle');

$id = $_GET['id'];

$res1 = mysqli_query($con, "select * from tcat where tname = '$id' ");
while ($rrr = mysqli_fetch_array($res1)) {
    $tt = $rrr['tid'];
}

$res = mysqli_query($con, "select * from tqn where category = '$id' ");
$count = 0;
$correct_answers = 0;

while ($rr = mysqli_fetch_array($res)) {
    $qid = $rr['qid'];
    if (isset($_POST["ans" . $count])) {
        $ans = $_POST["ans" . $count];
        mysqli_query($con, "insert into stud_result values('$tt' , '$qid' , '$_SESSION[id]' , '$ans' , 1 , '$_SESSION[username]')");
        if ($ans == $rr['answer']) {
            $correct_answers++;
        }
    } else {
        mysqli_query($con, "insert into stud_result values('$tt' , '$qid' , '$_SESSION[id]', NULL , 1 , '$_SESSION[username]')");
    }
    $count++;
}

$marks_obtained = $correct_answers;
$total_questions = $count;
$percentage = ($marks_obtained / $total_questions) * 100;

mysqli_query($con , "insert into results values('$_SESSION[id]' , '$id' , '$marks_obtained' , NULL , '$_SESSION[username]' )");

?>

<div id="ttable" class="container-fluid">
    <div class="card">
        <div class="card-header" style="height: 50px;">
            <strong class="card-title" id="ctd" style="color: crimson; font-size: xx-large;">
            </strong>
            <p style="display: inline; float: right; font-size: x-large; font-weight: bolder; font-style: oblique;">
                <?php echo $id ?> Test
            </p>
        </div>

        <div class="card-body ccpd">
            <?php if ($count == 0) { ?>
                <p style="text-align: center; font-size: xx-large; font-weight: lighter;">No Questions Available!</p>
                <script>
                    document.getElementById("ctd").style.display = "none"
                </script>
            <?php } else { ?>
                <p style="text-align: center; font-size: xx-large; font-weight: lighter;">You have scored <?php echo $marks_obtained ?> out of <?php echo $total_questions ?> (<?php echo $percentage ?>%)</p>
                <?php
                $result = mysqli_query($con, "SELECT * FROM tcat WHERE tname='$id'");
                $row = mysqli_fetch_assoc($result);
                $duration = $row['tdur'] * 60;
                ?>
                <p style="text-align: center; font-size: xx-large; font-weight: lighter;">Duration: <?php echo $duration ?> seconds</p>
            <?php } ?>
            <a href="take_test.php" style="text-decoration: none; font-size: xxx-large; cursor: pointer;">↩</a>
        </div>
    </div>
</div>
