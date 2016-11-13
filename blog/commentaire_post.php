<?php
// Connecxion base de données
require 'connect.php';

//insertion des données grâce à INSERT INTO 
$req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())');
$req->execute(array(
	'id_billet'=>$_GET['billet'],
	'auteur'=>$_POST['auteur'],
	'commentaire'=>$_POST['commentaire']
	));



//Redirection vers la page du billet grâce à 
header('location: commentaires.php?billet='.$_GET['billet']);