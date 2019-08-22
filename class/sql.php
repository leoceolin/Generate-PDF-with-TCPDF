<?php 
class Sql extends PDO{ //estende do PDO, todas as funções do PDO estendem para a classe Sql
    
    private $conn;

    public function __construct(){
            try{
                $this->conn = new PDO("mysql:dbname=DATABASE_NAME;host=DB_HOST;charset=utf8;parseTime=true;","USER","PASSWORD");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Conectou ao banco<br><br>";
            }catch(PDOException $e) {
                //echo 'ERROR: ' . $e->getMessage();
                throw new PDOException($e);
            }
    }
    
    private function setParams($statement, $parameters = array()){
        foreach($parameters as $key => $value){
            
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statement, $key, $value){

        $statement->bindParam($key, $value); 
    }

    public function query($rawQuery, $params = array()){
        
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);
        
        $stmt->execute();
        //echo json_encode($stmt);
        return $stmt; 
    }
    
    public function select($rawQuery, $params = array()):array{
        
        $stmt = $this->query($rawQuery, $params);
       
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}



?>