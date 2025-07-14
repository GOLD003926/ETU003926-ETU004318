<?php
require('../inc/fonction.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
            <?php include 'navaba.php';
            $mail = $_SESSION['email'];
            $fiche = getInfoMembre($mail);
            ?>
        </header>
        <main class="mt-4">
            <div class="alert alert-light bg-sombre-nav" role="alert">
                <div class="col-12">
                    <label class="form-label">Nom : <?= htmlspecialchars($fiche['nom']) ?></label>
                </div>
                <div class="col-12">
                    <label class="form-label">Email : <?= htmlspecialchars($fiche['email']) ?></label>
                </div>
                <div class="col-12">
                    <label class="form-label">Ville : <?= htmlspecialchars($fiche['ville']) ?></label>
                </div>
                <div class="col-12">
                    <label class="form-label">Date naissance : <?= htmlspecialchars($fiche['date_naissance']) ?></label>
                </div>
            </div>

            <table class="table .bg-sombre-table,
bg-sombre-table th
bg-sombre-table td
bg-sombre-table tr ">
                <thead>
                    <tr>
                        <th scope="col">Nom Objet</th>
                        <th scope="col">Nom proprietaire</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Date emprunt</th>
                        <th scope="col">Date retour</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $liste = getAllEmpruntes($fiche['nom']);
                    foreach ($liste as $list) {
                    ?>
                        <tr>
                            <th scope="row"  class="pt-2" ><?= htmlspecialchars($list['nom_objet']) ?></th>
                            <td class="pt-2"><?= htmlspecialchars($list['nom_proprietaire']) ?></td>
                            <td class="pt-2"><?= htmlspecialchars($list['nom_categorie']) ?></td>
                            <td class="pt-2"><?= htmlspecialchars($list['date_emprunt']) ?></td>
                            <td >
                            <div class="d-flex align-items-center m-0 p-0">    
                            <?= htmlspecialchars($list['date_retour']) ?>
                        <?php include 'rendreObjet.php' ?>
                            </div>
                        </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </main>
        <footer>

        </footer>
    </div>
</body>

</html>