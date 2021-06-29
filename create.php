<?php
    require_once 'config.php';

    $name = $address = $salary = "";
    $name_err = $address_err = $salary_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //valida name
        $input_name = trim($_POST["name"]);
        if(empty($input_name)){
            $name_err = "Please enter a name.";
        } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $name_err = "Please enter a valid name.";
        } else{
             $name = $input_name;
    }

        //validar address
        $input_address = trim($_POST['address']);
        if (empty($input_address)) {
            $address_err = "Por favor digite o endereço";
        }else{
            $address = $input_address;
        }

        //validar salario
        $input_salary = trim($_POST['salary']);
        if (empty($input_salary)) {
            $salary_err = "Por favor digite seu salario";
        }else{
            $salary = $input_salary;
        }

        if (empty($name_err) && empty($address_err) && empty($salary_err)) {
            $sql = "INSERT INTO clientes (name, address, salary) values (?, ?, ?)";

            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sss", $param_name,$param_address, $param_salary);

                $param_name = $name;
                $param_address = $address;
                $param_salary = $salary;

                if ($stmt->execute()) {
                    header('location: index.php');
                    exit();
                }else {
                    echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde";
                }
                
            }
            $stmt->close();
        }
        $mysqli->close();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Criando registros</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
    
    </head>
  <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mt-5">Criar registros</h2>
                        <p>Preencha este formulário e envie para adicionar o registro do funcionário ao banco de dados</p>

                        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name;?>">
                                    <span class="invalid-feedback"><?php echo $name_err;?></span>
                            </div>
                            
                            <div class="form-group">
                                <label>address</label>
                                <textarea name="address" class="form_control <?php echo (!empty($address_err)) ? 'is-invalid' : '';?>"><?php echo $address;?></textarea>
                                    <span class="invalid-feedback"><?php echo $address_err;?></span>
                            </div>

                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : '';?>" value="<?php echo $salary;?>">
                                    <span class="invalid-feedback"><?php echo $salary_err?></span>
                            </div>
                                    <input type="submit" class="btn btn-primary" value="ENVIAR">        
                                    <a href="index.php" class="btn btn-secondary ml-2">CANCELAR</a>
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