<?php
require('../inc/fonction.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$liste = getAllObjetsAvecInfos();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-sombre-Body">
    <div class="container mt-4">
        <h1 class="text-light">Liste des objets</h1>
        <div class="row">
            <?php foreach ($liste as $objet) {
                $images = getAllImagesObjet($objet['id_objet']);
                $image = "../assets/image/" . ($images[0] ?? 'default_objet.jpg');
            ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?= htmlspecialchars($image) ?>" class="card-img-top" alt="objet" style="max-height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($objet['nom_objet']) ?></h5>
                        <p class="card-text">
                            Catégorie : <?= htmlspecialchars($objet['nom_categorie']) ?><br>
                            Propriétaire : <?= htmlspecialchars($objet['nom_proprietaire']) ?>
                        </p>
                        <a href="fiche_objet.php?idObjet=<?= $objet['id_objet'] ?>" class="btn btn-primary">Voir la fiche</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
