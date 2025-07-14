<?php
function dbconnect()
{
    static $connect = null;

    if ($connect === null) {
        // Modifier ici les paramètres de connexion
        //$connect = mysqli_connect('localhost', 'root', '', 'final_project');
         $connect = mysqli_connect('localhost', 'ETU003926', '1S7L2tMW', 'db_s2_ETU003926');
        // 'root' = utilisateur MySQL/XAMPP
        // '' = mot de passe vide par défaut sous XAMPP
        // 'employees' = nom de la base que tu as importée

        if (!$connect) {
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        mysqli_set_charset($connect, 'utf8mb4');
    }

    return $connect;
}
