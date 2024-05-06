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
            <li><a href="viewstudent.php">view student</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="viewteacher.php">view Teacher</a></li>
            <li><a href="#">Add Course</a></li>
            <li><a href="#">view Course</a></li>
        </ul>
    </div>
    <div class="right">
        <h3 style='color:goldenrod;'>editcourse.php</h3>
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
if(isset($_GET['id'])!==''){
    $id=$_GET['id'];
    // echo "<br>id=".$id;
    // ye hume id ki value de rha hai jis per bhi hum click kr rahe hai uski id de rha hai.
}
if($action=='edit'){
    $sql="SELECT * FROM course WHERE id=$id";
    $result=mysqli_query($cn,$sql) or die('could not fetch user');
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
?>
<!-- html starts -->
        <form class="editcourse"name="courseupdate" action="updatecourse.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="courseid">course-id</label>
                <input type="visible" name="courseid" value="<?php echo $row['id'];?>"readonly>
            </div>
            <div>
                <label for="coursename">course-name</label>
                <input type="text" name="coursename" value="<?php echo $row['name'];?>">
            </div>
            <div>
                <label for="coursedescription">course-description</label>
                <input type="text" name="coursedescription" value="<?php echo $row['description'];?>">
            </div>
            <div>
                <label for="coursefile">course-image</label>
                <!-- pehle se jo image upload hai vo hum niche wale image tag me dekehenge -->
                <img style="width:50px; height=40px;" src="<?php echo $row['image'];?>">
                <!-- new image select hum niche wale input tag se krenge or phir uss select hui image ko dekhna hai to hum input tag k niche jo image tag hai usk ause krenege
                    sath me hume thodi si javacsript use krni hai kyuki input tag k url ko convert krne k liye hume URL.createobjecturl ki jrurat padegi. -->
                <input type="file" name="newcourseimgupldinpt" id="inptuploadr">
                <img id="newimgpreview" style="width:50px; height:50px; background-color:coral; margin-right:20px; display:none;"src="" alt="new image">
                <script>
                let inptuploader=document.getElementById("inptuploadr");
                let newimgprview=document.getElementById("newimgpreview");
                inptuploader.addEventListener("change",function(event){
                    if(event.target.files.length>0){
                        newimgprview.src=URL.createObjectURL(event.target.files[0]);
                    }
                    newimgprview.style.display="block"; 
                });
                </script>
            </div>
            <div class="updatebtn">
                <input type="submit" name="updatecourse" value="update_course" class="btn btn-primary">
            </div>
        </form>

        <?php // yaha par humne php start krni hai ek bar hum isko php me bnakr dekhte hai kyuki ab form humara html me bna hua tha 
    }
}
else if($action=='delete'){
        $deluser="DELETE FROM course WHERE id=$id";
        $result=mysqli_query($cn,$deluser) or die('could not delete user'.mysqli_error($cn));
        if($result>0){
            $_SESSION['deletesuccessfully']='course data delete successfully';
            header("location:viewcourses.php");
        }
        else{
            echo"<br>error in deleting user";
        }
}
else{
    header("location:viewcourses.php");
}
?>
    </div>
</div>

 <!-- bootstrap js file linked -->
 <script src="bootstrap-offline/bootstrap.bundle.min.js"></script>
</body>
</html>