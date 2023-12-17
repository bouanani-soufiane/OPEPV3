<?php

include '../model/categorieModel.php';

class categorieController{
    private $categorieModel;

    public function __construct()
    {
        $this->categorieModel = new Categ();
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


