<?php
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$cn=mysqli_connect($host,$user,$password,$db);
if($cn===false){
    die("connection error");
}
?>