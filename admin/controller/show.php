<?php 
include_once '../model/db_config.php';
$query="select * from products_typs";
$execute=mysqli_query($link,$query);
if($execute->num_rows > 0 ){
    while($row=$execute->fetch_assoc()){
        echo '<tr>';
            echo '<td>'.$row['product_name'].'</td>';
            echo '<td>'.$row['product_code'].'</td>';
            echo '<td>'.'Edit'.'</td>';
            echo '<td>'.'Delete'.'</td>';
        echo '</tr>';
     }
    }
?>  