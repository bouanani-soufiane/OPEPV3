<?php
include_once  '../controller/planteController.php';
include_once  '../controller/categorieController.php';

//session_start();
$id = @$_GET['idPlante'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit Plante</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<style>
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
        text-align: center;
    }

    .btn {
        padding: 5px 10px;
        text-decoration: none;
        display: inline-block;
        margin: 2px;
        border-radius: 3px;
        cursor: pointer;
    }

    .btn-info {
        background-color: #5bc0de;
        color: #fff;
    }

    .btn-add {
        background-color: #040;
        color: #fff;
    }

    .btn-danger {
        background-color: #d9534f;
        color: #fff;
    }

    form.form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        width: 100%;
    }

    .form input,
    .form select,
    .form button {
        width: 100%;
        flex: 1;
        margin-bottom: 15px;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        margin-right: 10px;
    }

    .form button {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
    }

    .form button:hover {
        background-color: #45a049;
    }

    .modal {
        position: fixed;
        display: none;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .btn#close {
        margin: 10px;

    }
</style>
<!-- =============== Navigation ================ -->
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                        <span class="icon">
                            <ion-icon name="leaf-outline"></ion-icon>
                            </ion-icon>
                        </span>
                    <span class="title">O-PEP</span>
                </a>
            </li>



            <li>
                <a href="#">
                        <span class="icon">
                            <ion-icon name="add"></ion-icon>
                        </span>
                    <span class="title">plantes</span>
                </a>
            </li>

            <li>
                <a href="#">
                        <span class="icon">
                            <ion-icon name="sync"></ion-icon>
                        </span>
                    <span class="title">categories</span>
                </a>
            </li>

            <li>
                <a href="#">
                        <span class="icon">
                            <ion-icon name="trash"></ion-icon>
                        </span>
                    <span class="title">clients</span>
                </a>
            </li>

            <li>
                <a href="#">
                        <span class="icon">
                            <ion-icon name="stats-chart"></ion-icon>
                        </span>
                    <span class="title">Statistiques</span>
                </a>
            </li>

            <li>
                <a href="../includes/logout.inc.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                    <span class="title">logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>


            <div>
                <?php
                if (isset($_SESSION["name"])) {

                    echo "Hello " . $_SESSION["name"];
                }

                ?>
            </div>
        </div>


        <!-- ======================= Cards ================== -->


        <!-- ================ Order Details List ================= -->

        <div class="details">
            <div class="box">
                <div class="">
                    <h1>modifier plante</h1> <br>
                    <form class="form" action="../controller/controller.php" method="post" id="editForm" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?= $_GET['idPlante']?>">
                            <input required name="nomPlanteEdit" type="text" placeholder="nom" value="">
                            <input required name="pricePlanteEdit" type="number" placeholder="prix" value="">
                            <input required name="imagePlanteEdit" type="file" value="">
                            <select required name="catPlanteEdit" id="">
                                <?php
                                $categ = new categorieController();
                                $categories = $categ->showCateg();
                                foreach ($categories as $category) {
                                    echo "<option value='{$category['idCategorie']}'>{$category['nomCateorie']}</option>";
                                }
                                ?>
                            </select>
                            <button class="btn btn-add" name="editPlante">
                                modifier plante
                            </button>

                    </form>

                </div>

            </div>

            <!-- ================= New Customers ================ -->

        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="../assets/js/dashboard.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>