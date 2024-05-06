<?php
// jab bhi hum session bnayenge ya phir bnaye hue session ko lgayenge to sabse pehle humne session_start() krna hai.
session_start();
error_reporting(0);
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
}
?>
<!-- php starts -->
<!-- yaha par hum jese login.php se username or password fill krke aaye jis naam se humne login kiya uska record yaha par dikhna chiye taki hum usko update kr ske. -->
<?php
$host="localhost";
$username="root";
$password="";
$db="schoolproject";
$cn=mysqli_connect($host,$username,$password,$db);
$name=$_SESSION['username'];
$sql="select * from user where username='$name'";
$result=mysqli_query($cn,$sql)or die('sql query error');
$row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student_dashboard</title>
      <!-- homemade css file link -->
      <link rel="stylesheet" href="css/adminhome.css">
    <!-- boootstrap css file link -->
    <link rel="stylesheet" href="bootstrap-offline/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="row c-fourteen bg-primary">
        <!-- p-3 is used for padding -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-3 c-fifteen">
        <a href="#" class="text-warning">student-Home</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-3 text-end c-sixteen">
        <a href="logout.php" class="btn btn-warning text-success c-seventeen">logout</a>
        </div>
    </div>
</div>

<div class="c-eighteen" >
    <div class="sidebar">
        <ul>
            <li><a href="studentprofile.php">My profile</a></li>
            <li><a href="#">My courses</a></li>
            <li><a href="#">My result</a></li>
        </ul>
    </div>
    <div class="right">
        <h3>my profile/student profile || studentprofile.php</h3>
        <p style='width:20%; background-color:green; font-weight:600; font-size:12px; padding:0; margin:0px 0px 0px 5px;'>
            <?php
            echo $_SESSION['successmsg'];
            unset($_SESSION['successmsg']);
            ?>
        </p>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div>
                <label style="font-weight:600;"for="">id</label>
                <input style="font-size:10px;"type="text" name="stdntid" value="<?php echo $row['id'];?>" readonly>
            </div>
            <div>
                <label style="font-weight:600;"for="">username</label>
                <input style="font-size:10px;"type="text" name="stdntname" value="<?php echo $row['username'];?>">
            </div>
            <div>
                <label style="font-weight:600;"for="">phone</label>
                <input style="font-size:10px;"type="text" name="stdntphone" value="<?php echo $row['phone'];?>">
            </div>
            <div>
                <label style="font-weight:600;"for="">email</label>
                <input style="font-size:10px;"type="text" name="stdntemail" value="<?php echo $row['email'];?>">
            </div>
            <div> 
                <label style="font-weight:600;"for="">usertype</label>
                <input style="font-size:10px;"type="text" name="stdntusertype" value="<?php echo $row['usertype'];?>" readonly>
            </div>
            <div>
                <label style="font-weight:600;"for="">password</label>
                <input style="font-size:10px;"type="text" name="stdntpassword" value="<?php echo $row['password'];?>">
            </div>
            <div>
                <input style="font-size:12px; font-weight:700;"type="submit" class="btn btn-warning" name="stdntupdatebtn" value="update_login_detail">
            </div>
        </form> 
    </div>
</div>
<?php
// yadi hume data update krna hai to hum readonly ko hta denge or iss query ko chla denge
if(isset($_POST['stdntupdatebtn'])){
    $nameupdate=$_POST['stdntname'];
    $phoneupdate=$_POST['stdntphone'];
    $emailupdate=$_POST['stdntemail'];
    $passwordupdate=$_POST['stdntpassword'];
    $sql2="update user set username='$nameupdate',phone=$phoneupdate,email='$emailupdate',password='$passwordupdate' where username='$name'";
    $result2=mysqli_query($cn,$sql2) or die('update query failed');
    if($result2){
        $_SESSION['successmsg']='successfully update';
    }
    else{
        echo "failed to update data";
    }
}
?>
<!-- bootstrap js file linked -->
<script src="bootstrap-offline/bootstrap.bundle.min.js"></script>
</body>
</html>