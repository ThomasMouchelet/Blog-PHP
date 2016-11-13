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

function nombrePages(){

	global $req;
	global $bdd;
	global $nb_pages;
	global $current_page;

	$req = $bdd->query('SELECT COUNT(id) AS nb_billets FROM billets');//On compte le nombre de billets
    $req->execute(array());//On exécute
    $donnees = $req->fetch();//On parcoure le tableau

    $nb_billets=$donnees['nb_billets'];//On injecte le nombre de billets dans une variable
    $per_pages= 4;//Nombre de billets par page
    $nb_pages=ceil($nb_billets/$per_pages);//ceil() permet d'arrondir à la virgule supérieur

    if (isset($_GET['page']) && $_GET['page']>0 && $_GET['page']<=$nb_pages) {//Si la variable $_GET['page'] est définie
        $current_page=$_GET['page'];

    }else{
        $current_page=1;//sinon par défaut elle est égale à 1
    }

    // On récupère les 5 derniers billets
    $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT '.(($current_page-1)*$per_pages).','.$per_pages.'');
}