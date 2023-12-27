<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}

$sql= "DELETE  FROM dose where id=" .$_GET['id'];
if($conn->query($sql)==TRUE){
    header("location:./admin_page.php");
}else{
    echo"error".$sql.$conn->connect_error;
}
?>