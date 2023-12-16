<?php
include('../model/categorie.php');
    function allCateg(){
        $gateg = new Categorie();
        $categories = $gateg->allCateg();
        return $categories;
    }



?>

