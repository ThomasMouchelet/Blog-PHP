<?php
// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


$req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW() )');
$req->execute(array(
    'id_billet'=>$_GET['billet'],
    'auteur'=>$_POST['auteur'],
    'commentaire'=>$_POST['commentaire']
    ));

//Redirection du visiteur vers la page du minichat
header('Location: commentaires.php?billet='.$_GET['billet']);
?>