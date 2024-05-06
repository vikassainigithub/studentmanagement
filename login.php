<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- boootstrap css file link -->
    <link rel="stylesheet" href="bootstrap-offline/bootstrap.min.css">
</head>
<body class="allblack">  
    <div class="container-fluid">
        <div class="row c-tweleve">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 c-thirteen">
                <form action="logincheck.php" method="POST">
                    <div>
                        <h1>Login form</h1>
                    </div>
                    <div>
                        <label for="">Username:</label>
                        <input type="text" name="username">
                    </div>
                    <div>
                        <label for="">Password:</label>
                        <input type="password" name="password">
                    </div>
                    <div>
                        <input type="submit" name="loginbtn" value="login" class="btn btn-primary text-center">
                    </div>
                </form>
                <h5 class="errormsg">
                    <?php
                        echo $_SESSION["loginmessage"];
                    ?>
                </h5>
            </div>
        </div>
    </div>
</body>
</html>