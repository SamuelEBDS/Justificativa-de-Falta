<?php
session_start();
$secretaria = $_SESSION['secid'];
require_once "./DB/conexion.php";
$query = mysqli_query($conn, "SELECT * FROM usuarios where administrador != 1 and administrador != 2 and id_secretaria = $secretaria ORDER BY `nome` ASC");
//$query = mysqli_query($conn, "SELECT * FROM usuarios");
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

$query = mysqli_query($conn, "SELECT * FROM secretarias where id = $secretaria");

$data_secretaria = mysqli_fetch_assoc($query);

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');


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
    <link rel="stylesheet" href="css/print.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" >
   

</head>
<body id="app">
    <header>
        <nav class="navbar navbar-expand navbar-light bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" >
                
                    <img src="./assets/topo-esquerdo.png" alt="Image" height="350" width="350"
                        postion="centered" srcset="" class="img-fluid print" >
                    <img src="./assets/topo-direito.png" alt="Image" height="350" width="350"
                        postion="centered" srcset="" class="img-fluid hide-on-screen print" >
                    <img src="./assets/topo.png" alt="Image" height="4000" width="4000"
                        postion="centered" srcset="" class="img-fluid hide-on-screen" >
                    
                    </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end print" id="navbarSupportedContent">
                    <div class="d-flex menu print">
                        <button onclick="window.print()" class="print" type="button"><i
                                class="bi bi-printer-fill fs-4 color-secondary"></i></button>        
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-lg">
            <div class="row">
                <div class="col d-flex mt-4 justify-content-start align-items-center" postion=center>
                    <span class="fs-2 print"> Página de inconsistência </span>
                    <br>              
                </div>
                <div class="col d-flex mt-4 justify-content-end">
                    <div class="text-center">
                        
                    </div>
                </div>
            </div>

        <div class="escrita hide-on-screen"> 
            <p> À Sra. </p> 
            <p> Luana de Cássia Rodrigues </p>
            <p> SEMAD - Coordenadoria de Estágios </p>
            <br>
            <p> Assunto: Justificativa de Inconsistência de Pontos - Estagiários SEMIN.</p>
            <br>
            <p> Prezada Coordenadora.</p>
            <p> Venho através desta, cordialmente solicitar o abono das inconsistências a seguir:</p>
        </div>
            <div class="row">
        <div class="col-12 info shadow-lg">
          <div class="container">
            <div class="row">
              <div class="col">
                
                
                <?php foreach ($data as $user): ?>
                    <h4><?= $user['nome'] ?> - <?= $user['matricula']  ?></h4><hr>
                      

                            <table class="table ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Data</th>
                                            <th scope="col">Entrada</th>
                                            <th scope="col">Saída</th>
                                            <th scope="col">Trabalhadas</th>
                                            <th scope="col">Inconsistência</th>
                                            <th scope="col">Justificativa</th>
                                            <th scope="col" class="print">Anexo</th>
                                            
                                        </tr>
                                    
                                    </thead>
                                    <tbody>
                                    <?php
                                      $sql = "SELECT * FROM horarios WHERE usuario_id = " . $user['id'];
                                      $query = mysqli_query($conn, $sql);
                                    while ($data = mysqli_fetch_array($query)) {
                                        ?>

                                        
                                            <tr>
                                            <td><?php echo date("d/m/Y", strtotime($data['data'])); ?></td>
                                            <td><?php echo date("H:i", strtotime($data['hentrada'])); ?></td>
                                            <td><?php echo date("H:i", strtotime($data['hsaida'])); ?></td>
                                            <td><?= pegarDifHorario($data["data"],$data["hentrada"], $data["hsaida"]); ?></td>
                                            <td><?= pegarHorasFaltam($data["data"],$data["hentrada"], $data["hsaida"]); ?></td> 
                                            <td><?php echo $data['justificativa']?></td>
                                           <td>
                                           <td>
                                                <?php
                                                    if ($data['anexo']) {
                                                    $file_name = pathinfo($data['anexo'], PATHINFO_FILENAME);
                                                    $file_extension = pathinfo($data['anexo'], PATHINFO_EXTENSION);
                                                    $new_file_name = "Arquivo";
                                                ?>
                                                    <a class="print" data-file="<?php echo $data['anexo']; ?>" href="./files/<?php echo $data['anexo'] ?>" download onclick="downloadFile('<?php echo $data['anexo'] ?>')"><?php echo $new_file_name; ?></a>
                                                <?php
                                                    }
                                                ?>
                                                </td>

                                                <script>
                                                function downloadFile(filename) {
                                                var element = document.createElement('a');
                                                element.setAttribute('href', './files/' + filename);
                                                element.setAttribute('download', filename);
                                                element.style.display = 'none';
                                                document.body.appendChild(element);
                                                element.click();
                                                document.body.removeChild(element);
                                                }
                                                </script>


                                       
                                        <?php
                                    }
                                    ?>
                                     </tbody>
                                </table>
                                
                                  <?php endforeach; ?>

                                  <br>
                                  <br>
                                  <br>
                                
                                 
                                  <div class="datatexto hide-on-screen">
                                    <p>Sem mais para o momento, fico a disposição para eventuais esclarecimentos.</p>
                                    <p>Itajubá, <?php echo date('d'); ?> de <?php echo strftime('%B'); ?> de <?php echo date('Y'); ?></p>
                                </div>


                                  <br>
                                  <br>
                                  <br>
                                  <br>
                                  <br>
                                  <br>
                                  <div class="assinatura hide-on-screen">
                                        <div class="assinatura-linha"></div>
                                        <p><?php echo $_SESSION['nomeusuario']; ?></p>
                                        <p><?php echo $data_secretaria['sec_nome'] ?></p>

                                  </div>  
                            <header />
              </div>
            </div>
          </div>
        </div>
         
      </div>   

    </main>   

            

    <footer>

        <div class="boxs">
            <ul>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li> 
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>   
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>  
                <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li> 
                <li><a href="#"><i>Prefeitura de Itajuba</i></a></li>             
            </ul>
        </div>            
    </footer>

        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="./js/transactions.js"></script>
    <script src="./js/impressao.js"></script>
                                

</body>

</html>