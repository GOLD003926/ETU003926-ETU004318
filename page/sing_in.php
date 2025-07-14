<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/Mystyle.css">
</head>

<body class="bg-sombre-Body">
    <header>
    </header>
    <main>
        <div class="container pt-5">

            <div class="col-10 col-md-8 mx-auto mt-5 pt-5">
                <form class="row g-3 bg-body-tertiary  rounded p-3 needs-validation"  method="post" action="traitement_sing_in.php" enctype="multipart/form-data">
                    <div class="col-12 text-center">
                        <label for="" class="form-label fw-bold fs-2 ">Sing In</label>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="validationCustom01" name="nom" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Email</label>
                        <input type="email" class="form-control" id="validationCustom02" name="email" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label">Mot de passe</label>
                        <div class="input-group has-validation">
                            <input type="password" class="form-control" id="validationCustomUsername" name="mdp" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom05" class="form-label">Photo de profil</label>
                        <div class="mb-3">
                            <input type="file" class="form-control" aria-label="file example" name="photo_profil">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom03" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="validationCustom03" name="ville" required>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">Date de naissance</label>
                        <div class="input-group has-validation">
                            <input type="date" class="form-control" id="validationCustomUsername" name="date_naissance" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>