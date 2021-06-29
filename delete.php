<?php
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        require_once "config.php";

        $sql = "DELETE FROM clientes WHERE id = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("i", $param_id);

            $param_id = trim($_POST['id']);

            if($stmt->execute()){
                header("location: index.php");
                exit();
            }else{
                echo "ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
        $stmt->close();
        $mysqli->close();
        
    }else {
        if (empty(trim($_GET["id"]))) {
            header('location: error.php');
            exit();
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
    </style>

  </head>
  <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mt-5 mb-3">
                            Deletar registros de clientes
                        </h2>
                        
 
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                            <div class="alert alert-danger">
                                <input type="hidden" name="id" value="<?php echo trim($_GET['id']);?>">
                                <p>Tem certeza de que deseja excluir este registro de cliente?</p> 
                                <p>
                                  <input type="submit" class="btn btn-danger" value="SIM">
                                  <a href="index.php" class="btn btn-secondary ml-2">NÃO</a> 
                                </p>
                            </div>
                        </form> 
                     </div>
                </div>    
            </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>             
           
                            

                                                 

                            
                        
                       

                        
                    