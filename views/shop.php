<?php
session_start();

include_once '../controller/planteController.php';
include_once '../controller/categorieController.php';
include_once '../controller/panierPlanteController.php';
include_once '../model/panierPlanteModel.php';

if (empty($_SESSION['client'])) {
    header('Location: signUp.php');
}

//include '../function.php';
//dd($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tUa9qXGi+0e6Q8lG1zTPYY39MlZvA7AjOx4fU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-yGBsXpPFFLEGD2Z/J6a3chIpN4I/XFdbn2jkPJH2eZxGc2gwdS04Mw9laYfh9Y4u" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <title>our shop</title>
</head>
<body >


<style>


    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    body{
        background-color: #0b492d;
    }
    #header {
        width: 100%;
        height: 60px;
        /*box-shadow: 5px 5px 15px #e8e8e8*/
    }

    .col-lg-4,
    .col-md-6 {
        padding-right: 0
    }

    button.btn.btn-hide {
        height: inherit;
        background-color: #508D69;
        color: #fff;
        font-size: 0.82rem;
        padding-left: 40px;
        padding-right: 40px;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px
    }

    .btn:focus {
        box-shadow: none
    }
.btn-shop{
    background-color: #508D69;
    color: #fff;
}


    .pagination .page-item .page-link {
        color: #333;
        border: none;
        width: 40px;
        text-align: center
    }

    .pagination .page-item.active .page-link {
        background-color: #fff;
        border: 1px solid #333
    }

    select {
        outline: none;
        padding: 6px 12px;
        margin: 0px 4px;
        color: #999;
        font-size: 0.85rem;
        width: 140px
    }

    #select2 {
        border: 1px solid #777;
        color: #999
    }

    #pro {
        border: none;
        color: #333;
        font-weight: 700;
        padding-left: 0px;
        width: initial
    }

    #filterbar {
        width: 15%;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 15px;
        float: left;
        margin-top: 23px;
    }

    #filterbar input[type="radio"] {
        visibility: hidden
    }

    #filterbar input[type='radio']:checked {
        background-color: #508D69;
        border: none
    }

    #filterbar .btn.btn-success {
        background-color: #ddd;
        color: #333;
        border: none;
        width: 110px;
        text-align: center;
    }

    #filterbar .btn.btn-success:hover {
        background-color: #508D69;
        color: #444
    }

    #filterbar .btn-success:not(:disabled):not(.disabled).active,
    #filterbar .btn-success:not(:disabled):not(.disabled):active {
        background-color: #508D69;
        color: #fff
    }

    label {
        cursor: pointer
    }

    .tick {
        display: block;
        position: relative;
        padding-left: 23px;
        cursor: pointer;
        font-size: 0.9rem;
        margin: 0
    }

    .tick input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0
    }

    .check {
        position: absolute;
        top: 1px;
        left: 0;
        height: 18px;
        width: 18px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 3px
    }

    .tick:hover input~.check {
        background-color: #508D69
    }

    .tick input:checked~.check {
        background-color: #508D69
    }

    .check:after {
        content: "";
        position: absolute;
        display: none
    }

    .tick input:checked~.check:after {
        display: block;
        transform: rotate(45deg) scale(1)
    }

    .tick .check:after {
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid rgb(0, 0, 0);
        border-width: 0 3px 3px 0;
        transform: rotate(45deg) scale(2)
    }

    .box {
        padding: 10px
    }

    .box-label {
        color: #11698e;
        font-size: 0.9rem;
        font-weight: 800
    }

    #inner-box,
    #inner-box2 {
        height: 150px;
        overflow-y: scroll
    }



    #size label {
        margin: 10px;
        margin-left: 0px
    }

    .card {
        padding: 10px;
        cursor: pointer;
        transition: .3s all ease-in-out;
        height: 350px
    }

    .card:hover {
        box-shadow: 2px 2px 5px #508D69;
        transform: scale(1.02)
    }

    .card .product-name {
        font-weight: 600
    }

    .card-body {
        padding-bottom: 0
    }

    .card .text-muted {
        font-size: 0.82rem
    }

    .card-img img {
        padding-top: 10px;
        width: inherit;
        height: 180px;
        object-fit: contain;
        display: block
    }

    .card-body .btn-group .btn {
        padding: 0;
        width: 20px;
        height: 20px;
        margin-right: 5px;
        border-radius: 50%;
        position: relative
    }

    .card-body .btn-group>.btn-group:not(:last-child)>.btn,
    .card-body .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
        border-radius: 50%;
        transition: ease-in all .4s
    }

    .card-body input[type="radio"] {
        visibility: hidden
    }

    .card-body .btn:not(:disabled):not(.disabled).active::after,
    .card-body .btn:not(:disabled):not(.disabled):active::after {
        content: "";
        width: 10px;
        height: 10px;
        border-radius: 50%;
        top: 4px;
        left: 4.2px;
        background-color: #fff;
        position: absolute;
        transition: ease-in all .4s
    }

    .card-body .btn.btn-light:not(:disabled):not(.disabled).active::after,
    .card-body .btn.btn-light:not(:disabled):not(.disabled):active::after {
        background-color: #000
    }

    #avail-size input[type="checkbox"] {
        visibility: hidden
    }

    #avail-size input[type='checkbox']:checked {
        background-color: #508D69;
        border: none
    }

    #avail-size .btn.btn-success {
        background-color: #ddd;
        color: #333;
        border: none;
        width: 20px;
        font-size: 0.7rem;
        border-radius: 0;
        padding: 0
    }

    #avail-size .btn.btn-success:hover {
        background-color: #508D69;
        color: #444
    }

    #avail-size .btn-success:not(:disabled):not(.disabled).active,
    #avail-size .btn-success:not(:disabled):not(.disabled):active {
        background-color: #16c79a;
        color: #fff
    }

    #avail-size label {
        margin: 10px;
        margin-left: 0px
    }



    input[type=range] {
        position: absolute;
        pointer-events: none;
        -webkit-appearance: none;
        z-index: 2;
        height: 10px;
        width: 100%;
        opacity: 0
    }

    input[type=range]::-webkit-slider-thumb {
        pointer-events: all;
        width: 30px;
        height: 30px;
        border-radius: 0;
        border: 0 none;
        background-color: red;
        -webkit-appearance: none
    }
    .shopping-card {
        background-color: #28a745; /* Green background */
        color: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out; /* Smooth animation */
    }

    .shopping-card:hover {
        transform: scale(1.05); /* Enlarge on hover */
    }

    .card-image {
        width: 80px;
        border-radius: 10px;
    }

    .card-name {
        font-weight: bold;
    }

    .card-price {
        color: #ffc107; /* Yellow color for price */
    }
    .myheader{
        background-image: url("../assets/images/bg.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 60vh;
    }
    h1 {
        text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
    }


    .cart {
        position: relative;
        display: block;
        width: 28px;
        height: 28px;
        height: auto;
        overflow: hidden;
    .material-icons {
        position: relative;
        top: 4px;
        z-index: 1;
        font-size: 24px;
        color: white;
    }
    .count {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 2;
        font-size: 11px;
        border-radius: 50%;
        background: #d60b28;
        width: 16px;
        height: 16px;
        line-height:16px;
        display: block;
        text-align: center;
        color: white;
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
    }

</style>

<nav class="navbar navbar-expand-lg" style="background-color: #508D69;">
    <div class="container">
        <a class="navbar-brand text-white" href="#">
            OPEP
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Blog</a>
                </li>
                <li class="">
                    <a class="nav-link  text-white" href="panier.php" >
                        <div class="cart">
                            <span class="count">
                                  <?php
                                  $panierPlante = new PanierplanteModel();
                                  $countPanier = $panierPlante->countPanier();
                                  echo $countPanier;
                                  ?>
                            </span>
                            <i class="fa fa-lg fa-shopping-cart"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../controller/controller.php?logout=true">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="text-center text-white py-5 myheader">
        <h1 class="my-2 display-1" >Welcome To Our Store </h1>
        <p class="w-75 mx-auto display-6">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam quasi dolore inventore expedita. Unde eius facilis eveniet nihil fuga, odimpore porro?</p>
    </div>
<div class="container">
    <div class="bg-white rounded d-flex align-items-center justify-content-between mt-4" id="header">
        <button class="btn btn-hide" type="button" data-bs-toggle="collapse" data-bs-target="#filterbar" aria-expanded="false" aria-controls="filterbar">
            <span class="fas fa-angle-left" id="filter-angle"></span>
            <span id="btn-txt">Show Filters</span>
        </button>

            <input type="search" class="form-control" id="live_search" autocomplete="off" placeholder="search" style="width: 80%; margin: auto">

    </div>
    <div id="content" class="my-5 ">
        <div id="filterbar" class="collapse">
            <div class="box mt-1">
                <div class="form-group text-center">

                </div>
                <h3 class="text-center ">Filter</h3>
                <?php
                $categ = new categorieController();
                $categories = $categ->showCateg();
                foreach ($categories as $category) :

                    ?>
                    <div>

                        <label class="tick my-3 mr-2" for="<?=$category['idCategorie'] ;?>"><?=$category['nomCateorie'] ;?><input id="<?=$category['idCategorie'] ;?>" value="<?=$category['idCategorie'] ;?>" name="filter[]" type="checkbox"><span class="check"></span></label>
                    </div>

                <?php
                    endforeach;
                    ?>
                <div class="btn-group text-center" data-toggle="buttons">
                    <label class="btn btn-success form-check-label active">
                        <input class="" type="radio" checked> Apply
                    </label>
                </div>
            </div>

        </div>
        <div id="products">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mx-0">
                <?php
                $allplantes = new PlantController();
                $plantes = $allplantes->showPlant();
                foreach ($plantes as $plante) :
                ?>
                <div class="col">
                    <div class="card d-flex flex-column align-items-center">
                        <p><?= $plante['nom']; ?></p>
                        <img class="my-2" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($plante['image']); ?>" style="width: 200px;  border-radius: 10px;" />
                        <div>
                            <a class="btn btn-shop btn-sm" href="../controller/controller.php?addToPanier=<?= $plante['idPlante']; ?>">Ajouter au panier</a>
                        </div>
                    </div>
                </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
















<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
