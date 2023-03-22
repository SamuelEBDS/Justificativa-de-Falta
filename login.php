<?php 
    require_once "./DB/conexion.php";
?>

<!DOCTYPE html>

<html>
  
<head>
    <title>Transactions Page</title>
</head>
  
<body>
    <center>
        <?php
        
        session_start();
       
        // Taking all 5 values from the form data(input)
       
        $matricula = $_POST['matricula']; 
        $senha = $_POST['senha'];
           

        // Performing select query execution
        // here our table name is college
        //colocar os links do acesso de ddeterminado administrador
        $sql = "SELECT * FROM usuarios  WHERE matricula = '$matricula' and senha = '$senha'";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);

            $_SESSION['idusuario'] = $row['id'];
            $_SESSION['nomeusuario'] = $row['nome'];
            $_SESSION['secid'] = $row['id_secretaria'];


            if ($row["administrador"] == 1) {
                header("Location: gerenciamento.php");
            } elseif ($row["administrador"] == 0) {
                header("Location: transactions.php?id=" . $row['id']);
            } elseif ($row["administrador"] == 2) {
                header("Location: teladosuperadmin.php?id=" . $row['id']);
            } else {
                echo "ERROR: Login failed. User or password error. Query: $sql. Error: " . mysqli_error($conn);
            }
        }

        if ($result->num_rows > 0) {
            // O login é bem-sucedido. Defina as variáveis de sessão e redirecione o usuário.
          } else {
            // O login falha. Defina a mensagem de erro e exiba um alerta na página de login.
            $error_message = "Usuário ou senha incorretos. Tente novamente.";
            echo "<script>alert('{$error_message}');</script>";
            header("Location: index.html?error_message=" . urlencode($error_message));
          }


       
          
        // Close connection
        mysqli_close($conn);
        ?>
    </center>
</body>
  
</html>
