<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css style sheet -->
    <link rel="stylesheet" href="styles.css">
    <!-- favicon -->
    <link rel="icon"  href="images/favicon.ico">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
    <style>
        #si,#li{
    display: none;
}
    </style>
</head>

<body>
<!-- navbar -->
    <div class="navi bg-success">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="index.php">CodeSpindle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" onclick="si('si','li')" style="cursor:pointer" >Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="si('li','si')" style="cursor:pointer">Sign In</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    
    <div class="container">
        <!-- log in form -->
        
                <div id="li" class="row" style="width: 50%; margin: auto;">
                    <h2 style="text-align: center;">Log In</h2>
                    <form action="val.php" method="post">
                        <div class="form-group">
                        <label for="username">Enter Username</label>
                        <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                        <label for="password">Enter Password</label>
                        <input type="password" name="password" class="form-control" required>
                        </div>
                        <br>
                        <button class="btn btn-success">Log In</button>
                        <a onclick="si('li','si')" style="text-decoration: none;cursor:pointer ;color:gray ; margin-left: 50%;">Register now!</a>
                    </form>
                </div>
<!--------------------------------------------- sign in form --------------------------------------------------------------------->
            <div class="row" id="si" style="width: 50%; margin: auto;">
                <h2 style="text-align: center;">Sign In</h2>
                    <form action="reg.php" method="post">
                        <div class="form-group">
                        <label for="username">Enter Username</label>
                        <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                        <label for="password">Enter Password</label>
                        <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                        <label for="rpassword">Re-Enter Password</label>
                        <input type="password" name="rpassword" class="form-control" required>
                        </div>
                        <br>
                        <button class="btn btn-success">Sign In</button>
                        <p>
                            Already an user?
                        <a onclick="si('si','li')" style="text-decoration: none;cursor:pointer ;color:gray ;">Log In!</a>
                        </p>
                    </form>
            </div>

        
    </div>
    
    <!-----------------------------------------------si and li block-------------------------------------------------------------->
    <script>
        document.getElementById('li').style.display="block";
        function si(a,b){
            document.getElementById(a).style.display="none";
            document.getElementById(b).style.display="block";
        }
    </script>
    
    
    
    
    
    
    
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>

