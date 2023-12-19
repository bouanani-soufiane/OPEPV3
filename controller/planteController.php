<?php
include '../model/PlanteModel.php';

class PlantController{
    private $plantModel;
    public function __construct()
    {
        $this->plantModel = new PlantModel();
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }
//    this should accept Plant model as parametter
    public function createPlante(PlantModel $PlantModel)
    {
        $this->plantModel->createPlant($PlantModel);
    }
    public function editPlante($plantId,$nomPlante, $prixPlante, $imageName, $catPlante){
        $this->plantModel->__set("plantName", $plantId);
        $this->plantModel->__set("plantName", $nomPlante);
        $this->plantModel->__set("plantImage", $prixPlante);
        $this->plantModel->__set("plantImage", $imageName);
        $this->plantModel->__set("IDcategory", $catPlante);
        $this->plantModel->editPlante($plantId,$nomPlante, $prixPlante, $imageName, $catPlante);
    }
    public function deletePlant($plantId){
        $this->plantModel->deletePlante($plantId);
    }
    public function showPlant(){
        return $this->plantModel->showAllPlants();
    }
    public function filterByCateg($catChecked){
        return $this->plantModel->filterByCateg($catChecked);
    }

}
?>


