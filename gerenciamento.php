<?php
require_once "./DB/conexion.php";
session_start();
$idsecretaria = $_SESSION['secid'];
$query = mysqli_query($conn, "SELECT `nome`, `matricula`, `email`, `senha`, `administrador`,`sec_sigla`, `usuarios`.`id` FROM `usuarios`, `secretarias` WHERE usuarios.id_secretaria = secretarias.id and secretarias.id = $idsecretaria ORDER BY `nome` ASC" );
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
  <title>Gerenciamento</title>
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
        <div class="">
        
      </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <?php echo $_SESSION['nomeusuario']; ?>
          <div class="d-flex menu">
            <button href="#" type="button" onclick="window.location.href='impressao.php'">
              <i class="bi bi-table fs-4 color-secondary"></i>
            </button>

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

          <span class="fs-2"> Tela do Administrador </span>
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
                      <th scope="col">Ações</th>
                     
                    </tr>
                  </thead>
                  <tbody id="gerenciamento-list">
                    
                  <?php foreach ($data as $user): ?>
                    
                      <?php if ($user["administrador"] != 2 && $user["administrador"] != 1): ?>
                        
                        <tr>
                        <td><a href="espelho.php?id=<?= $user['id']; ?>"><?= $user["nome"]; ?></a></td>
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
                          <td>
                          <a class='btn btn-sm btn-primary' href='editar.php?id=<?php echo $user["id"];?>' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                            </a> 
                            <a class='btn btn-sm btn-danger' href='delete.php?id=<?php echo $user["id"];?> ' title='Deletar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            </a>
                            </td>
                        
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
            <h5 class="modal-title" id="exampleModalLabel">Adicionar Estagiário</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="transaction-form">
            <div class="modal-body">

              <div class="mb-3">
                <label for="nome-input" class="form-label">Nome</label>
                <input type="text" step="any" class="form-control" id="nome-input" aria-describedby="emailHelp">
              </div>

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
  <script src="./js/gerenciamento.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</body>

</html>