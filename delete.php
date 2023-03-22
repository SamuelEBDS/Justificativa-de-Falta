<?php
require_once "./DB/conexion.php";
session_start();
$idsecretaria = $_SESSION['secid'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Attempt select query execution
    $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
    $resultSelect = $conn->query($sqlSelect);

    if ($resultSelect !== false && $resultSelect->num_rows > 0) {
        // Attempt delete query execution
        $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
        $resultDelete = $conn->query($sqlDelete);

        if ($resultDelete) {
            header("Location: gerenciamento.php");
        } else {
            echo "ERROR. Could not execute $sqlDelete. " . mysqli_error($conn);
        }
    } else {
        echo "No user found with id $id.";
    }
} else {
    echo "No user id provided.";
}

mysqli_close($conn);
