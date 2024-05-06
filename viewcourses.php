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
<?php
 $host="localhost";
 $username="root";
 $password="";
 $db="schoolproject";
 $cn=mysqli_connect($host,$username,$password,$db) or die("connection failed");
 $sql="select * from course";
 $result=mysqli_query($cn,$sql)or die('sql query error');
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
            <li><a href="viewstudent.php">view student</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="viewteacher.php">view Teacher</a></li>
            <li><a href="addcourses.php">Add Course</a></li>
            <li><a href="viewcourses.php">view Course</a></li>
        </ul>
    </div>
    <div class="right">
        <h3>viewcourse.php</h3>
        <p>our courses data show here.</p>
        <table style="text-align:center; margin:0 auto;">
            <tr style="border:1px solid skyblue; font-weight:800;">
                <td style="background-color:cadetblue;">id</td>
                <td style="background-color:coral;">course-name</td>
                <td style="background-color:cadetblue;">course-description</td>
                <td style="background-color:coral;">course-image</td>
                <td style="background-color:cadetblue;">edit</td>
                <td style="background-color:coral;">delete</td>
            </tr>
            <?php 
            while($row=mysqli_fetch_assoc($result)){
            ?>
            <tr style="border:1px solid skyblue;">
                <td style="background-color:cadetblue;"><?php echo $row['id'];?></td>
                <td style="background-color:coral;"><?php echo $row['name'];?></td>
                <td style="background-color:cadetblue; width:30%;"><?php echo $row['description'];?></td>
                <td style="background-color:coral;"><img style="width:100px; height:50px;"src="<?php echo $row['image'];?>" alt=""></td>
                <td>
                    <a class="btn btn-warning" href='editcourse.php?action=edit&id=<?php echo $row['id'];?>'>edit</a>
                </td>
                <td>
                    <a onclick="return confirmbox();" class="btn btn-danger"href="editcourse.php?action=delete&id=<?php echo $row['id'];?>">delete</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
 <!-- bootstrap js file linked -->
 <script src="bootstrap-offline/bootstrap.bundle.min.js"></script>
 <script type="text/javascript">
    function confirmbox(){
        return confirm("are you sure you want to delete data");
    }
 </script>
</body>
</html>