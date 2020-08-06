<?php 
    require "callClass.php";
    $callClass = new Veiculo();
    $id = $_POST['id'];
    

    if ($callClass->excluirFoto($id)) {
        echo true;
    } else {
        echo false;
    }
?>