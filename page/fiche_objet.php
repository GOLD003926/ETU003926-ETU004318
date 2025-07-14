<?php
require('../inc/fonction.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$idObjet = $_GET['idObjet'] ?? null;
if (!$idObjet) {
    die("ID de l'objet manquant dans l'URL.");
}

$fiche = getOneObjet($idObjet);
if (!$fiche) {
    die("Erreur : l'objet avec l'id " . htmlspecialchars($idObjet) . " n'existe pas.");
}

$liste = getAllImagesObjet($idObjet);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Objet</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/Mystyle.css">
</head>
<body class="bg-sombre-Body">
    <div class="container ">
        <header>
            <?php include 'navaba.php' ?>
        </header>
        <main class="mt-4">
            <div class="alert alert-light bg-sombre-nav" role="alert">
                <div class="col-12">
                    <label class="form-label">Nom de l'objet : <?= htmlspecialchars($fiche['nom_objet']) ?></label>
                </div>
                <div class="col-12">
                    <label class="form-label">Catégorie de l'objet : <?= htmlspecialchars($fiche['nom_categorie']) ?></label>
                </div>
                <div class="col-12">
                    <label class="form-label">Propriétaire : <?= htmlspecialchars($fiche['nom_proprietaire']) ?></label>
                </div>
            </div>
            <h3><span class="badge bg-secondary">Images</span></h3>
            <div class="d-flex wrap justify-content-around flex-wrap">
                <?php foreach ($liste as $list) {
                    $image = "../assets/image/" . $list;
                ?>
                    <div class="card mt-2 mb-1" style="width: 18rem;">
                        <img src="<?= htmlspecialchars($image) ?>" class="card-img-top" alt="objet" style="max-height: 400px; object-fit: cover;">
                    </div>
                <?php } ?>
            </div>
        </main>
        <footer></footer>
    </div>
</body>
</html>
