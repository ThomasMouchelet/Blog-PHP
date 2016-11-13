<?php
// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}