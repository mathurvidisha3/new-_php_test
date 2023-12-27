<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}

if(!empty($_POST)){
 
     $sql= "INSERT INTO calender (booking_date)VALUES('".$_POST['booking_date']."')"; 
     if($conn->query($sql)==TRUE){
         echo"inserted successfully";
      }else{
          echo"error".$sql.$conn->connect_error;
      }
    }

?>

<!DOCTYPE html>
<body>
  <form method="POST">
              book_date:<input type="date" name="booking_date">
              <br>
              <br>
              <button type="submit">Save</button>
  </form>
                         
                     
                      
               
        
     </body>

