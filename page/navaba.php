<?php
session_start();
$mail = $_SESSION['email'] ?? null;
$membre = getInfoMembre($mail);

$nom = isset($membre['nom']) ? strtoupper($membre['nom']) : 'INVITÉ';

$pdp = $membre['image_profil'] ?? 'default.png';
$pdp = ($pdp == "default.png") ? "../assets/image/default.png" : "../assets/image/" . $pdp;
?>

<nav class="navbar navbar-expand-lg bg-sombre-nav">
    <div class="container-fluid bg-sombre-nav">
        <a class="navbar-brand fw-bold text-light" href="#">
            <img src="<?= $pdp ?>" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
            <?= $nom ?></a>
        <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-light"></span>
        </button>
        <div class="collapse navbar-collapse bg-sombre-nav ms-5" id="navbarSupportedContent">
            <ul class="navbar-nav bg-sombre-nav text-light me-auto mb-2 mb-lg-0">
                <li class="nav-item text-light">
                    <a class="nav-link  text-light" aria-current="page" href="index.php">Home</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link text-light" href="addNewObject.php">Add new object</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link ">Disabled</a>
                </li> -->
            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add new object
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content bg-sombre-nav">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajout d'un nouveau objet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="ajoutObjet_traitement.php" method="post" enctype="multipart/form-data">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">Nom de l'objet</span>
                                <input type="text" name="nom" class="form-control" placeholder="" aria-label="Username" aria-describedby="addon-wrapping">
                            </div>
                            <select class="form-select mt-2" aria-label="Default select example" name="categorie">
                                <option>Categorie</option>
                                <?php
                                $choix=getAllCategories();
                                foreach ($choix as $c) {
                                   ?>
                                   <option value="<?= $c['id_categorie'] ?>"><?= $c['nom_categorie'] ?></option>
                                   <?php
                                }
                                ?>
                            </select>
                            <div class="input-group mb-3 mt-2">
                                <label class="input-group-text" for="inputGroupFile01">Images</label>
                                <input type="file" class="form-control" id="inputGroupFile01" accept="image/*" name="images[]" multiple>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>