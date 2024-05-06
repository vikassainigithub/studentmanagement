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
        <h3 style='color:goldenrod;'>viewstudent.php</h3>
        <!-- <h6 style='color:green;'>Here,you see student data who have fill up the form on addstudent.php<br>isme humne student ka data dikhana tha bs vo krne k liye andar liki hui step 2 wali query chlayenge</h6> -->
        <!-- <p style='color:goldenrod;'>This data wil be access on user table and enter data on this table by using addstudent.php</p> -->
        <?php
        if($_SESSION['deletesuccessfully']){
            echo $_SESSION['deletesuccessfully'];
        }
        unset($_SESSION['deletesuccessfully']);
        ?>
        <!--ab hum user table ka data yaha par show krenge -->
        <?php
        $host="localhost";
        $username="root";
        $password="";
        $db="schoolproject";
        $cn=mysqli_connect($host,$username,$password,$db);
        if($cn===false){
            echo "connection failed";
        }
        $sql="select * from user";
    // yadi only student ka data nikalna ho to hum niche wali query chlayenge.
    // isme hume vaise niche wali he query chlani thi kyuki humne kewal student ka dat nikalna tha user table se.
        // $sql="select * from user where usertype='student'";
        
        $result=mysqli_query($cn,$sql)or die('sql query error');
        ?>
        <!-- html parts starts hum table ko php me bhi bna skte hai or record fetch kr skt ehai lekin hum yaha html me table bnayenge or php se data ko lekar aayenge html table me uske liye hume while loop chlate time php open or close ka dhyan rakhna hai dhyan ye rakhna hai ki jo 2nd row hai html ka vo while loop k andar aa jaye but hona vo html me chaiye -->
    <table style="border:1px solid red; margin-left:50px;">
        <tr>
            <td style="background-color:goldenrod; padding:8px; font-size:10px;">id</td>
            <td style="background-color:green;  padding:8px; font-size:10px;">username</td>
            <td style="background-color:goldenrod;  padding:8px; font-size:10px;">phone</td>
            <td style="background-color:green;  padding:8px; font-size:10px;">email</td>
            <td style="background-color:goldenrod;  padding:8px; font-size:10px;">usertype</td>
            <td style="background-color:green;  padding:8px; font-size:10px;">password</td>
            <td style="background-color:goldenrod;  padding:8px; font-size:10px;">Edit</td>
            <td style="background-color:green;  padding:8px; font-size:10px;">Delete</td>
        </tr>
        
        <!-- php while loop starts -->
        <!-- while loop mainly jab tak print krta hai jabtak condition false nhi hoti -->
        <?php
        while($row=mysqli_fetch_assoc($result)){
            ?>

        <tr>
            <td style="background-color:goldenrod; padding:0px 2px; font-size:10px;"><?php echo $row['id'];?></td>
            <td style="background-color:green;   font-size:10px;"><?php echo $row['username'];?></td>
            <td style="background-color:goldenrod;   font-size:10px;"><?php echo $row['phone'];?></td>
            <td style="background-color:green;   font-size:10px;"><?php echo $row['email'];?></td>
            <td style="background-color:goldenrod;   font-size:10px;"><?php echo $row['usertype'];?></td>
            <td style="background-color:green;   font-size:10px;"><?php echo $row['password'];?></td>
            <td style="background-color:goldenrod;  ">
                <?php 
                echo "<a style='font-size:8px;'class='btn btn-success' fs-15' href='editstudent.php?action=edit&studentid=".$row["id"]."'>Edit</a>";
                ?>
            </td>
            <td style="background-color:green; ">
                <?php 
                echo "<a  style='font-size:8px;' class='btn btn-danger' fs-15' onclick='return confirmbox()' href='editstudent.php?action=delete&studentid=".$row["id"]."'>DELETE</a>";
                ?>
            </td>
        </tr>
<!-- php while loop ends  -->
        <?php
        }
        ?>
    </table>
    </div>
</div>

 <!-- bootstrap js file linked -->
 <script src="bootstrap-offline/bootstrap.bundle.min.js"></script>
 <script>
         function confirmbox(){
            return confirm('are you sure you want to delete data');
            }
</script>
</body>
</html>