<?php
 
require_once "./DB/conexion.php";
session_start();
$idsecretaria = $_SESSION['secid'];

// Escape user inputs for security
$usuario = $_POST['data'];
$dados = json_decode($usuario);

  
 // Attempt insert query execution
$sql = "INSERT INTO usuarios (id,nome, email, matricula, senha, administrador,id_secretaria) VALUES(NULL,'$dados->nome','$dados->email','$dados->matricula','$dados->senha', 0, $idsecretaria)";

if(mysqli_query($conn, $sql)){
    header("Location: gerenciamento.php");
} else{
    echo"ERROR. could not able to execute $sql.".mysqli_error($conn);
}


//close connection
mysqli_close($conn);

?>
