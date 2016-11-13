<?php
require 'connect.php';


$req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW() )');
$req->execute(array(
    'id_billet'=>$_GET['billet'],
    'auteur'=>$_POST['auteur'],
    'commentaire'=>$_POST['commentaire']
    ));

//Redirection du visiteur vers la page du minichat
header('Location: commentaires.php?billet='.$_GET['billet']);
?>