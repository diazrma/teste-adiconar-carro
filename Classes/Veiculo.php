<?php 


class Veiculo extends Config
{
    
    public function indexVeiculo()
    {
        $sql = "SELECT *, (SELECT nome_foto FROM tbl_galeria_veiculo WHERE cod_veiculo = tbl_veiculo.cod_veiculo LIMIT 1) AS foto_capa FROM tbl_veiculo";        
        $con = self::conecta()->query($sql);
        $response = $con->fetchAll(PDO::FETCH_ASSOC);
        
        return $response;
    }

    public function insertFoto($nameFoto, $id_foto)
    {
        $sql = "INSERT INTO tbl_galeria_veiculo (nome_foto, cod_veiculo) VALUE (?,?)";
        $con = self::conecta()->prepare($sql);
        $con->bindParam(1, $nameFoto);
        $con->bindParam(2, $id_foto);
        $con->execute();
    }
    
    public function insertVeiculo($marca, $modelo, $imagem = array())
    {
        try {

            $sql = "INSERT INTO tbl_veiculo (marca, modelo) VALUE (?, ?)";
            $conexao = self::conecta();
            $con = $conexao->prepare($sql);
            $con->bindParam(1, $marca);
            $con->bindParam(2, $modelo);
            $con->execute();

            $id_foto = $conexao->lastInsertId();
            
            if(count($imagem) > 0) {
                for ($i=0; $i < count($imagem); $i++) { 
                    $nameFoto = $imagem[$i];
                    $callClass = new Veiculo;
                    $callClass->insertFoto($nameFoto, $id_foto);
                }
            }

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function destroyVeiculo($id)
    {
        $sql = "DELETE FROM tbl_galeria_veiculo WHERE cod_veiculo = $id";
        $con = self::conecta()->query($sql);
        $con->execute();
        
        $sql = "DELETE FROM tbl_veiculo WHERE cod_veiculo = $id";
        $con = self::conecta()->query($sql);
        $con->execute();
        
        return true;
    }

    public function showVeiculo($id)
    {
        $sql = "SELECT * FROM tbl_veiculo WHERE cod_veiculo = $id";
        $con = self::conecta()->query($sql);
        $response = $con->fetchAll(PDO::FETCH_ASSOC);

        return $response;
    }

    public function showFotos($id)
    {
        $sql = "SELECT * FROM tbl_galeria_veiculo WHERE cod_veiculo = $id";
        $con = self::conecta()->query($sql);
        $response = $con->fetchAll(PDO::FETCH_ASSOC);

        return $response;
    }

    public function editFotos($nameFoto, $id_foto)
    {
        $sql = "INSERT INTO tbl_galeria_veiculo (nome_foto, cod_veiculo) VALUE (?,?)";
        $con = self::conecta()->prepare($sql);
        $con->bindParam(1, $nameFoto);
        $con->bindParam(2, $id_foto);
        $con->execute();
    }

    public function updateFotos($imagem = array(), $id_foto){
        if(count($imagem) > 0) {
            for ($i=0; $i < count($imagem); $i++) { 
                $nameFoto = $imagem[$i];
                $callClass = new Veiculo;
                $callClass->editFotos($nameFoto, $id_foto);
            }
        }
    }
    public function editVeiculo($id, $marca, $modelo)
    {
        $sql = "UPDATE tbl_veiculo SET marca=?, modelo=? WHERE cod_veiculo = ?";
        $con = self::conecta()->prepare($sql);
        $con->bindParam(1, $marca);
        $con->bindParam(2, $modelo);
        $con->bindParam(3, $id);
        $con->execute();
    }

    public function excluirFoto($id)
    {
        $sql = "DELETE FROM tbl_galeria_veiculo WHERE cod_foto = $id";
        $con = self::conecta()->query($sql);
        $con->execute();
        
        return true;
    }

    public function setSituacao($situacao, $id_foto){
        $sql = "UPDATE tbl_galeria_veiculo SET situacao = ? WHERE cod_foto = $id_foto";
        $con = self::conecta()->prepare($sql);
        $con->bindParam(1, $situacao);
        $con->execute();

        return true;
    }
}
