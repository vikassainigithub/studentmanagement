<?php
// jab bhi hum session bnayenge ya phir bnaye hue session ko lgayenge to sabse pehle humne session_start() krna hai.
error_reporting(0);
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
// adminhome.php wale page me hum usertype=student likhenge or studenthome.php wale page me hum usertype=admin likhenge. 
elseif($_SESSION['usertype']=='student'){
    header("location:login.php");
}
// humne if condition me condition lgayi ki yadi username khali hai to vo login.php par he rhe andar adminhome.php wale page ko access na kre. 
// phir elseif condition me condition di ki ydi usertype student bhar deta hai koi galti se to vo uss case me bhi login.php page par he rhe. 
// inn dono condition ka matlab hai yadi hum galt(wrong) username or password bharte hai to ye login.php wale page par he rhega.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_dashboard</title>
      <!-- homemade css file link -->
      <link rel="stylesheet" href="css/adminhome.css">
    <!-- boootstrap css file link -->
    <link rel="stylesheet" href="bootstrap-offline/bootstrap.min.css">
    <style>
        .editform{
            width:100%;
            /* background-color:grey; */
            margin:40px 30px !important;
        }
            .editform>div{
            width:100%;
            display:flex;
            flex-direction:row !important;
            justify-content:space-between;
        }
        .editform>div>label{
            width: 20%;
            font-size:10px;
        }
        .editform>div>input{
            width: 80%;
            font-size:10px;
        } 
        .editform>.updatebtn{
            margin-left:20%;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row c-fourteen bg-primary">
        <!-- p-3 is used for padding -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-3 c-fifteen">
        <a href="#" class="text-warning">Admin-Home</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-3 text-end c-sixteen">
        <a href="logout.php" class="btn btn-warning text-success c-seventeen">logout</a>
        </div>
    </div>
</div>

<div class="c-eighteen" >
    <div class="sidebar">
        <ul>
            <li><a href="admission.php">Admission</a></li>
            <li><a href="addstudent.php">Add student</a></li>
            <li><a href="viewstudent">view student</a></li>
            <li><a href="#">Add Teacher</a></li>
            <li><a href="#">view Teacher</a></li>
            <li><a href="#">Add Course</a></li>
            <li><a href="">view Course</a></li>
        </ul>
    </div>
    <div class="right">
        <h3 style='color:goldenrod;'>editstudent.php</h3>
        <?php
$host="localhost";
$username="root";
$password="";
$db="schoolproject";
$cn=mysqli_connect($host,$username,$password,$db)or die("connection failed");
if(isset($_GET['action'])!==""){
    $action=$_GET['action'];
    // echo "action=".$action;
    //ye hume edit pe click krne par action ki value de rha hai edit or sath me id de rha hai
}
if(isset($_GET['studentid'])!==''){
    $id=$_GET['studentid'];
    // echo "<br>id=".$id;
    // ye hume id ki value de rha hai jis per bhi hum click kr rahe hai uski id de rha hai.
}
if($action=='edit'){
    $sql="SELECT * FROM user WHERE id=$id";
    $result=mysqli_query($cn,$sql) or die('could not fetch user');
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        ?>
        <form class="editform"name="frmstudentupdate" action="updatestudent.php" method="POST">
            <div>
                <label for="txtid">id</label>
                <input type="visible" name="txtid" value="<?php echo $row['id'];?>"readonly>
            </div>
            <div>
                <label for="txtuser">username</label>
                <input type="text" name="txtusername" id="txtuser" value="<?php echo $row['username'];?>">
            </div>
            <div>
                <label for="txtphone">phone</label>
                <input type="tel" name="txtphone" id="txtphone" value="<?php echo $row['phone'];?>">
            </div>
            <div>
                <label for="txtemail">email</label>
                <input type="email" name="txtemail" id="txtemail" value="<?php echo $row['email'];?>">
            </div>
            <div>
                <label for="txtusertype">usertype</label>
                <input type="text" name="txtusertype" id="txtusertype" value="<?php echo $row['usertype'];?>">
            </div>
            <div>
                <label for="txtpassword">password</label>
                <input type="password" name="txtpassword" id="txtpassword" value="<?php echo $row['password'];?>">
            </div>
            <div class="updatebtn">
                <input type="submit" name="updatestudent" value="update" class="btn btn-primary">
            </div>
        </form>
        <?php
    }
}
else if($action=='delete'){
        $deluser="DELETE FROM user WHERE id=$id";
        $result=mysqli_query($cn,$deluser) or die('could not delete user'.mysqli_error($cn));
        if($result>0){
            $_SESSION['deletesuccessfully']='student data delete successfully';
            header("location:viewstudent.php");
        }
        else{
            echo"<br>error in deleting user";
            
        }
}
else{
    header("location:viewstudent.php");
}
?>
    </div>
</div>

 <!-- bootstrap js file linked -->
 <script src="bootstrap-offline/bootstrap.bundle.min.js"></script>
</body>
</html>