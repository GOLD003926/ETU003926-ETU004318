<?php
require("connection.php");
date_default_timezone_set('Africa/Nairobi');

function verifie_email($email)
{
    $bdd = dbconnect();
    $query = sprintf("SELECT * FROM final_membre WHERE email = '%s'", mysqli_real_escape_string($bdd, $email));
    $result = mysqli_query($bdd, $query);
    if (mysqli_num_rows($result) > 0) return true;
    return false;
}
function verifie_connexion($email, $mdp)
{
    $bdd = dbconnect();
    $query = sprintf("SELECT * FROM final_membre WHERE email = '%s' AND mot_de_passe = '%s'", mysqli_real_escape_string($bdd, $email), mysqli_real_escape_string($bdd, $mdp));
    $result = mysqli_query($bdd, $query);
    if (mysqli_num_rows($result) > 0) return true;
    return false;
}
function  creerUser($email, $nom, $mdp, $ville, $date_naissance, $pdp)
{
    $bdd = dbconnect();
    $query = sprintf(
        "INSERT INTO final_membre (email, nom, mot_de_passe, ville, date_naissance, image_profil) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
        mysqli_real_escape_string($bdd, $email),
        mysqli_real_escape_string($bdd, $nom),
        mysqli_real_escape_string($bdd, $mdp),
        mysqli_real_escape_string($bdd, $ville),
        mysqli_real_escape_string($bdd, $date_naissance),
        mysqli_real_escape_string($bdd, $pdp)
    );
    if ($bdd->query($query) === TRUE) {
        header("Location:index.php");
        exit();
    } else {
        echo 'Erreur lors de la creation de l\'user dans la base de données : ' . mysqli_error($bdd);
    }
}
function gestion_image($image_name, $file)
{
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $uploadDir = __DIR__ . '/../assets/image/';
    $maxSize = 20 * 1024 * 1024; // 20 Mo
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Vérifie la taille
    if ($file['size'] > $maxSize) {
        die('Le fichier est trop volumineux.');
    }

    // Vérifie le type MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypes)) {
        die('Type de fichier non autorisé : ' . $mime);
    }

    // Renomme le fichier
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $image_name . '.' . $extension;

    // Déplace le fichier
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        echo "Fichier uploadé avec succès : " . $newName;
        return $newName;
    } else {
        echo "Échec du déplacement du fichier.";
        return false;
    }
}
function getAllEmpruntes()
{
    $bdd = dbconnect();
    $query = "SELECT * FROM v_emprunt_objet_membre_categorie";
    $result = mysqli_query($bdd, $query);
    if (!$result) {
        die('Erreur lors de la récupération des emprunts : ' . mysqli_error($bdd));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function getAllObjets()
{
    $bdd = dbconnect();
    $query = "SELECT * FROM v_objet_proprietaire_categorie order by id_categorie";
    $result = mysqli_query($bdd, $query);
    if (!$result) {
        die('Erreur lors de la récupération des emprunts : ' . mysqli_error($bdd));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function getInfoMembre($email)
{
    if (is_null($email)) {
        return null;
    }

    $bdd = dbconnect();
    $email_esc = mysqli_real_escape_string($bdd, $email);
    $query = "SELECT * FROM final_membre WHERE email = '$email_esc'";
    $result = mysqli_query($bdd, $query);

    if (!$result) {
        die('Erreur lors de la récupération des informations du membre : ' . mysqli_error($bdd));
    }

    return mysqli_fetch_assoc($result);
}

function getImageObjet($id_objet)
{
    $bdd = dbconnect();

    $query = sprintf(
        "SELECT nom_image FROM final_images_objet WHERE id_objet = '%s' LIMIT 1",
        mysqli_real_escape_string($bdd, $id_objet)
    );

    $result = mysqli_query($bdd, $query);

    if (!$result) {
        die("Erreur lors de la récupération de l'image : " . mysqli_error($bdd));
    }

    $row = mysqli_fetch_assoc($result);
    return $row ? $row['nom_image'] : 'default_objet.jpg';
}
function getAllImagesObjet($id_objet)
{
    $bdd = dbconnect();
    $images = [];

    $query = sprintf(
        "SELECT nom_image FROM final_images_objet WHERE id_objet = '%s'",
        mysqli_real_escape_string($bdd, $id_objet)
    );

    $result = mysqli_query($bdd, $query);

    if (!$result) {
        die("Erreur lors de la récupération des images : " . mysqli_error($bdd));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $images[] = $row['nom_image'];
    }

    if (empty($images)) {
        $images[] = 'default_objet.jpg';
    }

    return $images;
}


function getAllCategories()
{
    $bdd = dbconnect();
    $query = "SELECT * FROM final_categorie_objet";
    $result = mysqli_query($bdd, $query);
    if (!$result) {
        die('Erreur lors de la récupération des catégories : ' . mysqli_error($bdd));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function ajoutObjet($nom, $idCategorie, $idProprietaire, $imageName)
{
    $bdd = dbconnect();
    $query = sprintf(
        "INSERT INTO final_objet (nom_objet, id_categorie, id_membre) VALUES ('%s', '%s', '%s')",
        mysqli_real_escape_string($bdd, $nom),
        mysqli_real_escape_string($bdd, $idCategorie),
        mysqli_real_escape_string($bdd, $idProprietaire)
    );
    if (mysqli_query($bdd, $query)) {
        $idObjet = mysqli_insert_id($bdd);
        if ($imageName) {
            $queryImage = sprintf(
                "INSERT INTO final_images_objet (id_objet, nom_image) VALUES ('%s', '%s')",
                mysqli_real_escape_string($bdd, $idObjet),
                mysqli_real_escape_string($bdd, $imageName)
            );
            mysqli_query($bdd, $queryImage);
        }
        return true;
    } else {
        echo 'Erreur lors de l\'ajout de l\'objet : ' . mysqli_error($bdd);
        return false;
    }
}
function getOneObjet($id_objet)
{
    $bdd = dbconnect();
    $query = sprintf(
        "SELECT * FROM v_objet_proprietaire_categorie WHERE id_objet = '%s'",
        mysqli_real_escape_string($bdd, $id_objet)
    );
    $result = mysqli_query($bdd, $query);
    if (!$result) {
        die('Erreur lors de la récupération de l\'objet : ' . mysqli_error($bdd));
    }
    return mysqli_fetch_assoc($result);
}
