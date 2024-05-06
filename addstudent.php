<?php
// jab bhi hum session bnayenge ya phir bnaye hue session ko lgayenge to sabse pehle humne session_start() krna hai.
session_start();
error_reporting(0);
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
// adminhome.php wale page me hum usertype=admin likhenge or studenthome.php wale page me hum usertype=admin likhenge. 
elseif($_SESSION['usertype']=='student'){
    header("location:login.php");
}
// humne if condition me condition lgayi ki yadi username khali hai to vo login.php par he rhe andar adminhome.php wale page ko access na kre. 
// phir elseif condition me condition di ki ydi usertype student bhar deta hai koi galti se to vo uss case me bhi login.php page par he rhe. 
// inn dono condition ka matlab hai yadi hum galt(wrong) username or password bharte hai to ye login.php wale page par he rhega.
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$cn=mysqli_connect($host,$user,$password,$db);
if($cn===false){
    echo"<script type='text/javascript'>
        alert('connnection failed');
        </script>";
}
// else{
//     echo"<script type='text/javascript'>
//         alert('connnection success');
//         </script>";
// }
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
            <li><a href="#">view Course</a></li>
        </ul> 
    </div>
    <div class="right">
        <h3 style="color:blue;">addstudent.php</h3>
        <!-- form start -->
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div>
                <label for="">Name</label>
                <input type="text" name="studentname" placeholder="student-name">
            </div>
            <div>
                <label for="">Phone</label>
                <input type="text" name="studentphone"placeholder="student-phone">
            </div>
            <div>
                <label for="">Email</label>
                <input type="text" name="studentemail"placeholder="student-email">
            </div>
            <div>
                <label for="">Password</label>
                <input type="text" name="studentpassword"placeholder="student-password">
            </div>
            <div>
                <input type="submit" name="addstudent" value="ADD_STUDENT" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php
// form value pick
if(isset($_POST['addstudent'])){
    $student_name=$_POST['studentname'];
    $student_phone=$_POST['studentphone'];
    $student_email=$_POST['studentemail'];
    $student_password=$_POST['studentpassword'];
    //usertype ki value humne permanent store kra di kyuki ye student k liye hai to usertype value humne fixed kr di
    // student ko fill krne ki jrurat nhi hai or na he humne form k andar section diya hai kyuki ye permanent student k liye hai registration 
    $usertype="student";
    // yadi duplicate value enter krne se baachna hai to niche wala code chlaye isme humne duplicat rowcount kiya hai
    // yadi rowcount ki value 1 ka brabar hai to vo likhe username exist hai.or yadi $rowcount ki value 1 k barabr nhi hai to else condition 
    // chle or usme humne insert data wali command chla rakh ki hai to yadi duplicate nhi hai to data insert ho jaye
    // $chkduplicte="select * from user where username='$student_name'";
    // $duplicteRow=mysqli_query($cn,$chkduplicte);
    // $rowcount=mysqli_num_rows($duplicteRow);
    // if($rowcount==1){
    //     echo "<script type='text/javascript'>
    //         alert('username already exist pls give another name');
    //         </script>";
    // }
    // else{
    $sql1= "INSERT INTO user(username, phone, email, usertype, password) values('$student_name', '$student_phone', '$student_email', '$usertype', '$student_password')";
    $result1=mysqli_query($cn,$sql1)or die("sql query error");
    if($result1){
        echo "<script type='text/javascript'>
                alert('successfully upload student data');
                </script>";
    }
    else{
        echo "not upload successfully student data";
    }   
    // }          
}
?>
 <!-- bootstrap js file linked -->
 <script src="bootstrap-offline/bootstrap.bundle.min.js"></script>
</body>
</html>