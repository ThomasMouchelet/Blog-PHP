<?php
session_start();

require 'connect.php';



function updateBdd(){
	foreach (func_get_args() as $key) {
		# code...
	}
}


$req = $bdd->prepare('UPDATE billets SET titre = :titre, contenu = :contenu WHERE id = :id');
$req->execute(array(
	'titre'=> $_POST['titre'],
	'contenu'=> $_POST['contenu'],
	'id' => $_GET['billet']
	));

header('Location: admin.php');
?>