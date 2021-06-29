<!doctype html>
<html lang="en">
  <head>
    <title>Ótica WG</title>
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

        .table tr td:last-child{
            width:120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
  </head>
  <body>
      <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Detalhes dos clientes</h2>
                        <a href="create.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i>
                            Adicionar novo cliente
                        </a>
                    </div>

                    <?php
                        require_once "config.php";

                        $sql = "SELECT * FROM clientes";
                        if ($result = $mysqli->query($sql)) {
                            if ($result->num_rows > 0) {
                                echo '<table class="table table-bordered table-striped">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo "<th>#</th>";
                                            echo "<th>Name</th>";
                                            echo "<th>Address</th>";
                                            echo "<th>Salary</th>";
                                            echo "<th>Action</th>";
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_array($result)){
                                        echo '<tr>';
                                            echo '<td>'.$row['id'].'</td>';
                                            echo '<td>'.$row['name'].'</td>';
                                            echo '<td>'.$row['address'].'</td>';
                                            echo '<td>'.$row['salary'].'</td>';
                                            echo '<td>';
                                                echo '<a href="read.php?id='.$row['id'].'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="delete.php?id='.$row['id'].'" class="mr-3" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo'</td>';
                                        echo '</tr>';
                                    }    
                                    echo '</tbody>';
                                echo '</table>';

                                $result->free();
                            }else{
                                echo '<div class="alert alert-danger"><em>Registro não encontrado.</em></div>';
                            }
                        }else {
                            echo "OPS erro tente mais tarde";
                        }
                        $mysqli -> close();
                    ?>
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