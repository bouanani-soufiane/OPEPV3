<?php
class Categ {
    private $idCatag;
    private $nomCateg;
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function __get($property ){
        if(property_exists($this,$property)){
            return $this->$property ;
        }
    }
    public function __set($property,$value){
        if(property_exists($this,$property)){
            $this->$property = $value;
        }
    }

    public function showAllCateg(){
        $query = "SELECT * FROM categorie;";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}