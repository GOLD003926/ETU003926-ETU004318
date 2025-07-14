<?php
require('../inc/fonction.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
//recuperer le nom ,id categorie , images[]
$idProprietaire = getInfoMembre($_SESSION['email'])['id_membre'];
if (isset($_POST['nom']) && isset($_POST['categorie'])) {
    $nomObjet = $_POST['nom'];
    $idCategorie = $_POST['categorie'];
    $ok = false;
    if (isset($_FILES['images'])) {
        echo "Images existantes<br>";
        $images = $_FILES['images'];
        $nbrImages = count($images['name']);
        for ($i = 0; $i < $nbrImages; $i++) {
            $img = [
                'name' => $images['name'][$i],
                'type' => $images['type'][$i],
                'tmp_name' => $images['tmp_name'][$i],
                'error' => $images['error'][$i],
                'size' => $images['size'][$i]
            ];
            $imageName = gestion_image($nomObjet, $img);
            if ($imageName) {
                $ok = ajoutObjet($nomObjet, $idCategorie, $idProprietaire, $imageName);
            }
        }
    }
    if ($ok) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'objet.";
    }
} else {
    echo "Veuillez remplir tous les champs.";
}
