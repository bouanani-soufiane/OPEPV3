<?php
class Users
{
    private $name;
    private $email;
    private $password;
    private $idRole;

    public function __construct($name, $email, $password, $idRole)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->idRole = $idRole;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("Undefined property: $property");
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("Undefined property: $property");
        }
    }
}

?>
