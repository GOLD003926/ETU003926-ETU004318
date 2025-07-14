<?php
require('../inc/fonction.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    if (verifie_connexion($email, $mdp)) {
        $_SESSION['email'] = $email;
        header("Location: index.php");
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
} else {
    echo "Veuillez remplir tous les champs.";
}
?>