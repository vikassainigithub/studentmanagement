<?php
$host="localhost";
$username="root";
$password="";
$db="schoolproject";
$cn=mysqli_connect($host,$username,$password,$db)or die('connection failed');
$id=$_POST['txtid'];
$name=$_POST['txtteachername'];
$description=$_POST['txtdescription'];
$newimage=$_FILES['newimgupldinpt']['name'];
$path='uploadimages/';
                $filename=$_FILES['newimgupldinpt']['name'];
                $filecontent=$_FILES['newimgupldinpt']['tmp_name'];
                $filetype=$_FILES['newimgupldinpt']['type'];
                $filesize=$_FILES['newimgupldinpt']['size'];
                $fileerror=$_FILES['newimgupldinpt']['error'];
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
                $sql="update teacher set name='$name',description='$description',image='$filepath' where id='$id'";
                $result=mysqli_query($cn,$sql)or die('sql query error');
                if($result){
                    echo"student data update successfully";
                    header("location:viewteacher.php");
                }
                else{
                    echo"no updated teacher data succesfully";
                }
?>