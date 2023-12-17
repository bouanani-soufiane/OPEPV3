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
        $query = "SELECT categorie.*, COUNT(plante.idPlante) AS plantCount FROM categorie LEFT JOIN plante ON categorie.idCategorie = plante.idCategorie GROUP BY categorie.idCategorie;";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createCatg($nomCateg){
        $this->__set('nomCateg',$nomCateg);

        $query = "INSERT INTO categorie (nomCateorie) VALUES (?);";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $this->nomCateg);

        $stmt->execute();

    }
    public function editCateg($idCateg, $nomCateg){
        $this->__set('nomCateg', $nomCateg);

        $query = "UPDATE categorie SET nomCateorie = ? WHERE idCategorie = ?";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $this->nomCateg);
        $stmt->bindParam(2, $idCateg);

        $stmt->execute();
    }
    public function deleteCateg($id)
    {
        $query = "DELETE FROM categorie WHERE idCategorie = ?";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();

    }

}