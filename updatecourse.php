<?php
error_reporting(0);
$host="localhost";
$username="root";
$password="";
$db="schoolproject";
$cn=mysqli_connect($host,$username,$password,$db)or die('connection failed');
$id=$_POST['courseid'];
$name=$_POST['coursename'];
$description=$_POST['coursedescription'];
// $newimage=$_FILES['newimgupldinpt']['name'];
$path='uploadcourseimages/';
                $filename=$_FILES['newcourseimgupldinpt']['name'];
                $filecontent=$_FILES['newcourseimgupldinpt']['tmp_name'];
                $filetype=$_FILES['newcourseimgupldinpt']['type'];
                $filesize=$_FILES['newcourseimgupldinpt']['size'];
                $fileerror=$_FILES['newcourseimgupldinpt']['error'];
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
                $sql="update course set name='$name',description='$description',image='$filepath' where id='$id'";
                $result=mysqli_query($cn,$sql)or die('sql query error');
                if($result){
                    echo"course data update successfully";
                    header("location:viewcourses.php");
                }
                else{
                    echo"no updated course data succesfully";
                }
?>