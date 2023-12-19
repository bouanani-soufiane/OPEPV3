<?php
include_once '../model/PlanteModel.php';

$plante = new PlantModel();
$input = $_POST['search_input'];

// Call the search method with the input
$results = $plante->search($input);

if (!empty($results)) {
    foreach ($results as $row) {
        ?>

            <div class="card d-flex flex-column align-items-center col-4">
                <p><?= $row['nom']; ?></p>
                <img class="my-2" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width: 200px;  border-radius: 10px;" />
                <div>
                    <a class="btn btn-shop btn-sm" href="../controller/controller.php?addToPanier=<?= $row['idPlante']; ?>">Ajouter au panier</a>
                </div>
            </div>

        <?php
    }
} else {
    echo "<h6>no data</h6>";
}

?>