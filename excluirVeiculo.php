<?php 
    require "callClass.php";
    $callClass = new Veiculo();
    $id = $_POST['id'];
    

    if ($callClass->destroyVeiculo($id)) {
        echo true;
    } else {
        echo false;
    }
?>