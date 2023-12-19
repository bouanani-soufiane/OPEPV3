<?php

include_once '../config/database.php';

class PanierplanteModel
{
    private $plante_id ;
    private $panier_id ;
    private $quantite ;
    private $status ;


    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }
    public function addToPanier()
    {
        try {
            $this->db->beginTransaction();

            $updateSql = 'UPDATE panierplante SET status = 1 WHERE plante_id = ?';
            $updateStmt = $this->db->prepare($updateSql);
            $updateStmt->bindParam(1, $this->plante_id);
            $updateStmt->execute();

            $checkSql = 'SELECT * FROM panierplante WHERE plante_id = ? AND panier_id = ?';
            $checkStmt = $this->db->prepare($checkSql);
            $checkStmt->bindParam(1, $this->plante_id);
            $checkStmt->bindParam(2, $_SESSION['idPanier']);
            $checkStmt->execute();
//            if ($row = $checkStmt->fetch(PDO::FETCH_ASSOC)) {
//                echo $row['idPivot'];
//                exit();
//            }
            if ($checkStmt->rowCount() > 0) {

                $getQttSql = 'SELECT quantite FROM panierplante WHERE plante_id = :plante_id AND panier_id = :panier_id';

                $getQttStmt = $this->db->prepare($getQttSql);

                $getQttStmt->bindParam(':plante_id', $this->plante_id, PDO::PARAM_INT);
                $getQttStmt->bindParam(':panier_id', $_SESSION['idPanier'], PDO::PARAM_INT);

                $getQttStmt->execute();


                if ($row = $getQttStmt->fetch(PDO::FETCH_ASSOC)) {
//                    echo $row['quantite'];
//                    exit();

                    $currentQTT = $row['quantite'];
                    $currentQTT++;
                    $updateQtySql = 'UPDATE panierplante SET quantite = ? WHERE plante_id = ?';
                    $updateQtyStmt = $this->db->prepare($updateQtySql);
                    $updateQtyStmt->bindParam(1, $currentQTT);
                    $updateQtyStmt->bindParam(2, $this->plante_id);
                    $updateQtyStmt->execute();
                }
            } else {
                $insertSql = 'INSERT INTO panierplante (plante_id, panier_id) VALUES (?, ?)';
                $insertStmt = $this->db->prepare($insertSql);
                $insertStmt->bindParam(1, $this->plante_id);
                $insertStmt->bindParam(2, $this->panier_id);
                $insertStmt->execute();
            }

            $this->db->commit();

        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    public function showPanier(){
        $query = "SELECT * FROM panierplante 
              JOIN panier ON panierplante.panier_id = panier.idPanier 
              JOIN plante ON panierplante.plante_id = plante.idPlante 
              WHERE panier.idUser = :userId AND panierplante.status = 1";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteFromPanier($id)
    {

        $query = "DELETE FROM panierplante WHERE idPivot = ?";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();

    }
    public function updateStatusQtt($idplante){
        $sql = 'UPDATE panierplante SET status = 0, quantite = 0 WHERE plante_id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $idplante);
        $stmt->execute();
    }
    public function countPanier() {
        $query = "SELECT count(panierplante.panier_id) as count FROM panierplante WHERE panier_id = :userId and status = 1";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $_SESSION['idPanier'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }




}
