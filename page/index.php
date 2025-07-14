<?php
require('../inc/fonction.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$liste = getAllObjets();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
        <main>
            <div class="d-flex wrap justify-content-around flex-wrap">
                <?php foreach ($liste as $list) {
                    $image=getImageObjet($list['id_objet']);
                    $image="../assets/image/".$image;
                ?>
                    <div class="card mt-2 mb-1" style="width: 18rem;">
                        <img src="<?= $image ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title"><?php echo htmlspecialchars($list['nom_objet']); ?></h6>
                            <h6 class="card-title">Categorie : <?php echo htmlspecialchars($list['nom_categorie']); ?></h6>
                            <h6 class="card-title">Proprietaire : <?php echo htmlspecialchars($list['nom_proprietaire']); ?></h6>
                        </div>
                    </div>
                <?php
                } ?>
            </div>

        </main>
        <footer>

        </footer>
    </div>
</body>

</html>