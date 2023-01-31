<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Test Qun</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <!-- favicon -->
        <link rel="icon" href="images/favicon.ico">
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
    <?php

        session_start();
        $con = mysqli_connect('localhost' , 'root');
        mysqli_select_db($con,'codespindle');

        $id = "";
        $ename = "";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
        return;
        }
        $res = mysqli_query($con , "select * from tcat where tid = $id");
        while($row = mysqli_fetch_assoc($res)){
            $ename  = $row["tname"];
        }

        if(isset($_POST["aqn"])){
            $loop=0;
            $count=0;

            $res = mysqli_query($con , "select * from tqn where category='$ename' order by qid asc ") or die(mysqli_error($con));
            $count = mysqli_num_rows($res);

            if($count==0){

            }
            else{
                while($row = mysqli_fetch_array($res)){
                    $loop+=1;
                    mysqli_query($con, "update tqn set question_no='$loop' where qid='"+$row['qid']+"'");
                }
            }
            $loop+=1;
            mysqli_query($con , "insert into tqn(question_no , qun , opt1, opt2 , opt3 , opt4 , answer , category) values ('$loop' , '$_POST[qname]' , '$_POST[op1]' , '$_POST[op2]' , '$_POST[op3]' , '$_POST[op4]' , '$_POST[ans]' , '$ename' )") or die(mysqli_error($con)) ;

            ?>
            <script>
                alert('Question added!')
                window.location.href=window.location.href
            </script>
            <?php
        }

        ?>

        <?php
        if(isset($_POST["aqni"])){
        $loop=0;
        $count=0;

        $res = mysqli_query($con , "select * from tqn where category='$ename' order by qid asc ") or die(mysqli_error($con));
        $count = mysqli_num_rows($res);

        if($count==0){

        }
        else{
            while($row = mysqli_fetch_array($res)){
                $loop+=1;
                mysqli_query($con, "update tqn set question_no='$loop' where qid='$row[qid]'  ");
            }
        }
        $loop+=1;

        $tim = md5(time());

        $fil1 = $_FILES["iop1"]["name"];
        $dest1 = "./qna_images/".$tim.$fil1;
        $dest_db1 = "qna_images/".$tim.$fil1;
        move_uploaded_file($_FILES["iop1"]["tmp_name"] , $dest1);


        $fil2 = $_FILES["iop2"]["name"];
        $dest2 = "./qna_images/".$tim.$fil2;
        $dest_db2 = "qna_images/".$tim.$fil2;
        move_uploaded_file($_FILES["iop2"]["tmp_name"] , $dest2);


        $fil3 = $_FILES["iop3"]["name"];
        $dest3 = "./qna_images/".$tim.$fil3;
        $dest_db3 = "qna_images/".$tim.$fil3;
        move_uploaded_file($_FILES["iop3"]["tmp_name"] , $dest3);


        $fil4 = $_FILES["iop4"]["name"];
        $dest4 = "./qna_images/".$tim.$fil4;
        $dest_db4 = "qna_images/".$tim.$fil4;
        move_uploaded_file($_FILES["iop4"]["tmp_name"] , $dest4);


        $fil5 = $_FILES["ians"]["name"];
        $dest5 = "./qna_images".$tim.$fil5;
        $dest_db5 = "qna_images/".$tim.$fil5;
        move_uploaded_file($_FILES["ians"]["tmp_name"] , $dest5);


        $fil6 = $_FILES["iqname"]["name"];
        $dest6 = "./qna_images/".$tim.$fil6;
        $dest_db6 = "qna_images/".$tim.$fil6;
        move_uploaded_file($_FILES["iqname"]["tmp_name"] , $dest6);



        mysqli_query($con , "insert into tqn(question_no , qun , opt1, opt2 , opt3 , opt4 , answer , category) values ('$loop' , '$dest_db6' , '$dest_db1' , '$dest_db2' , '$dest_db3' , '$dest_db4' , '$dest_db5' , '$ename' )") or die(mysqli_error($con)) ;

        ?>
        <script>
            alert('Question with image added!')
            window.location.href=window.location.href
        </script>
        <?php
        }


        ?>
        <!------------------------------------------- nav bar ------------------------------------------------------------>
        <div id="navii" class="navi bg-success" style="position:relative;">
            <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                <a class="navbar-brand" href="home.php">CodeSpindle</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="java.php">Java</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="html.php">Html</a>
                        </li>
                        <?php 
                        if($_SESSION['type']=="admin"){
                        ?>
                        <li class="nav-item">
                        <a class="nav-link" href="set_test.php">Set Test</a> 
                        </li>
                        <?php
                    }
                ?>
                        <li class="nav-item">
                            <a class="nav-link" href="take_test.html">Take Test</a>
                        </li>
                        <li>

                            <a href="" class="text-white text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="nav-link">Profile</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                <li>
                                    <a class="dropdown-item" href="">Settings</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">User Details</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="logout.php">Sign out</a>
                                </li>
                            </ul>

                        </li>

                    </ul>
                </div>
            </nav>
        </div>
      
    <div id="addlist" style="position: relative;">
        <!---------------------------------------------- add qun done ------------------------------------------------->
        <div class="container-fluid" style="padding:10px">
            <button onclick="showform()" class="btn btn-dark btn-primary btn-lg">Add Question</button>
            <a href="set_test.php"><button class="btn btn-outline-dark btn-light btn-primary btn-lg">Done</button></a>
        </div>
        <!--------------------------------------------- list of qun table ------------------------------------------>
        <div id="qtable">
                <div class="card">
                    <div class="card-header" style="text-align:center;">
                        <strong class="card-title">Questions in <?php echo $ename ?></strong>
                    </div>

                    <div class="card-body ccpd">
                        <table class="table table-bordered" style="text-align: center;">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>Option 1</th>
                                <th>Option 2</th>
                                <th>Option 3</th>
                                <th>Option 4</th>
                                <th>Answer</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </tr>
                            </thead>

                            <?php
                            
                            $rr = mysqli_query($con , "select * from tqn where category='$ename' order by question_no");
                            while($ro = mysqli_fetch_array($rr)){
                                ?>

                                <tr>
                                    <td><p><?php echo $ro["question_no"] ?></p></td>
                                    <td><?php
                                    if(strpos($ro["qun"],'qna_images') !== false){
                                        ?>
                                        <img src="<?php echo $ro["qun"] ?>" alt="Img Not Avl" height="50" width="50">
                                        <?php
                                    }
                                    else{
                                        echo $ro["qun"];
                                    }
                                    ?></td>
                                    <td><?php
                                    if(strpos($ro["opt1"],'qna_images') !== false){
                                        ?>
                                        <img src="<?php echo $ro["opt1"] ?>" alt="Img Not Avl" height="50" width="50">
                                        <?php
                                    }
                                    else{
                                        echo $ro["opt1"];
                                    }
                                    ?></td>
                                    <td><?php
                                    if(strpos($ro["opt2"],'qna_images') !== false){
                                        ?>
                                        <img src="<?php echo $ro["opt2"] ?>" alt="Img Not Avl" height="50" width="50">
                                        <?php
                                    }
                                    else{
                                        echo $ro["opt2"];
                                    }
                                    ?></td>
                                    <td><?php
                                    if(strpos($ro["opt3"],'qna_images') !== false){
                                        ?>
                                        <img src="<?php echo $ro["opt3"] ?>" alt="Img Not Avl" height="50" width="50">
                                        <?php
                                    }
                                    else{
                                        echo $ro["opt3"];
                                    }
                                    ?></td>
                                    <td><?php
                                    if(strpos($ro["opt4"],'qna_images') !== false){
                                        ?>
                                        <img src="<?php echo $ro["opt4"] ?>" alt="Img Not Avl" height="50" width="50">
                                        <?php
                                    }
                                    else{
                                        echo $ro["opt4"];
                                    }
                                    ?></td>
                                    <td><?php
                                    if(strpos($ro["answer"],'qna_images') !== false){
                                        ?>
                                        <img src="<?php echo $ro["answer"] ?>" alt="Img Not Avl" height="50" width="50">
                                        <?php
                                    }
                                    else{
                                        echo $ro["answer"];
                                    }
                                    ?></td>
                                    <td><a href="editq.php?id=<?php echo $ro["qid"]; ?>" style="text-decoration: none;">✏</a></td>
                                    <td><a href="delconq.php?id=<?php echo $ro["qid"]; ?>" style="color:red; text-decoration: none;">❌</a></td>
                                </tr>
                                <?php
                            }
                            ?>

                            <tbody>   
                                 <!-- table content -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

        <!----------------------------------------------- dialog box for add qun form ---------------------------------------------------->
        <div class="container" id="addqf" style="position:relative; z-index: 2;bottom:200px">
            <form id="qf" action="" method="post"></form>
                <div class="form-group">
                    <label for="qname">Question<button onclick="showiform()" class="btn btn-primary btn-dark" style="margin:10px;">Image</button></label>
                    <textarea cols="30" rows="10" form="qf" type="text" name="qname" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="op1">Option 1</label>
                    <textarea cols="10" rows="2" form="qf" type="text" name="op1" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="op2">Option 2</label>
                    <textarea cols="10" rows="2" form="qf" type="text" name="op2" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="op3">Option 3</label>
                    <textarea cols="10" rows="2" form="qf" type="text" name="op3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="op4">Option 4</label>
                    <textarea cols="10" rows="2" form="qf" type="text" name="op4" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="ans">Answer</label>
                    <textarea cols="10" rows="2" form="qf" type="text" name="ans" class="form-control"></textarea>
                </div>
                <br>
                <input form="qf" type="submit" name="aqn" value="Add Qun" class="btn btn-dark">
                <!-- DOUBT <a href="test_qun.php"><button class="btn btn-danger">Cancel</button></a> -->
                <button onclick="clos('addqf')" class="btn btn-danger">Cancel</button>
        </div>

        <!-- ---------------------------------------------------dbox for img optns----------------------------------------------------- -->

        <div class="container" id="addimg" style="position:relative; z-index: 3;bottom: 250px;">
            <form id="imf" action="" enctype="multipart/form-data" method="post"></form>
                <div class="form-group">
                    <label for="qname">Question Image</label>
                    <input form="imf" type="file" name="iqname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="op1">Option 1 Image</label>
                    <input form="imf" type="file" name="iop1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="op2">Option 2 Image</label>
                    <input form="imf" type="file" name="iop2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="op3">Option 3 Image</label>
                    <input form="imf" type="file" name="iop3" class="form-control">
                </div>
                <div class="form-group">
                    <label for="op4">Option 4 Image</label>
                    <input form="imf" type="file" name="iop4" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ans">Answer Image</label>
                    <input form="imf" type="file" name="ians" class="form-control">
                </div>
                <br>
                <input form="imf" type="submit" name="aqni" value="Add Qun" class="btn btn-dark">
                <button onclick="clos('addimg')" class="btn btn-danger">Cancel</button>
        </div>




        <script>
            document.getElementById('addqf').style.display="none";
            document.getElementById('addimg').style.display="none";

            function showform(){
                document.getElementById('addqf').style.display="block";
                document.getElementById("addlist").style.opacity = "20%";
                document.getElementById("addlist").style.zIndex = "-1";
                document.getElementById("navii").style.opacity = "20%";
                document.getElementById("navii").style.zIndex = "-1";
            }

            function showiform(){
                document.getElementById('addimg').style.display="block";
                document.getElementById('addqf').style.display="none";
                document.getElementById("addlist").style.opacity = "20%";
                document.getElementById("addlist").style.zIndex = "-1";
                document.getElementById("navii").style.opacity = "20%";
                document.getElementById("navii").style.zIndex = "-1";
            }

            function clos(a){
                document.getElementById("addlist").style.opacity = "initial";
                document.getElementById("navii").style.opacity = "initial";
                document.getElementById("navii").style.zIndex = "initial";
                document.getElementById("addlist").style.zIndex = "initial";
                document.getElementById(a).style.display = "none";
            }

        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>
</html>
