<?php
include '../model/commandeModel.php';

class CommandeController{
    private $CommandeModel;
    public function __construct()
    {
        $this->CommandeModel = new CommandeModel();
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }

    public function checkout(CommandeModel $CommandeModel)
    {
        $this->CommandeModel->checkout($CommandeModel);
    }



}
?>
