<?php 

class Buscar{ //create yout database and table to use this class
    public static function GetEndereco($id){ 
        $sql = new Sql();
            return $sql->select("SELECT Nome, Endereco, Bairro, Cidade, UF, Fone, Cep FROM TABLE_ENDERECO WHERE Id=:id", array(
                 ":id"=>$id
            ));
        }
    }
?>