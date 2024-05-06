<?php
session_start();

include("database_connection.php");
// or 
// humne niche wale code ki jgah upar file include kr di hai.jisme database connection hai i
// $host="localhost";
// $user="root";
// $password="";
// $db="schoolproject";
// $cn=mysqli_connect($host,$user,$password,$db);
// if($cn===false){
//     die("connection error");
// }

if(isset($_SERVER["REQUEST_METHOD"])=="POST"){
    // yaha par user jo bhi apna naam bhrega form me vo yaha akar savew hoga
    // iss name ki value humne form k andar name attribute se li hai 
    $name=$_POST['username'];
    $passwrd=$_POST['password'];
    $sql="select * from user where username='$name' AND password='$passwrd'";
    $result=mysqli_query($cn,$sql) or die("sql query error");
    $row=mysqli_fetch_array($result);
    if($row["usertype"]=="student"){
        // ye 1 wala or 1.1 wala ye humne baad me add kiya hai yani ki humne ye session baad me create kiya hai taki adminhome.page koi access na kr ske 
        //1 yaha par humne session bnaya hai.yadi hum sessoin nhi bnate to koi bhi humare page k andar aa skta hai yani ki access kr skta hai
        // yaha par humne kya kiya jis naam se humne login kiya hai us naam ko humne session bnakr usme store kr liya hai ab hum uss session ko use krenge yani ki jab hume login krne wale ki profile pr jana hai to hum iss session k through jayenge.
        // kyuki humne iss session uska naam store kr liya hai ab jo bhi naam se login krega vo naam iss session me store ho jayega 
        // phir hum select * from user or phir iske baad hum username=$name k barabar likh denge to uska data aa jayega 
        $_SESSION['username']=$name;
        //1.1 usertype humne table se uthaya hai kyuki select * from krne se puri table ka data or uske row-attribute aa jate hai
        $_SESSION['usertype']="student";
        // ab humara ye page login kiye bina access nhi hoga
        header("location:studenthome.php");
    }
    elseif($row["usertype"]=="admin"){
        // ye 1 wala or 1.1 wala ye humne baad me add kiya hai yani ki humne ye session baad me create kiya hai taki adminhome.page koi access na kr ske 
        //1. yaha par humne session bnaya hai.yadi hum sessoin nhi bnate to koi bhi humare page k andar aa skta hai yani ki access kr skta hai
        $_SESSION['username']=$name;
        //1.1 usertype humne table se uthaya hai kyuki select * from krne se puri table ka data or uske row-attribute aa jate hai
        $_SESSION['usertype']="admin";
        // ab humara ye page login kiye bina access nhi hoga
        header("location:adminhome.php");
    }
    // elseif($name || $passwrd===""){
    //         $loginfailed="TO login please fill username or password";
    //         $_SESSION['loginmessage']=$loginfailed;
    //         header("location:login.php");
    //     }
    else{
        $loginfailed="To login please fill username or password.";
        // yaha par humne session bnaya hai ab isko laageyenge dusre page par ye session humne isiliye lgaya hai taki hum error dikha ske kyuki humne iss session k andar error message store kiya hai.  
        $_SESSION['loginmessage']=$loginfailed;
        header("location:login.php");
    }
}
?>