<?php
session_start();

include_once '../controller/planteController.php';
include_once '../controller/categorieController.php';
include_once '../controller/panierPlanteController.php';

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
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <title>our shop</title>
</head>
<body >


<style>


    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    body{
        background-image: url("../assets/images/bg.jpg");
        background-position: center;
        background-size: cover;
    }
    #header {
        width: 100%;
        height: 60px;
        /*box-shadow: 5px 5px 15px #e8e8e8*/
    }

    #cart {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(168, 215, 185, 0.2), 0 6px 20px rgba(70, 176, 144, 0.2);
    }

    h1 {
        text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
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
                    <a class="nav-link active text-white" aria-current="page" href="shop.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Blog</a>
                </li>
                <li class="">
                    <a class="nav-link  text-white" href="#">
                        Cart
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../controller/controller.php?logout=true">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="mb-5">

    <h1 class="text-white text-center display-2 my-5 h1">Your Shopping Card</h1>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container pb-5">
        <?php
        $panierPlante = new PanierPlanteController();
        $allpanier = $panierPlante->showPanier();
        if (empty($allpanier)) {
            ?>
            <div style=" width: 483px ; margin: auto;">
                <img style="display: block;  width: 100% "   src='https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-2130356-1800917.png'  />

            </div>
            <?php
        } else {
        ?>
        <table id="cart" class="table table-hover table-condensed mb-5  ">
            <thead  >
            <tr  >
                <th style="padding: 25px; width:50%">Product</th>
                <th style="padding: 25px; width:10%">Price</th>
                <th style="padding: 25px; width:8%">Quantity</th>
                <th style="padding: 25px; width:22%" class="text-center">Subtotal</th>
                <th style="padding: 25px; width:10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($allpanier as $panier) :
            ?>
            <tr class="">
                <td data-th="Product" class="align-middle">
                    <div class="row">
                        <div class="col-sm-2"><img style="width:100%" class="" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($panier['image']); ?>" /></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin"><?=$panier['nom'] ;?></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dossseiusmod
                                tempor incididunt ut labore et doloqua.</p>
                        </div>
                    </div>
                </td>
                <td data-th="Price" class="align-middle" style="padding: 25px; "><strong>$<?=$panier['prix'] ;?></strong></td>
                <td data-th="Quantity" class="align-middle">
                    <input type="number" disabled class="form-control text-center" value="<?=$panier['quantite'] ;?>">
                </td>
                <td data-th="Subtotal" class="text-center align-middle"><strong>$<?=$panier['prix'] * $panier['quantite'] ;?></strong></td>
                <td class="actions align-middle " data-th="">
                    <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                    <a href="../controller/controller.php?deleteFromPanier=<?= $panier['idPivot'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                    <a href="../controller/controller.php?commander=true&&idPivot=<?= $panier['idPivot']; ?>&&idPlante=<?= $panier['plante_id']; ?>" class=" mt-3 btn btn-success btn-sm"><i class="fa fa-plus"></i> Checkout</a>
                </td>
            </tr>
            <?php
                endforeach;

            ?>
            </tbody>
            <tfoot>

            <tr>
                <td style="padding: 25px;"><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total $ 5.11</strong></td>
                <td><a href="#" class="btn btn-success btn-block">Purchase<i class="fa fa-angle-right"></i></a></td>
            </tr>
            </tfoot>
        </table>
            <?php
        }
        ?>
    </div>
</main>
<footer class=" text-white text-center mt-5 py-3" style="background-color: #508D69;">
    <div class="container">
        <p>&copy;CodeX. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
