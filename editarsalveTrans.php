<?php
require_once "./DB/conexion.php";

if(isset($_POST['update']))
{ 
                $id = $_POST["id"];
             //   $user_id =  $_POST['usuario_id'];
                $datas = $_POST["data"];
                $hentrada = $_POST["hentrada"];
                $hsaida = $_POST["hsaida"];
                $justificativa = $_POST["justificativa"];
               

    $sqlUpdate = "UPDATE `horarios` SET  `data`='$datas',`hentrada`='$hentrada',`hsaida`='$hsaida',`justificativa`='$justificativa'  WHERE id= '$id'";

    $result = $conn->query($sqlUpdate);

   if ($result) {
        header("Location: editarTrans.php?id=  " . $user_id );
    
} 
}
?>
