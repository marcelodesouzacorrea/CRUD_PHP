<?php
    if(isset($_GET['id']) && !empty(trim($_GET['id']))){
        require_once 'config.php';

        $sql = "SELECT * FROM clientes WHERE id = ?";

        if($stmt = $mysqli->prepare($sql)){
            $stmt-> bind_param("i",$param_id);

            $param_id = trim($_GET['id']);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result -> num_rows == 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    $name = $row["name"];
                    $address = $row["address"];
                    $salary = $row["salary"];
                }else{
                    header("location: error.php");
                    exit();
                }
            }else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
            $stmt->close();
            $mysqli->close();
    }else{
            header("location: error.php");
            exit();
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
                        <h1 class="mt-5 mb-3">
                            Ver registros de clientes
                        </h1>

                        <div class="form-group">
                            <label>Name</label>
                            <p><b><?php echo $row['name'];?></b></p>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <p><b><?php echo $row['address'];?></b></p>
                        </div>

                        <div class="form-group">
                            <label>Salary</label>
                            <p><b><?php echo $row['salary'];?></b></p>
                        </div>

                        <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
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