<?php
 
require_once "./DB/conexion.php";

// Escape user inputs for security
$nome = $_POST['sec_nome'];
$sigla = $_POST['sec_sigla'];
// Attempt insert query execution
$sql = "INSERT INTO `secretarias` (`id`, `sec_nome` , `sec_sigla`) VALUES (null, '$nome', '$sigla')";



if(mysqli_query($conn, $sql)){
    header("Location: cadastrosec.php");
} else{
    echo "ERROR. Não foi possível executar $sql. " . mysqli_error($conn);
}

//close connection
mysqli_close($conn);

?>
