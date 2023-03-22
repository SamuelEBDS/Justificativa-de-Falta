<?php
require_once "./DB/conexion.php";

if(isset($_GET['update']))
{ 
    $id = $_GET['id'];
    $nome = $_GET["nome"];
    $matricula = $_GET["matricula"];
    $email = $_GET["email"];
    $senha = $_GET["senha"];

    $sqlUpdate = "UPDATE `usuarios` SET `nome`= '$nome', `email`= '$email', `matricula`= '$matricula', `senha`= '$senha' WHERE id='$id'";

    $result = $conn->query($sqlUpdate);

    if ($result) {
        header('Location: gerenciamento.php');
    } 
    
} 
?>
