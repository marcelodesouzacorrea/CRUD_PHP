<?php
    require_once 'config.php';
    
    $name = $address = $salary = "";
    $name_err = $address_err = $salary_err = "";

    if (isset($_POST['id']) && !empty($_POST["id"])) {
        $id = $_POST['id'];

        //validar name
        $input_name = trim($_POST['name']);
        if (empty($input_name)) {
            $name_err = "Por favor digite o nome";
        }elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $name_err = "Digite um nome valido";
        }else {
            $name = $input_name;
        }

        //validar addess
        $input_address = trim($_POST['address']);
        if(empty($input_address)){
            $address_err = "Por favor digite o endereço";
        }else {
            $address = $input_address;
        }

        //validar salary
        $input_salary = trim($_POST['salary']);
        if (empty($input_salary)) {
            $salary_err = "Digite o salario";
        }elseif (!ctype_digit($input_salary)) {
            $salary_err = "Por favor digite o salario";
        }else {
            $salary = $input_salary;
        }

        if (empty($name_err) && empty($address_err) && empty($salary_err)) {
            $sql = "UPDATE clientes SET name=?, address=?, salary=? WHERE id=?";

            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sssi", $param_name, $param_address, $param_salary, $param_id);

                $param_name = $name;
                $param_address = $address;
                $param_salary = $salary;
                $param_id = $id;

                if ($stmt->execute()) {
                    header("location: index.php");
                    exit();
                }else {
                    echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde";
                }
                
            }
            $stmt -> close();
        }
            $mysqli-> close();
    }else {
            if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
                $id = trim($_GET['id']);

                $sql = "SELECT * FROM clientes WHERE id = ?";
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param("i",$param_id);

                    $param_id = $id;

                    if ($stmt ->execute()) {
                        $result = $stmt->get_result();

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_array(MYSQLI_ASSOC);

                            $name = $row["name"];
                            $address = $row["address"];
                            $salary = $row["salary"];
                        }else{
                            header("location: error.php");
                            exit();
                        }
                    }else{
                        echo 'Ops! Algo deu errado. Por favor, tente novamente mais tarde';
                    }
                }
                $stmt->close();
                $mysqli-> close();
            }else {
                    header("location:error.php");
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
                            Atualizar registros de clientes
                        </h2>
                        <p>Edite os valores de entrada e envie para atualizar o registro do funcionário
</p>    
                        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control <?php echo (!empty($name_err))? 'is-invalid':'' ;?>" value="<?php echo $name;?>">
                                <span class="invalid-feedback"><?php echo $name_err ;?></span>    
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control <?php echo (!empty($address_err))?'is-invalid' : '';?>"><?php echo $address;?></textarea>
                                <span class="invalid-feedback"><?php echo $address_err;?></span>
                            </div>

                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err))? 'is-invalid' : '';?>" value="<?php echo $salary;?>">
                                <span class="invalid-feedback"><?php echo $salary_err;?></span>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                            <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
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