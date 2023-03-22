<?php
require_once "./DB/conexion.php";
session_start();
$idsecretaria = $_SESSION['secid'];
$query = mysqli_query($conn, "SELECT `nome`, `matricula`, `email`, `senha`, `administrador`,`sec_sigla`, `usuarios`.`id` FROM `usuarios`, `secretarias` WHERE usuarios.id_secretaria = secretarias.id ORDER BY `nome` ASC" );
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
  <title>Cadastramento de administradores</title>
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
      </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="container-lg">
      <div class="row">
        <div class="col d-flex mt-4 justify-content-start align-items-center" postion=center>

          <span class="fs-2"> Cadastramento de administrador</span>
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
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Matricula</th>
                      <th scope="col">Email</th>
                      <th scope="col">Senha</th>
                      <th scope="col">Secretaria</th>

                    </tr>
                  </thead>
                  <tbody id="gerenciamento-list">
                    <?php foreach ($data as $user): ?>
                    
                      <?php if ($user["administrador"] != 2 && $user["administrador"] != 0): ?>

                        <tr>
                          <td><?= $user["nome"]; ?> </td> 
                          <td>
                            <?= $user["matricula"]; ?>
                          </td>
                          <td>
                            <?= $user["email"]; ?>
                          </td>
                          <td>
                            <?= $user["senha"]; ?>
                          </td>
                          <td>
                            <?= $user["sec_sigla"]; ?>
                          </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="btn button-float" data-bs-toggle="modal" data-bs-target="#transaction-modal"><i
          class="bi bi-plus"></i></button>
    </div>

    <!--Modal-->
    <div class="modal fade" id="transaction-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar lançamentos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="transaction-form">
            <div class="modal-body">

              <div class="mb-3">
                <label for="nome-input" class="form-label">Nome</label>
                <input type="text" step="any" class="form-control" id="nome-input" aria-describedby="emailHelp">
              </div>

              <!---->
              <div class="mb-3">
                <label for="matricula-input" class="form-label">Matricula</label>
                <input type="text" step="any" class="form-control" id="matricula-input" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="email-input" class="form-label">email</label>
                <input type="email" step="any" class="form-control" id="email-input" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="senha-input" class="form-label">Senha</label>
                <input type="number" step="any" class="form-control" id="senha-input" aria-describedby="emailHelp">
              </div>

             <div class="mb-3">
                <label for="sec-input" class="form-label">secretarias</label>
                <select class="form-control" id="sec-input">
              
                  <?php

                    $scquery = mysqli_query($conn, "SELECT * FROM secretarias ORDER BY sec_nome");
                    $secs = mysqli_fetch_all($scquery, MYSQLI_ASSOC);
                  ?>      
                    <?php foreach ($secs as $scuser):?>                   
                    <option value="<?= $scuser["id"]; ?>"><?= $scuser["sec_nome"]; ?></option>

                    <?php endforeach; ?>
                </select>
                    </div>   

      
             
            
                    <div class="modal-footer">
                <button type="button" class="btn button-cancel" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-default">Adicionar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="./js/sugerenciamento.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</body>

</html>