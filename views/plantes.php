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