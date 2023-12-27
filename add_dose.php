<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}

$centrErr=$doseErr="";
$centre_name=$dose="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST['centre_name'])){
        $centrErr="Fill out this field";
    }else{
        $centre_name=$_POST["centre_name"];
        if(!preg_match("/^[a-zA-Z ]*$/",$centre_name)){
            $centrErr="only alphabets & whitespaces are allowed";
        }
    }

    if(empty($_POST['dose'])){
        $centrErr="Fill out this field";
    }else{
        $dose=$_POST["dose"];
        if(!preg_match("/^[a-zA-Z ]*$/",$centre_name)){
            $centrErr="only alphabets & whitespaces are allowed";
        }
    }
}


if(!empty($_POST)){
    $sql= "INSERT INTO dose (centre_name,dose)VALUES('".$_POST['centre_name']."','".$_POST['dose']."')";

    if($conn->query($sql)==TRUE){
        header("location:./booking_page.php");
    }else{
        echo"error".$sql.$conn->connect_error;
    }
}
?>

<!DOCTYPE html>
<head>
    <title>add_dose</title>
</head>
<body>
<h3>Add Doses </h3>
<form method="POST" action=<?php echo ($_SERVER['PHP_SELF'])?>>
centre_name:<input type="text" name="centre_name">
<br>
<br>
Dose_quantity:<input type="text" name="dose">
<br>
<br>
<input type="submit" name="Add">
</body>
</html>