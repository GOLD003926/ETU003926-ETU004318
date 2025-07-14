<?php
require('../inc/fonction.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$liste=getAllObjets();
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

            <table class="table mt-5 .bg-sombre-table,
bg-sombre-table th
bg-sombre-table td
bg-sombre-table tr">
                <thead>
                    <tr >
                        <th class="text-warning" scope="col">Nom objet</th>
                        <th class="text-warning" scope="col">Categorie</th>
                        <th class="text-warning" scope="col">Proprietaire</th>
                        <!-- <th scope="col">Date retour</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($liste as $list){ ?>
                        <tr>
                            <td scope="row"><?php echo htmlspecialchars($list['nom_objet']); ?></td>
                            <td><?php echo htmlspecialchars($list['nom_categorie']); ?></td>
                            <td><?php echo htmlspecialchars($list['nom_proprietaire']); ?></td>
                            <!-- <td><?php echo htmlspecialchars($list['date_retour']); ?></td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
        <footer>

        </footer>
    </div>
</body>

</html>