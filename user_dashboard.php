<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}


$centre_name="";
if(!empty($_REQUEST['centre_name'])){
    $centre_name= $_REQUEST['centre_name'];
}

if(empty($_POST) && isset($_GET['page'])){
  $page = $_GET['page'] ;//

} else {
  $page= 1;
}

$result_per_page= 4;
$result_first_page = ($page-1) * 4;

$where= 'where 1=1';//to get true
if($centre_name!=""){
    $where.= " and centre_name like'%".$centre_name."%'";//to match
}

$sql="SELECT * FROM user_dashboard ";
$result= $conn->query($sql);
$result_rows= $result->num_rows;
$num_of_page=ceil($result_rows/$result_per_page);
$rows=[];


$sql=" SELECT * FROM user_dashboard " .$where. " LIMIT " .$result_first_page. ',' .$result_per_page;
$result= $conn->query($sql);
if($result->num_rows>0){
   $rows=$result->FETCH_ALL( MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<head>
    <style>
        .a{
           background-color:pink;
           border-radius:25px;
            margin:20px;
            padding:20px; 
        }

        a:hover{
          text-decoration:none;
          color:white;
        }

        td:nth-child(odd){
          background-color:lightseagreen;
        }

        td:nth-child(even){
          background-color:lightcoral;
        }

       body{
          background-color:lightblue;
         
       }

        
    </style>
</head>
<body>
<form method="POST">
centre_name:<input type="text" name="centre_name" >
        <input type="submit" value="search">
</form>
    
     <table width=100% border=1%><br>
          <tr>
            <th>centre_name</th>
            <th>timings</th>
            <th>Action</th>
          </tr>

          <?php if(!empty($rows)){?>
            <?php foreach($rows as $key=>$value){?>
            <tr>
                <td><?=$value['centre_name']?></td>
                <td><?=$value['timings']?></td>
                <td><a href="booking_page.php">book_now</a></td>
            </tr>
            <?php }
          }else{?>
          <tr><td colspan=2>no data found... </td></tr>
            <?php } ?>

        </table>

        <?php
        for($page='1';$page<=$num_of_page;$page++){
          $link="user_dashboard.php?page=".$page. 'and centre_name='.$centre_name;
          echo' <a href="'.$link.'">'.$page.'</a>';
          }
        ?>
    </body>
    </html>


