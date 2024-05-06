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
        <h3>Here,this is your Teacher dashboard || addteacher.php</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST"enctype="multipart/form-data">
            <div>
                <label for="">Teacher-Name:</label>
                <input type="text" name="teachername">
            </div>
            <div>
                <label for="">Teacher-description:</label>
                <textarea style="color:blue;" name="teacherdescription" id="" cols="30" rows="1"></textarea>
            </div>
            <div>
                <label for="">Teacher-image:</label>
                <input class="bg-white"type="file" name="teacherimage">
            </div>
            <div>
                <input type="submit" class="btn btn-primary"name="techrsubmtdata" value="Add-teacher">
            </div>
        </form>
    </div>
</div>
<!-- php starts for adding a teacher data -->
<?php
$host="localhost";
$username="root";
$password="";
$db="schoolproject";
$cn=mysqli_connect($host,$username,$password,$db);
if($cn==false){
    echo"connection failed";
}
if(isset($_POST['techrsubmtdata'])){
    $techrname=$_POST['teachername'];
    $techrdescrptn=$_POST['teacherdescription'];
    // file upload code
    // ab iss niche wali line ki jrurat nhi hai kyuki humne input type file hai jo humara input uska name="teacherimage" vo path k niche likh rakh ka hai 
    // $techrimg=$_FILES['teacherimage']['name'];
    $path='uploadimages/';
                $filename=$_FILES['teacherimage']['name'];
                $filecontent=$_FILES['teacherimage']['tmp_name'];
                $filetype=$_FILES['teacherimage']['type'];
                $filesize=$_FILES['teacherimage']['size'];
                $fileerror=$_FILES['teacherimage']['error'];
                // if($fileerror){
                    if(substr($filetype,0,5)=="image"){
                        $filepath=$path.$filename;
                        move_uploaded_file($filecontent,$filepath);
                        echo $filename.' of size '. floor($filesize/1024) .' KB is uploaded successfuly';
                        }  
                    else{
                            echo"select image file";
                        }
                // }
                // else{
                    // echo "file error=the file error should be 1 if this error is zero then file uploaded successfully.";
                // }
                $sql="insert into teacher(name,description,image) values('$techrname','$techrdescrptn','$filepath')";
                $result=mysqli_query($cn,$sql)or die('sql query error');
}
            ?>
 <!-- bootstrap js file linked -->
 <script src="bootstrap-offline/bootstrap.bundle.min.js"></script>
</body>
</html>