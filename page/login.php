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

        <div class="col-10 col-md-5 mx-auto mt-5 pt-5">

        <form class="row g-3 mx-auto bg-body-tertiary p-3 rounded mt-5 " method="post" action="traitement_login.php">
            <div class="col-12 text-center">
                <label for="" class="form-label fw-bold fs-2 ">Login</label>
            </div>
            <div class="col-12">
                <label for="" class="form-label fw-bold">Votre Email</label>
                <input type="email" class="form-control" id="" placeholder="example@gmail.com" name="email" required>
            </div>
            <div class="col-12">
                <label for="" class="form-label fw-bold">Votre Mot de Passe</label>
                <input type="password" class="form-control" id="" placeholder="*******" name="mdp" required>
            </div>
            <label for="" class="form-label fw-bold"><a href="sing_in.php">Vous n'avez pas encore de compte ?</a></label>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        </form>

        </div>

    </div>
    </main>
    <footer>
    </footer>
</body>

</html>