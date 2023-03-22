<?php
require_once "./DB/conexion.php";
session_start();


  $id = $_GET['id'];


    $sqlSelect = "SELECT * FROM horarios WHERE id=$id";

    $result = $conn->query($sqlSelect);

   

  if($result->num_rows > 0)
  {
        while($data = mysqli_fetch_assoc(($result)))
        {
                
                $datas = $data["data"];
                $hentrada = $data["hentrada"];
                $hsaida = $data["hsaida"];
                $justificativa = $data["justificativa"];
               
              
    }
    
  }else{
    header('location:  transactions.php');

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
        <p><a href="transactions.php" method="POST">Voltar</a></p>
    </div>   
              
    
        
    
    </nav>
  </header>
  <main>
    <div class="container-lg">
      <div class="row">
        <div class="col d-flex mt-4 justify-content-start align-items-center" postion=center>

          <span class="fs-2"> Editar horario </span>
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
              <form id = transactions-form action="editarsalveTrans.php" method="POST">

                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="value-input_1" class="form-label">Horario entrada</label>
                                <input name="hentrada" type="time" step="any" class="form-control"  value="<?php echo $hentrada ?>" id="nome-input" aria-describedby="emailHelp">
                            </div>
                            
                            <div class="mb-3">
                                <label for="value-input_2" class="form-label">Horario saída</label>
                                <input required name="hsaida"  type="time" step="any" class="form-control" value="<?php echo $hsaida ?>"
                                    id="value-input_2" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label for="description-input" class="form-label">Justificativa</label>
                                <input required name="justificativa"  type="text" class="form-control" value="<?php echo $justificativa ?>"
                                    id="description-input">
                            </div>

                            <div class="mb-3">
                                <label for="date-input" class="form-label">Data</label>
                                <input required name="data"  type="date" class="form-control" id="date-input" value="<?php echo $datas ?>"> 
                            </div>

                            <div classs="mb-3">
                                <input type="file" name="attachment">

                            </div>

                            
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
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