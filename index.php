<?php 
require "callClass.php";

$callClassVeiculo = new Veiculo();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  </head>

  <?php 

    if(isset($_POST['submit']))
    {
        $uploaddir = 'uploads/img/';
    
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
    
        $total = count($_FILES['image']['name']);
    
        $imagem = array();
    
        if(isset($_FILES['image']))
        {
            for ($i=0; $i < $total; $i++) { 
                $nome_arquivo = md5($_FILES['image']['name'][$i]).date('-d-m-Y').'.jpg';
                move_uploaded_file($_FILES['image']['tmp_name'][$i], 'uploads/img/'.$nome_arquivo);
            
                array_push($imagem, $nome_arquivo);
            }
            $callClassVeiculo->insertVeiculo($marca, $modelo, $imagem); 
        }  
      
        echo '
        <script>
        $(document).ready(function(){
          $("#exampleModal").modal("show");
        })
        </script>
        ';
    }
?>

  <body>
      <div class="container">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="">Marca</label>
                <input type="text" name="marca" id="marca" placeholder="marca" class="form-control"></br>
              </div>
              <div class="form-group">
                <label for="">Modelo</label>
                <input type="text" name="modelo" id="modelo" placeholder="modelo" class="form-control">
              </div>
              <div class="form-group">
                <input type="file" name="image[]" id="image" multiple>
              </div>
              <div class="form-group">
                <button class="btn btn-success" type="submit" name="submit">Enviar</button>
                <a class="btn btn-light" href="lista.php">visualizar todos</a>
              </div>
              <div class="aviso">

              </div>
            </form>
      </div>
    <div class="modal fade border-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered border-0">
        <div class="modal-content border-0">
          <div class="modal-body border-0">
            <div class="alert alert-success m-0" role="alert">
              Veículo <span class="alert-link">cadastrado com sucesso</span>
            </div>
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