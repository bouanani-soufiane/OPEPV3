<?php
include_once '../controller/planteController.php';
include_once '../controller/categorieController.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
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
        background-color: #0b492d;
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
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }

    .form input,
    .form select,
    .form button {
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
        background-color: #0b492d;
        color: #fff;
        cursor: pointer;
    }

    .form button:hover {
        background-color: #0b492d;
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

    .box h1 {
        text-align: center;
        margin: 10px 0 30px;
        /* font-size: ; */
    }
</style>
<!-- =============== Navigation ================ -->
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="./dashboard.php">
                        <span class="icon">
                            <ion-icon name="rose-outline"></ion-icon>
                        </span>
                    <span class="title">O-PEP</span>
                </a>
            </li>



            <li>
                <a href="#plantes">
                        <span class="icon">
                            <ion-icon name="leaf-outline"></ion-icon>
                        </span>
                    <span class="title">plantes</span>
                </a>
            </li>

            <li>
                <a href="#categories">
                        <span class="icon">
                            <ion-icon name="sync"></ion-icon>
                        </span>
                    <span class="title">categories</span>
                </a>
            </li>

            <li>
                <a href="#themes">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                    <span class="title">Thèmes</span>
                </a>
            </li>

            <li>
                <a href="#tags">
                        <span class="icon">
                            <ion-icon name="bookmark-outline"></ion-icon>
                        </span>
                    <span class="title">Tags</span>
                </a>
            </li>

            <li>
                <a href="../includes/logout.inc.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                    <span class='title'>logout
                            <?php
                            // echo "<pre>";
                            // print_r($_SESSION);
                            // echo "</pre>"; ?>
    </div>
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

        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <ion-icon name="search-outline"></ion-icon>

            </label>
        </div>

        <div>

        </div>
    </div>


    <!-- ======================= Cards ================== -->


    <!-- ================ Order Details List ================= -->

    <div class="details" id="plantes">
        <div class="box">
            <div class="">
                <h1>Gestion des plantes</h1>

                <form class="form" action="../controller/controller.php" method="post" enctype="multipart/form-data">
                    <input name="nomPlante" type="text" placeholder="nom">
                    <input name="pricePlante" type="number" placeholder="prix">
                    <input name="imagePlante" type="file">
                    <select name="catPlante" id="">
                        <?php
                        $categ = new categorieController();
                        $categories = $categ->showCateg();
                        foreach ($categories as $category) {
                            echo "<option value='{$category['idCategorie']}'>{$category['nomCateorie']}</option>";
                        }
                        ?>

                    </select>

                    <button class="btn btn-add" name="ajouterPlante">
                        ajouter plante
                    </button>
                </form>

                <table class="table">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>nom</th>

                        <th>prix</th>

                        <th>image</th>

                        <th>categorie</th>

                        <th>Action</th>

                    </tr>

                    </thead>

                    <tbody style="text-align: center;">
                        <?php
                        $allplantes = new PlantController();
                        $plantes = $allplantes->showPlant();
                        foreach ($plantes as $plante) :
                            ?>

                        <tr>
                            <td style="text-align: center;">
                                <?=$plante['idPlante'] ;?>
                            </td>
                            <td style="text-align: center;">
                                <?=$plante['nom'] ;?>
                            </td>
                            <td style="text-align: center;">
                                <?=$plante['prix'] ;?>
                            </td>
                            <td style="text-align: center;">
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($plante['image']); ?>" style="width: 200px; border-radius: 10px;" />
                            </td>
                            <td style="text-align: center;">
                                <?=$plante['nomCateorie'] ;?>

                            </td>
                            <td style="text-align: center;">
                                <a class="btn btn-info" href="modifierPlante.php?idPlante=<?= $plante['idPlante'] ?>">modifier</a>
                                &nbsp;<a class="btn btn-danger" href="../controller/controller.php?deletePlante=<?= $plante['idPlante'] ?>">supprimer</a>
                            </td>
                        </tr>

                    <?php
                    endforeach;
                    ?>
                    </tbody>


                </table>
            </div>
        </div>

        <!-- ================= New Customers ================ -->

    </div>
    <div class="details" id="categories">
        <div class="box">
            <div class="">
                <h1>Gestion des categories</h1>
                <form class="form" action="../controller/controller.php" method="post">
                    <input name="nomCateg" type="text" placeholder="nom">
                    <button class="btn btn-add" name="ajouterCateg">
                        ajouter categorie
                    </button>
                </form>
                <table class="table">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>nom</th>

                        <th>nombre des plantes</th>

                        <th>Action</th>

                    </tr>

                    </thead>

                    <tbody style="text-align: center;">

                    <?php
                    $categ = new categorieController();
                    $categories = $categ->showCateg();
                    foreach ($categories as $category) :

                    ?>

                        <tr>

                            <td style="text-align: center;">
                                <?=$category['idCategorie']?>
                            </td>
                            </td>
                            <td style="text-align: center;">
                                <?=$category['nomCateorie']?>

                            </td>
                            <td style="text-align: center;">
                                <?=$category['plantCount']?>
                            </td>


                            <td style="text-align: center;">
                                <a class="btn btn-info" href="modifierCategorie.php?idCateg=<?= $category['idCategorie'] ?>">modifier</a>&nbsp;
                                    <a class="btn btn-danger" href="../controller/controller.php?deleteCateg=<?= $category['idCategorie'] ?>">supprimer</a>
                            </td>

                        </tr>
                    <?php
                    endforeach;
                    ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div class="details" id="themes">
        <div class="box">
            <div class="">
                <h1>Gestion des thèmes</h1>
                <form class="form" action="../controller/ajouterTheme.inc.php" method="post" enctype="multipart/form-data">
                    <input name="nomTheme" type="text" placeholder="Titre">
                    <input name="imageTheme" type="file" placeholder="">
                    <input name="descriptionTheme" type="text" placeholder="description">
                    <button class="btn btn-add" name="ajouterTheme">
                        ajouter thèmes
                    </button>
                </form>
                <table class="table">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Nom</th>

                        <th>Image</th>

                        <th>Description</th>

                        <th>Action</th>

                    </tr>

                    </thead>


                    <?php
//                    $themes = allThemes();
//                    foreach ($themes as $theme) :
                    ?>
                    <tbody style="text-align: center;">
                        <tr>

                            <td style="text-align: center;">
                                <?php
                                //                                 $plante['idPlante']
                                ?>

                            </td>
                            <td style="text-align: center;">

                            </td>
                            <td style="text-align: center;">
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($theme['imageTheme']); ?>" style="width: 200px; border-radius: 10px;" />


                            </td>
                            <td style="text-align: center;">

                            </td>


                            <td style="text-align: center;">
                                <a class="btn btn-info" href="modifierTheme.php?idTheme=">modifier</a>&nbsp;
                                <a class="btn btn-danger" href="../controller/supprimerTheme.inc.php?idTheme=">supprimer</a>
                            </td>


                        </tr>

                    </tbody>

                    <?php
//                    endforeach;
                    ?>

                </table>
            </div>
        </div>
    </div>
    <div class="details" id='tags'>
        <div class="box">

            <div class="">
                <h1>Gestion des tags</h1>

                <form class="form" action="../controller/ajouterTag.inc.php" method="post">
                    <input name="tagName" type="text" placeholder="nom de tag">

                    <select name="themeTag" id="">
                        <?php
//                        $themes = allThemes();
//                        foreach ($themes as $theme) :
                            ?>
                            <option ></option>
                        <?php
//                        endforeach;
                        ?>
                    </select>

                    <button class="btn btn-add" name="ajouterTag">
                        ajouter le tag
                    </button>
                </form>
                <table class="table">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Nom</th>


                        <th>theme</th>
                        <th>action</th>


                    </tr>

                    </thead>

                    <tbody style="text-align: center;">



                    </tbody>

                </table>
            </div>


        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="../assets/js/dashboard.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 0, // Adjust the offset as needed
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>