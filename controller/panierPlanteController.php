<?php
include '../model/panierPlanteModel.php';

class PanierPlanteController{
    private $PanierplanteModel;
    public function __construct()
    {
        $this->PanierplanteModel = new PanierplanteModel();
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }

    public function addToPanier(PanierplanteModel $PanierplanteModel)
    {
        $this->PanierplanteModel->addToPanier($PanierplanteModel);
    }
    public function showPanier(){
        return $this->PanierplanteModel->showPanier();
    }
    public function deleteFromPanier($pivotId){
        $this->PanierplanteModel->deleteFromPanier($pivotId);
    }
    public function updateStatusQtt($idPlante){
        $this->PanierplanteModel->updateStatusQtt($idPlante);
    }


}
?>
