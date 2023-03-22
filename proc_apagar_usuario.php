<?php
session_start();
require_once "./DB/conexion.php";
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)){
	$result_usuario = "DELETE FROM `horarios`(`data`, `hentrada`, `hsaida`, `justificativa`,`anexo` ,`usuario_id`) WHERE ('$dados->data','$dados->hentrada','$dados->hsaida','$dados->justificativa','$dados->anexo','$dados->id_usuario')";
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "<p style='color:green;'>Usuário apagado com sucesso</p>";
		header("Location: transactions.php?id= . $dados->id_usuario");
		
	}else{
		
		$_SESSION['msg'] = "<p style='color:red;'>Erro o usuário não foi apagado com sucesso</p>";
		header("Location: transactions.php?id= . $dados->id_usuario");
	}
}else{	
	$_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um usuário</p>";
	header("Location: transactions.php?id= . $dados->id_usuario");
}



?>