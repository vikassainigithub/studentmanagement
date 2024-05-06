<?php
// jab bhi hum session bnayenge ya phir bnaye hue session ko lgayenge to sabse pehle humne session_start() krna hai.
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
$host="localhost";
        $user="root";
        $password="";
        $db="schoolproject";
        $cn=mysqli_connect($host,$user,$password,$db);
        if($cn===false){
            die("connection error");
        }
        $sql="select * from admission order by name DESC";
$result=mysqli_query($cn,$sql) or die("could not find users");
// if(mysqli_num_rows($result)>0){
//     echo "<table border='1' cellpadding='10' cellspacing='0'>";
//     echo "<tr>";
//     echo "<th>id</th>";
//     echo "<th>name</th>";
//     echo "<th>email</th>";
//     echo "<th>phone</th>";
//     echo "<th>message</th>";
//     echo "</tr>";
//     while($row=mysqli_fetch_assoc($result)){
//         echo"<tr'>";
//             echo "<td style='padding:20px; font-size:15px; background-color:green;'>";
//                 echo $row['id'];
//             echo"</td>";
//             echo "<td>";
//                 echo $row['name'];
//             echo"</td>";
//             echo "<td style='padding:20px; font-size:15px; background-color:green;'>";
//                 echo $row['email'];
//             echo"</td>";
//             echo "<td>";
//                 echo $row['phone'];
//             echo"</td>";
//             echo "<td style='padding:20px; font-size:15px; background-color:green;'>";
//                 echo $row['message'];
//             echo"</td>";
//         echo "</tr>";
//     }
//     echo "</table>";
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
            <li><a href="#">Add Course</a></li>
            <li><a href="#">view Course</a></li>
        </ul> 
    </div>
    <div class="right">
        <h3>admission.php</h3>
        <table style=" margin:10px; border:1px solid red;" cellpadding='10' cellspacing='0'>
            <tr>
                <th style="padding:5px; font-size:10px; background-color:green;">id</th>
                <th style="padding:5px; font-size:10px;background-color:pink;">Name</th>
                <th style="padding:5px; font-size:10px;background-color:green;">email</th>
                <th style="padding:5px; font-size:10px;background-color:pink;">phone</th>
                <th style="padding:5px; font-size:10px;background-color:green;">message</th>
            </tr>

            <?php
            while($row=mysqli_fetch_assoc($result)){
            ?>
            <!-- isme notice krne ki baat ye hai ki humne while loop k upar php on ki phir curley braces k niche bnd kr di phir 
            humara html part aya phir php on ki phir curley braces close kiya while loop ka phir php close ki
            html part kaise hai ye kyuki iska syntax blue color ka hai jese <tr>,<th> ye sab colorful hai isiliye ye html me bnaya gya hai or 
            ye html part humne while loop k andar likha hai taki jab tak condition false na  ho jaye tab tak ye ek row create krta rahe or usme value print krta rahe
            iss treh humne while loop to php ka chlaya or php ki condition use ki mysqli_fetch_assoc() or table html k andar bnayi.
            jab bhi hume esa krna hai to php open or close ka dhyan rakhe vrna ye kaam nhi krega  
            humne niche 2nd step me pure php k andar bhi table bnayi hai or jab bhi hum koi bhi 
        tag ya phir div bnayege php k andar to vo echo k andar double quotes k andar likhi jayegi jese humne 
        niche table create ki hai vo table puri ki puri complete php k andar hai-->
                <!--1. ye row humara without php hai ye humne direct html me bnaya hai  -->
                <tr>
                <th style="padding:5px; font-size:10px; background-color:green;"><?php echo $row['id']; ?></th>
                <th style="padding:5px; font-size:10px;background-color:pink;"><?php echo $row['name'];?></th>
                <th style="padding:5px; font-size:10px;background-color:green;"><?php echo $row['email'];?></th>
                <th style="padding:5px; font-size:10px;background-color:pink;"><?php echo $row['phone'];?></th>
                <th style="padding:5px; font-size:10px;background-color:green;"><?php echo $row['message'];?></th>
                </tr>
            
            <?php
            }
            ?>
        </table>        
            <!-- 2 isme hum only php ki help se data laye hai -->
            <?php
    //         $host="localhost";
    //         $user="root";
    //         $password="";
    //         $db="schoolproject";
    //         $cn=mysqli_connect($host,$user,$password,$db);
    //         if($cn===false){
    //             die("connection error");
    //         }
    //         $sql="select * from admission order by name DESC";
    // $result=mysqli_query($cn,$sql) or die("could not find users");
    // if(mysqli_num_rows($result)>0){
    //     echo "<table border='1' cellpadding='10' cellspacing='0'>";
    //     echo "<tr>";
    //     echo "<th>id</th>";
    //     echo "<th>name</th>";
    //     echo "<th>email</th>";
    //     echo "<th>phone</th>";
    //     echo "<th>message</th>";
    //     echo "</tr>";
    //     while($row=mysqli_fetch_assoc($result)){
    //         echo"<tr'>";
    //             echo "<td style='padding:20px; font-size:15px; background-color:green;'>";
    //                 echo $row['id'];
    //             echo"</td>";
    //             echo "<td style="padding:20px; font-size:15px;background-color:pink;">";
    //                 echo $row['name'];
    //             echo"</td>";
    //             echo "<td style='padding:20px; font-size:15px; background-color:green;'>";
    //                 echo $row['email'];
    //             echo"</td>";
    //             echo "<td style="padding:20px; font-size:15px;background-color:pink;">";
    //                 echo $row['phone'];
    //             echo"</td>";
    //             echo "<td style='padding:20px; font-size:15px; background-color:green;'>";
    //                 echo $row['message'];
    //             echo"</td>";
    //         echo "</tr>";
    //     }
    //     echo "</table>";
    // }
            ?>
    </div>
</div>

 <!-- bootstrap js file linked -->
 <script src="bootstrap-offline/bootstrap.bundle.min.js"></script>
</body>
</html>