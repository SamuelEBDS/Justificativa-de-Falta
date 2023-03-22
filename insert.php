<?php

require_once "./DB/conexion.php";

// Escape user inputs for security
$usuario = $_POST['data'];
$dados = json_decode($usuario);


  
 // Attempt insert query execution
$sql = "INSERT INTO `usuarios`(`nome`, `email`, `matricula`, `senha`, `id`, `administrador`, `id_secretaria`) VALUES('$dados->nome','$dados->email','$dados->matricula','$dados->senha',null,1,$dados->secretaria)";

if(mysqli_query($conn, $sql)){
    header("Location: CadastrarAdmin.php");
} else{
    echo "ERROR. could not able to execute $sql." . mysqli_error($conn);
}




//close connection
mysqli_close($conn);

?>
