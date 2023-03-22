<!DOCTYPE html>
<html>
  
<head>
    <title>Insert Page page</title>
</head>
  
<body>
    <center>
        <?php
  
        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        $conn = new mysqli("localhost", "root", "1547", "db_jus"); 

          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
          
        // Taking all 5 values from the form data(input)
       
        $matricula = $_POST['matricula']; //post 
        $senha = $_POST['senha'];
        
          
        //mandar gravar no banco
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO justificativa  VALUES ('$matricula','$senha')";
          

        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully." 
                . " Please browse your localhost php my admin" 
                . " to view the updated data</h3>"; 
  
                header("Location: gerenciamento.html");
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
          
        // Close connection
        mysqli_close($conn);
        ?>
    </center>
</body>
  
</html>