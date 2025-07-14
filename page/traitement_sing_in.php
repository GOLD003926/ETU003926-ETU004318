<?php
require('../inc/fonction.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['ville']) && isset($_POST['date_naissance'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $ville = $_POST['ville'];
    $date_naissance = $_POST['date_naissance'];
    $image_profil = $_FILES['photo_profil'] ?? null;
    if($image_profil==null || $image_profil['error'] != UPLOAD_ERR_OK) {
        $pdp = "default.png";
    } else {
        $pdp=gestion_image($nom, $image_profil);
    }

    if(verifie_email($email)){
        echo "Email déjà utilisé.";
    } else {
        creerUser($email, $nom, $mdp, $ville, $date_naissance, $pdp);
        $_SESSION['email'] = $email;
    }
} else {
    echo "Veuillez remplir tous les champs.";
}
?>