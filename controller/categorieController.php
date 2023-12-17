<?php

include '../model/categorieModel.php';

class categorieController{
    private $categorieModel;

    public function __construct()
    {
        $this->categorieModel = new Categ();
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }

    public function showCateg(){
        return $this->categorieModel->showAllCateg();
    }

    public function createCateg($nomCateg){
        $this->categorieModel->createCatg($nomCateg);
    }

    public function editCateg($idCateg, $nomCateg){
        $this->categorieModel->editCateg($idCateg, $nomCateg);
    }

    public function deleteCateg($idCateg){
        $this->categorieModel->deleteCateg($idCateg);
    }


}
?>


