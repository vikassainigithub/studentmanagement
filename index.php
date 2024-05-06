<?php
error_reporting(0);
session_start();
if($_SESSION['messagesuccess']){
    $messageright=$_SESSION['messagesuccess'];
    echo" <script type='text/javascript'>
        alert('$messageright');
    </script>";
}
$host="localhost";
$username="root";
$pasword="";
$db="schoolproject";
$cn=mysqli_connect($host,$username,$pasword,$db)or die("connection failed");
$sql="select * from teacher";
$result=mysqli_query($cn,$sql)or die("could not start teacher query");
$sql2="select * from course";
$result2=mysqli_query($cn,$sql2)or die("could not start course query");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student  management system</title>
        <!-- homemade css file link -->
    <link rel="stylesheet" href="css/style.css">
    <!-- boootstrap css file link -->
    <link rel="stylesheet" href="bootstrap-offline/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 bg-primary">
                <label>Oxford school</label>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6  bg-primary listitem">
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="">Admission</a></li>
                    <li><a href="login.php" class="bg-warning text-primary">login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-12 banner">
                <img src="images/360_F_393323046_mo4niGwmjAWqMDMqj5CCqdaQDPit19xd.jpg" alt="this is banner image">
                <div class="childbanner">
                    <h3>we teach student with projects and live classes</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="row c-one">
            <div class="col-md-6 c-two ">
                <img src="images/2149661462.jpg" alt="school image">
            </div>
            <div class="col-md-6 c-three">
                <h4>Oxford school Sonipat</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum modi, doloremque ipsam, quaerat, officiis provident dolore quis rerum dicta quidem ducimus ipsa? Labore rem reprehenderit perferendis officiis nemo quisquam earum?
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste, quam cupiditate? Blanditiis repudiandae dicta illum eum, asperiores ex quidem ratione quos eveniet suscipit, dolor illo ipsa doloremque dignissimos magnam tempora.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nostrum in harum unde amet dolore voluptates nam? Officiis, facere totam perspiciatis magnam numquam reprehenderit cumque! Maxime veniam omnis dignissimos tenetur!
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="row c-four">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 c-five ">
                <h4>Our Teachers</h4>
            </div>
        </div>
        <div class="row c-six">
            <!-- ye part humara backened se aa rha hai div humne html me bnaya or phir loop ko baar chlane k liye hum ne php k while loop
        ko lgaya jisse humara div tab tak create ho jab tak data khtm nhi hota.ye data humara addteacher.php se aa rha hai waha pe jo tum add kroge vo sara data yaha par dikhega. -->
            <?php
            while($row=mysqli_fetch_assoc($result)){
            ?>
            <div class="col-md-4 c-seven">
                <h4><?php echo $row['name'];?></h4>
                <img src=<?php echo $row['image'];?> alt="">
                <p ><?php echo $row['description'];?></p> 
            </div>
            <?php
            }
            ?>
        </div>  
    </div>
    <div class="container-fluid ">
        <div class="row c-four ourcourse">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 c-five ">
                <h4>Our courses</h4>
            </div>
        </div>
        <div class="row c-six">
<!-- ye humara php se aya hua data hai  -->
            <?php
            while($row=mysqli_fetch_assoc($result2)){
            // ?>
            <!-- div humne html me bnaya hai  -->
            <div class="col-md-4 c-seven">
                <h4><?php echo $row['name'];?></h4>
                <img src=<?php echo $row['image'];?> alt="">
                <p ><?php echo $row['description'];?></p> 
            </div>
            <!-- lekin isko print kaya humne php me  -->
            <?php
            }
            ?>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row c-eight">
            <h3>ADMISSION FORM</h3>
            <div class="col-md-6 c-nine">
                <form action="admissiondata.php" method="POST">
                    <div>
                        <label>Name:</label>
                        <input type="text" name="txtname" placeholder="Name">
                    </div>
                    <div>
                        <label>Email:</label>
                        <input type="email" name="txtemail" placeholder="Email">
                    </div>
                    <div>
                        <label>phone:</label>
                        <input type="tel" name="txtphone" placeholder="Phone">
                    </div>
                    <div>
                        <label>message:</label>
                        <textarea name="txtmsg" cols="50" placeholder="Comment Message"></textarea>
                    </div>
                    <div>
                        <input type="submit" name="submitbtn" value="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row c-ten">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 c-eleven">
                <h6>~||~ little stars come in our school and enjoy your daily life ~||~</h6>
            </div>
        </div>
    </div>
    <!-- bootstrap js file linked -->
    <script src="bootstrap-offline/bootstrap.bundle.min.js"></script>
</body>
</html>