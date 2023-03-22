<?php
require_once "./DB/conexion.php";
$query = mysqli_query($conn, "SELECT * FROM secretarias ");
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

          <span class="fs-2"> Cadastro de Secretárias </span>
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
                    <th scope="col">ID</th>
                      <th scope="col">Nome</th>
                      <th scope="col">Sigla</th>
                    </tr>

                  </thead>
                  <tbody id="gerenciamento-list">
                    <?php foreach ($data as $user): ?>
                      
                        <tr>
                          <td><?= $user["id"]; ?> </td>
                          <td>
                            <?= $user["sec_nome"]; ?>
                          </td>
                          <td>
                            <?= $user["sec_sigla"]; ?>
                          </td>
                        </tr>
                   
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
  </main>
  
        <!--Modal-->
        <div class="modal fade" id="transaction-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Adicionar lançamentos </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="insertsec.php" id="transaction-form" enctype="multipart/form-data">

                            <!---->
                            <div class="mb-3">
                                <label for="value-input_2" class="form-label"> Nome da Secretaria </label>
                                <input required name="sec_nome" type="text" step="any" class="form-control"
                                    id="value-input_2" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label for="description-input" class="form-label"> Sigla da Secretaria </label>
                                <input required name="sec_sigla" type="text" class="form-control"
                                            id="value-input_2"  id="description-input">
                                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn button-cancel"
                                    data-bs-dismiss="modal">Cancelar</button>
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
  <script src="./js/secretaria.js"></script>
 



</body>

</html>