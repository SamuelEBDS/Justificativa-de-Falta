<?php
require_once "./DB/conexion.php";


if (!empty($_GET['id'])) {


    $id = $_GET['id'];

 
   
    $sqlSelect = "SELECT * FROM horarios WHERE id= $id";    

   
    $result = $conn->query($sqlSelect);


    if ($result->num_rows > 0) 
    {
        
        $sqlDelete = "DELETE FROM horarios WHERE id=$id";
        $resultSelect = $conn->query($sqlDelete);
             
        }
    }



    header('Location: transactions.php?id=5');

?>
