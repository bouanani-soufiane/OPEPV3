<?php
include_once '../config/database.php';

class Categorie
{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }


    public function createCategorie($nomCateg)
    {
        $query =  "insert into categorie (nomCateorie) values (?);";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $nomCateg);

        $stmt->execute();
    }
    public function allCateg() {
        $query = "SELECT categorie.*, COUNT(plante.idPlante) AS plantCount FROM categorie LEFT JOIN plante ON categorie.idCategorie = plante.idCategorie GROUP BY categorie.idCategorie;";

        $statement = $this->db->prepare($query);

        $statement->execute();

        $categ = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $categ;
    }
    public function modifierCateg($nomCateorie,$id)
    {
        $query = "UPDATE categorie SET nomCateorie = ? WHERE idCategorie = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $nomCateorie);
        $stmt->bindParam(2, $id);

        $stmt->execute();
    }
    public function supprimerCateg($id)
    {

        $query = "DELETE FROM categorie WHERE idCategorie = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();
    }


}