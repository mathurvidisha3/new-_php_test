<?php
$servername="localhost";
$username="root";
$password="";
$dbname="vac_booking";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
     die("connection_failed:".$conn->connect_error);
}

$table1="centres";
$table2="dose";
$colname1="centre_name";
$colname2="centre_name";
$colname3="doses";
$colname4="id";
$sql= "SELECT ".$table2.".".$colname4.",".$table2.".".$colname2.",".$table2.".".$colname3." ,CONCAT(".$table1.".".$colname1.")FROM ".$table2." INNER JOIN ".$table1." ON ".$table1.".".$colname1."=".$table2.".".$colname2." GROUP BY ".$table2.".".$colname3."";
// print_r($sql);die;
$result= $conn->query($sql);
// print_r($result);die;
if($result->num_rows>0){
     $rows= $result->FETCH_ALL(MYSQLI_ASSOC);
     // print_r($rows);die;
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
     <h3 style="color:blue; margin-left: 500px;"><u>Centre_wise Doses</u></h3>
     <br>
     <button class="a"><a href="new_centre_add.php">Add_centres</a></button>
     <br>
     <table width=100% border=1%><br>
          <tr>
               <th>id</th>
              <th>centre_name</th>
               <th>Doses</th>
               <th>Action</th>
          </tr>
         <?php if(!empty($rows)){?>
               <?php foreach($rows as $key=> $value){?>
               <tr>
                    <td><?= $value['id']?></td>
                    <td ><?= $value['centre_name']?></td>
                    <td><?= $value['doses']?></td>
                    <td><a href="delete_centre.php?id=<?=$value['id']?>"><button type=delete onclick="return confirm('Are you sure you want to delete')">Delete</button><a></td>
                </tr>
               <?php }
          }else{?>
               <tr><td col span=2>no record found...</td></tr>
         <?php }?>
              

     </table>

</body>
</html>

