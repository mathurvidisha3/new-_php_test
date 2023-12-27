<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}

$usernameErr=$passwordErr="";
$username=$password="";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    if(empty($_POST['username'])){
        $usernameErr="username is required";
    }else{
        $username=$_POST['username'];
    }

    if(empty($_POST['password'])){
        $passwordErr="password is required";
    }else{
        $password=$_POST['password'];
    }

}

if(empty($usernameErr) && empty($passwordErr) ){
    if(!empty($_POST['username'])){
        $sql= "INSERT INTO user_login (username,password)VALUES('".$_POST['username']."' , '".$_POST['password']."')";
        // print_r($sql);die;
        if($conn->query($sql)==true){
            echo"account created successfully";
        }else{
            echo"error".$sql.$conn->connect_error;
        }
    }
   
    
}
?>

<!DOCTYPE html>
<head> 
    <style>
        .error{
            color:red;
        }
    </style>

</head>
<body>
    <h3 style="font-size:25px"><b><u>Sign_up page:</u></b></h3>
    <p><span class="error"> *Mandatory fields</span></p>
    <form method="POST" action="<?php echo ($_SERVER['PHP_SELF'])?>">
    username:<input type="text" name="username" value="<?= isset($_POST['username'])?$_POST['username']:"";?>">
    <span class="error">*<?php echo $usernameErr;?></span>
    <br><br>
    password:<input type="password" name="password" value="<?= isset($_POST['password'])?$_POST['password']:"";?>">
    <span class="error">*<?php echo $passwordErr;?></span>
    <br>
    <br>
    <br>
    <button type="submit">Submit</button>

</body>
</html>
