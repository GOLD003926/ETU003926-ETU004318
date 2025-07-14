<?php 
session_start();
$mail=$_SESSION['email'] ?? null;
$membre=getInfoMembre($mail);
$nom=$membre['nom'];
$nom = strtoupper($nom);
$pdp=$membre['image_profil'] ?? 'default.png';
if ($pdp=="default.png") {
    $pdp = "../assets/image/default.png";
} else {
    $pdp = "../assets/image/" . $pdp;
}

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
                    <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ">Disabled</a>
                </li> -->
            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>