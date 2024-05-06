<?php
session_start();
// yaha par hum apna database connect krenge.
// humne database connection ki file bna rakh ki hai alg se usko yaha par include krenge.
// jab bhi hume database connect krna hoga to hum usko use krenge 
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$cn=mysqli_connect($host,$user,$password,$db);
if($cn===false){
    die("connection error");
}
// else{
//     echo"connection ok";
// }
if(isset($_POST['submitbtn'])){
    $admissionname=$_POST['txtname'];
    echo $admissionname;
    $admissionemail=$_POST['txtemail'];
    echo $admissionemail;
    $admissionphone=$_POST['txtphone'];
    echo $admissionphone;
    $admissionmsg=$_POST['txtmsg'];
    echo $admissionmsg;
    $sql="insert into admission(name,email,phone,message) values('$admissionname','$admissionemail',$admissionphone,'$admissionmsg')";
    $result=mysqli_query($cn,$sql) or die("sql query error");
    if($result){
        // echo"admission successfuly";
        $_SESSION['messagesuccess']="admission successfuly";
        header("location:index.php");
    }
    else{
        echo "no admission succcessfully";
    }
}
mysqli_close($cn);
?>
