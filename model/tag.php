<?php
include_once '../config/database.php';

class Tag
{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }


    public function createTag($nomTag,$themeTag)
    {
        $query =  "insert into tag (textTag,themeID) values (?,?);";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $nomTag);
        $stmt->bindParam(2, $themeTag);

        $stmt->execute();
    }
    public function alltags() {
        $query = "SELECT tag.* , theme.nomTheme from tag join theme where tag.themeID = theme.idTheme;";

        $statement = $this->db->prepare($query);

        $statement->execute();

        $tags = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $tags;
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