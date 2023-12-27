<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}

if(!empty($_POST['username']) && !empty($_POST['password'])){
   $sql= "SELECT * FROM user_login where username='".$_POST['username']."' && password='".$_POST['password']."' " ;
    $result=$conn->query($sql) ;
if ($result->num_rows>0){
    SESSION_START();
    $_SESSION['sid']= session_id();
    // $_SESSION['login']= ['login'];
    $_SESSION['username']= $_POST['username'];
    $_SESSION['password']= $_POST['password'];
    // print_r($_SESSION);die;
  if( $_SESSION['username']=='admin' &&  $_SESSION['password']==$_POST['password']){
     header("location:./admin_page.php");
  }else if($_SESSION['username']==$_POST['username'] &&  $_SESSION['password']==$_POST['password']){
   
    
        header("location:./booking_page.php");
            }else{
                echo"no match found";
            }
        } else{
            echo"credential error";
        }
    }



?>

<!DOCTYPE html>
<head>
    <style>
        a:hover{
                color:green;
            
        }
    </style>
</head>
<body>
    <h3><b>Login Page:-</b></h3>
    <form method="POST" action="<?php echo($_SERVER['PHP_SELF'])?>">
    username:<input type="text" name="username">
    <br><br>
    password:<input type="password" name="password">
    <br>
    <br>
    <button type="submit">Login</button>
    <br>
    <br>
    <button type="submit"><a href="sign_up.php">Sign_up</a></button>

</body>
</html>
