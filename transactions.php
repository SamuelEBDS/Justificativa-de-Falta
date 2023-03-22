<?php
require_once "./DB/conexion.php";
$id = filter_input(INPUT_GET, "id");


if (empty($id)) {
    header("Location: transactions.php?id=$id");
}

$sql = "SELECT * FROM horarios WHERE id = $id";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$sql = "SELECT * FROM usuarios WHERE id = $id";
$query = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($query);





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
    <link rel="stylesheet" href="css/print.css" >
    <link rel="stylesheet" href="css/styles.css">
    <title>Lançamentos</title>
</head>

<body id="app">
    <header>
        <nav class="navbar navbar-expand navbar-light bg-white print">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="./assets/copia_de_seguranca_de_logo-final.png" alt="Image" height="350" width="350"
                        postion="centered" srcset="" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <div class="d-flex menu">
                        <p class="field-name">
                            <?php echo $user["nome"] . " - Matrícula: " . $user["matricula"] ; ?>
                        </p>
                        <button onclick="window.print( )" type="button"><i
                                class="bi bi-printer-fill fs-4 color-secondary "></i></button>
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
        </nav>
    </header>
    <main>
        <div class="container-lg">
            <div class="row">
                <div class="col d-flex mt-4 justify-content-start align-items-center" postion=center>

                    <span class="fs-2"> Justificativas </span>
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


                                <form method="get">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                                    <label>Data Inicio</label>
                                    <input type="date" name="data1">
                                    <label>Data Final</label>
                                    <input type="date" name="data2">
                                    <input type="submit" value="Filtrar">
                                </form>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Data</th>
                                            <th scope="col">Entrada</th>
                                            <th scope="col">Saída</th>
                                            <th scope="col">Trabalhadas</th>
                                            <th scope="col">Inconsistência</th>
                                            <th scope="col">Justificativa</th>
                                            <th scope="col">Anexo</th>
                                            <th scope="col">Ações</th>
                                            
                                        </tr>
                                    </thead>
                                    <?php
                                    $no = 1;

                                    if (isset($_GET['data1']) && isset($_GET['data2']) && !empty($_GET['data1']) && !empty($_GET['data2'])) {
                                        $data1 = $_GET['data1'];
                                        $data2 = $_GET['data2'];
                                        $sql = mysqli_query($conn, "SELECT * FROM horarios where usuario_id = $id and `data` >= '$data1' and  `data` <=  '$data2' ");
                                    } else {
                                        $sql = mysqli_query($conn, "SELECT * from horarios where usuario_id = $id");
                                    }

                                    while ($data = mysqli_fetch_array($sql)) {
                                        ?>

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo date("d/m/Y", strtotime($data['data'])); ?>
                                                </td>
                                                <td>
                                                    <?php echo date("H:i", strtotime($data['hentrada'])); ?>
                                                </td>
                                                <td>
                                                    <?php echo date("H:i", strtotime($data['hsaida'])); ?>
                                                </td>
                                                <td>
                                                   <?= date("H:i", strtotime(pegarDifHorario($data["data"], $data["hentrada"], $data["hsaida"]))); ?>

                                                </td>
                                                <td>
                                                    <?= pegarHorasFaltam($data["data"], $data["hentrada"], $data["hsaida"]); ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['justificativa'] ?>
                                                </td>
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
                                                
                                                <td>
                                                    <a class='btn btn-sm btn-primary' href='editarTrans.php?id=<?php echo $data["id"];?>' title='Editar'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                                        </svg>
                                                        </a> 
                                                        <a class='btn btn-sm btn-danger' href='deletetrans.php?id=<?php echo $data["id"];?> ' title='Deletar'>
                                                         <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                         <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                                        </svg>
                                                         </a>
                                                    
                                                </td>
                        
                                                
                                                
                                                        
                                                
                                            
                                            </tr>
                                             
                                    
                                        </tbody>
                                        <?php
                                    }
                                    ?>
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
        <div class="modal fade" id="transaction-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar lançamentos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="inserthorarios.php" id="transaction-form" enctype="multipart/form-data">

                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="value-input_1" class="form-label">Horario entrada</label>
                                <input required name="hentrada" type="time" step="any" class="form-control"
                                    id="value-input_1" aria-describedby="emailHelp">
                            </div>
                            
                            <div class="mb-3">
                                <label for="value-input_2" class="form-label">Horario saída</label>
                                <input required name="hsaida" type="time" step="any" class="form-control"
                                    id="value-input_2" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label for="description-input" class="form-label">Justificativa</label>
                                <input required name="justificativa" type="text" class="form-control"
                                    id="description-input">
                            </div>

                            <div class="mb-3">
                                <label for="date-input" class="form-label">Data</label>
                                <input required name="data" type="date" class="form-control" id="date-input">
                            </div>

                            <div classs="mb-3">
                                <input type="file" name="attachment">

                            </div>

                            <input name="id_usuario" type="hidden" value="<?= $id ?>">

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
    <script src="./js/transactions.js"></script>


</body>

</html>