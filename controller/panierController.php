<?php
include '../model/panierModel.php';

class PanierController
{
    private $panierModel;

    public function __construct()
    {
        $this->panierModel = new PanierModel();
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }
    public function createPanier($idUser)
    {
        $this->panierModel->__set("idUser", $idUser);

        $this->panierModel->createPanier($idUser);
    }




}
?>


