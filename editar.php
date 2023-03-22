<?php
require_once "./DB/conexion.php";
session_start();

if(!empty($_GET['id']))
{
    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";

    $result = $conn->query($sqlSelect);

    print_r($result);
    
    if($result-> num_rows > 0)
    {
        while($user = mysqli_fetch_assoc(($result)))
        {

                $nome = $user["nome"];
                $matricula = $user["matricula"];
                $email = $user["email"];
                $senha = $user["senha"];
        

        }

}else{
    header('location: gerenciamento.php');
}

}



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
       
    <div  >
        <p><a href="gerenciamento.php" method="POST">Voltar</a></p>
    </div>   
              
    
        
    
    </nav>
  </header>
  <main>
    <div class="container-lg">
      <div class="row">
        <div class="col d-flex mt-4 justify-content-start align-items-center" postion=center>

          <span class="fs-2"> Editar Usuário </span>
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
              <form id="transaction-form" action ="editarsalve.php" method="GET">
            <div class="modal-body">

              <div class="mb-3">
                <label for="nome-input" class="form-label">Nome</label>
                <input type="text" step="any" class="form-control" value="<?php echo $nome ?>" id="nome-input" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="matricula-input" class="form-label">Matricula</label>
                <input type="text" step="any" class="form-control" value="<?php echo $matricula ?>" id="matricula-input" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="email-input" class="form-label">email</label>
                <input type="email" step="any" class="form-control" id="email-input" value="<?php echo $email?>" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="senha-input" class="form-label">Senha</label>
                <input type="number" step="any" class="form-control" id="senha-input" value="<?php echo $senha ?>" aria-describedby="emailHelp">
              </div>                
 
              <div class="mb-3">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="submit" name="update" id="update">
              </div>
          </form>                
              </div>
            </div>
          </div>
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