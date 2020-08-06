
<?php 
require "callClass.php";

$callClassVeiculo = new Veiculo();

$id = $_GET['id'];

if(isset($_POST['salvarFoto']))
{
    $uploaddir = 'uploads/img/';

    $id_foto = $_POST['codveiculo'];

    $total = count($_FILES['image']['name']);

    $imagem = array();

    if(isset($_FILES['image']))
    {
        for ($i=0; $i < $total; $i++) { 
            $nome_arquivo = md5($_FILES['image']['name'][$i]).date('-d-m-Y').'.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'][$i], 'uploads/img/'.$nome_arquivo);

            array_push($imagem, $nome_arquivo);
        }
        $callClassVeiculo->updateFotos($imagem, $id_foto);
        header("Location:editar.php?id=$id"); 
    }  
}

if(isset($_POST['salvarVeiculo'])){
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];

    $callClassVeiculo->editVeiculo($id, $marca, $modelo);
}




$veiculos = $callClassVeiculo->showVeiculo($id);
$fotos = $callClassVeiculo->showFotos($id);


?>
<!doctype html>
<html lang="pt-br">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
  </head>
  <body>
      <div class="container">
        <a href="lista.php" class="btn btn-secondary mb-5 mt-5">Voltar</a>
        <div class="row row-cols-2">
        <?php 
            foreach ($veiculos as $veiculo) {
        ?>
            <form class="col" method="POST">
                <div class="form-group">
                    <label for="my-input">Marca</label>
                    <input disabled id="my-input" class="edit-car form-control" value="<?=$veiculo['marca']?>" type="text" name="marca">
                </div>
                <div class="form-group">
                    <label for="my-input">Modelo</label>
                    <input disabled id="my-input" class="edit-car form-control" value="<?=$veiculo['modelo']?>" type="text" name="modelo">
                </div>
                <div class="form-group">
                    <button type="button" id="editar" class="btn btn-primary">Editar</button>
                    <button type="submit" name="salvarVeiculo" class="btn btn-success">Salvar</button>
                </div>
            </form>

        <?php 
            }
        ?>
        <form class="col" method="POST" enctype="multipart/form-data">
            <div class="row row-cols-2">
            <?php 
                foreach ($fotos as $foto) {
            ?>
                <div class="col">
                    <img src="uploads/img/<?=$foto['nome_foto']?>" width="100%">
                    <div class="form-group">
                        <input type="text" hidden class="form-control form-control-sm mt-1" value="<?= $foto['cod_foto']?>">
                        <input type="text" hidden name="codveiculo" class="form-control form-control-sm mt-1" value="<?= $foto['cod_veiculo']?>">
                        <button type="button" id="<?=$foto['cod_foto']?>" class="excluir btn btn-danger btn-sm mt-1">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                        <input type="radio" id="situacao" data-id="<?= $foto['cod_foto']?>" name="situacao" class="situacao" value="0">
                        <label>Definir foto inicial</label>
                    </div>
                </div>
            <?php 
                }
            ?>
            </div>
            <div class="form-group">
                <input type="file" name="image[]" id="image" multiple>
            </div>
            <div class="form-group">
                <button type="submit" name="salvarFoto" class="btn btn-success">Salvar</button>
            </div>
        </form>
        </div>
      </div>
  </body>
</html>

<script>
    $('#editar').click(function () { 
        $('.edit-car').removeAttr('disabled');
    });
    $(document).ready(function(){
        $('.excluir').click(function() {
            //e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: "excluirFoto.php",
                type: 'POST',
                data: {
                    'id': id
                }, success: function (data) {
                    if (data == true) {
                        location.reload();
                    } else {
                        alert('erro: ' + data);
                    }
                }
            });
        });

        //Função para marcar a foto como capa
        //Envia esse id_foto pra um php que faz um update no campo capa com o valor 1 e as demais foto precisa colcoar valor 0
        $('.situacao').click(function(){
                 
          var id_foto=  $(this).attr("data-id");
            console.log(id_foto)
          $.ajax({
                url: "arquivo.php",
                type: 'POST',
                data: {
                    'id_foto': id_foto
                }, success: function (data) {
               
                }
            });
          
          
        });
    });
</script>
