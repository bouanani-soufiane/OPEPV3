<?php
include_once '../config/database.php';

class Theme
{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }
    public function createTheme($nomTheme, $imageTheme, $descriptionTheme)
    {
        $query =  "INSERT INTO theme (nomTheme, imageTheme, descriptionTheme) VALUES (?, ?, ?);";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $nomTheme);
        $stmt->bindParam(2, $imageTheme);
        $stmt->bindParam(3, $descriptionTheme);

        $stmt->execute();
    }
    public function showTheme() {
        $query = "SELECT * from theme";

        $statement = $this->db->prepare($query);

        $statement->execute();

        $themes = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $themes;
    }
    public function modifierTheme($nomTheme, $descriptionTheme, $imageName, $id)
    {
        $query = "UPDATE theme SET nomTheme = ?, descriptionTheme = ?, imageTheme = ? WHERE  idTheme  = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $nomTheme);
        $stmt->bindParam(2, $descriptionTheme);
        $stmt->bindParam(3, $imageName);
        $stmt->bindParam(4, $id);

        $stmt->execute();
    }
    public function supprimerTheme($id)
    {

        $query = "DELETE FROM theme WHERE idTheme  = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();
    }

}