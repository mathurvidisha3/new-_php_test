<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}

$centrErr="";
$centre_name="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST['centre_name'])){
        $centrErr="Fill out this field";
    }else{
        $centre_name=$_POST["centre_name"];
        if(!preg_match("/^[a-zA-Z ]*$/",$centre_name)){
            $centrErr="only alphabets & whitespaces are allowed";
        }
    }
}

if(empty($centrErr)){
    if(!empty($_POST['centre_name'])){
        $sql= "INSERT INTO centres (centre_name) VALUES('".$_POST['centre_name']."')";
        if($conn->query($sql)===TRUE){
          header("location:./admin_page.php");
        }else{
            echo"error".$sql.$conn->connect_error;
        }
    }
}

?>

<!DOCTYPE html>
<head>
    <title>add_centres</title>
    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>
<h2>Add centres</h2>
<h4 span class="error">*Mandatory fields</h4>
<form method="POST" action=<?php echo ($_SERVER['PHP_SELF'])?>>
centre_name:<input type="text" name="centre_name">
<span class="error">* <?php echo $centrErr?></span>
<br>
<br>
<input type="submit" name="Add">
</body>
</html>