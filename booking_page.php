<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}

$sql="SELECT * FROM centres";
$all_centres=$conn->query($sql);

$today = date("y-m-d");
$sql="SELECT * FROM user_details where date(created_at)='$today'";
$result=$conn->query($sql);
// print_r($result);die;
if($result->num_rows<10){//only 10 enteries per day
    if(!empty($_POST['firstname'])){  
        //    print_r($_POST);die; 
        $sql= "INSERT INTO user_details (firstname,lastname,centre_name,slot,booking_date,created_at)VALUES('".$_POST['firstname']."','".$_POST['lastname']."','" .$_POST['centre_name']."','".$_POST['slot']."','".$_POST['booking_date']."','".$today."')";
    //    print_r($sql);die;
        if($conn->query($sql)==TRUE){
             echo "inserted successfully";
    //    header("location:./booking_page.php");
        }else{
            echo"error".$sql.$conn->connect_error;
        }
      } 
}else{
    echo"Form section is closed for today";
  }

?>

<!DOCTYPE html>
<head>
    <title>Booking section</title>
</head>
<body>
    <h3>Booking section</h3>
    <form method="POST">
    firstname:<input type="text" name="firstname">
    <br>
    </br>
    lastname:<input type="text" name="lastname">
    <br>
    </br>
    <label>centres:</label>
        <select name="centre_name">
        <?php 
                // use a while loop to fetch data 
                // from the $all_centre variable 
                // and individually display as an option
                while ($centre = mysqli_fetch_array(
                        $all_centres,MYSQLI_ASSOC)):; 
            ?>
             <option value="<?php echo $centre["centre_id"];
                    // The value we usually set is the primary key
                ?>">

            <?php echo $centre["centre_name"];
                        // To show the category name to the user
                    ?>
                </option>
                <?php 
                endwhile; 
                
            ?>
        </select>
    
    <br>
    </br>
    slot:<input type="radio" name="slot" value="9AM-12PM">9AM-12PM
        <input type="radio" name="slot" value="12PM-3PM">12PM-3PM
        <input type="radio" name="slot" value="3PM-6PM">3PM-6PM
    </br>
    </br>
    booking_date:<input type="date" name="booking_date">
    <br>    
    <br>
    <br>
 <input type="submit" name="submit">
 </form>   
</body>
</html>


