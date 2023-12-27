<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}

if(!empty($_POST['centre_name'])){
    $sql= "INSERT INTO user_dashboard (centre_name,timings) VALUES('".$_POST['centre_name']."','".$_POST['timings']."')";
    if($conn->query($sql)===TRUE){
      echo"inserted successfully";
    }else{
        echo"error".$sql.$conn->connect_error;
    }
}
?>

<!DOCTYPE html>
<head>
    <title>add_centres & timings</title>
</head>
<body>
<form method="POST" action=<?php echo ($_SERVER['PHP_SELF'])?>>
centre_name:<input type="text" name="centre_name">
<br>
<br>
timings:<input type="radio" name="timings" value="9AM to 5PM">9AM to 5PM
<input type="radio" name="timings" value="10AM to 6PM">10AM to 6PM
<br><br>
<input type="submit" name="submit">
</body>
</html>