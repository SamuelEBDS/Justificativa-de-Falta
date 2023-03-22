<?php
require_once "./DB/conexion.php";
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>Super Gerente</title>
</head>

<body id="app">
  <header>
    <nav class="navbar navbar-expand navbar-light bg-white">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="./assets/copia_de_seguranca_de_logo-final.png" alt="Image" height="350" width="350"
            postion="centered" srcset="" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <?php echo $_SESSION['nomeusuario']; ?>
         
          <div class="dropdown">
              <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-person-circle fs-4"></i></button>
              <ul class="dropdown-menu logout" aria-labelledby="dropdownMenuButton1">
                <li><button class="dropdown-item" id="button-logout">Sair</button></li>

              </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="container-lg">
      <div class="row">
        <div class="col d-flex mt-4 justify-content-start align-items-center" postion=center>

          <span class="fs-2"> Tela do Super Administrador </span>
        </div>
        <div class="col d-flex mt-4 justify-content-end">
          <div class="text-center">
          </div>
        <div class="col d-flex mt-4 justify-content-end">
          <div class="text-center">

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 info shadow-lg">
          <div class="container">
            <div class="row">
              <div class="col">
                <table class="table">
                  <tbody id="gerenciamento-list">
                <tr>
                    <td><a href="cadastrosec.php"> Cadastramento secretária </a></td>
                </tr>
                <tr>
                     <td><a href="CadastrarAdmin.php">Cadastrar Administrador </a></td>
                </tr>
                </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="js\telasuper.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</body>

</html>