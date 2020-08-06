
<?php 
require "callClass.php";

$callClassVeiculo = new Veiculo();
$veiculos = $callClassVeiculo->indexVeiculo();
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
        <a href="index.php" class="btn btn-primary mb-5 mt-5">Cadastrar +</a>
        <div class="row row-cols-4">
        <?php 
            foreach ($veiculos as $veiculo) {
        ?>
            <div class="col">
                <div class="card">
                    <img src="uploads/img/<?=$veiculo['foto_capa']?>" width="100%">
                    <div class="card-body">
                        <h5 class="card-title">
                                <?=$veiculo['marca']?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <?=$veiculo['modelo']?>
                        </h6>
                        <a href="editar.php?id=<?=$veiculo['cod_veiculo']?>" class="btn btn-warning mt-3 mb-3">Editar</a>
                        <input type="text" hidden name="codveiculo" class="form-control form-control-sm mt-1" value="<?= $veiculo['cod_veiculo']?>">
                        <button type="button" id="<?=$veiculo['cod_veiculo']?>" class="excluir btn btn-danger">excluir</button>
                    </div>
                </div>
            </div>
        <?php 
            }
        ?>
        </div>
      </div>
  </body>
</html>

<script>
    $(document).ready(function(){
        $('.excluir').click(function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: "excluirVeiculo.php",
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
    });
</script>