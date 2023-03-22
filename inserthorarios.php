<?php
 
require_once "./DB/conexion.php";

// Escape user inputs for security
$dados = (object)$_POST;
$attachment = $_FILES["attachment"];

if(empty($attachment["name"])){
    $dados->anexo = "";

}else{

    //verficando se a pasta files existe, se nao existir, cria
    $dir = __DIR__ . "/files";

    if(!is_dir($dir)){
        mkdir($dir);
    }

    //criando nome unico pro arquivo
    $ext = pathinfo($attachment["name"], PATHINFO_EXTENSION);
    $filename = md5($attachment["name"] . time() . uniqid());
    $dados->anexo = "$filename.$ext";
    move_uploaded_file($attachment["tmp_name"], $dir . "/$dados->anexo");

}


if (headers_sent()) {
  die("Redirecionamento falhou. Por favor, clique neste link: <a href='transactions.php'>transactions.php</a>");
}

// Attempt insert query execution
$sql = "INSERT INTO `horarios`(`data`, `hentrada`, `hsaida`, `justificativa`,`anexo` ,`usuario_id`) VALUES ('$dados->data','$dados->hentrada','$dados->hsaida','$dados->justificativa','$dados->anexo','$dados->id_usuario')";



if(mysqli_query($conn, $sql)){
    header("Location: transactions.php?id=" . $dados->id_usuario);
    exit;
} else{
    echo "ERRO. Não foi possível executar $sql.".mysqli_error($conn);
}
//close connection
mysqli_close($conn);

?>
