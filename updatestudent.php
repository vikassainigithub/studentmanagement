<?php
$host="localhost";
$username="root";
$password="";
$db="schoolproject";
$cn=mysqli_connect($host,$username,$password,$db)or die('connection failed');
$id=$_POST['txtid'];
$username=$_POST['txtusername'];
$phone=$_POST['txtphone'];
$email=$_POST['txtemail'];
$usertype=$_POST['txtusertype'];
$password=$_POST['txtpassword'];
$sql="update user set username='$username',phone=$phone,email='$email',usertype='$usertype',password='$password' where id=$id";
$result=mysqli_query($cn,$sql)or die('sql query error');
if($result){
    echo"student data update successfully";
    header("location:viewstudent.php");
}
else{
    echo"no updated student data succesfully";
}
?>