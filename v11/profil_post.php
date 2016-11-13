<?php
if(!isset($_SESSION)) {
  session_start();
}
require 'connect.php';

$pass_hache = sha1($_POST['password']);
$login = $_POST['login'];
$id=$_SESSION['id'];
$msg;

if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
{
	$tailleMax=2097152;
	$extensionsValides= array('jpg','jpeg','png','gif');
	if($_FILES['avatar']['size']<= $tailleMax)
	{
		$extensionsUpload=strtolower(substr(strchr($_FILES['avatar']['name'],'.'), 1));
		if (in_array($extensionsUpload, $extensionsValides)) 
		{
			$chemin="images/avatars/".$_SESSION['id'].'.'.$extensionsUpload;
			$resultat=move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
			if ($resultat) {
				$upsateavatar=$bdd->prepare('UPDATE users SET avatar = :avatar WHERE id= :id');
				$upsateavatar->execute(array(
					'avatar'=>$_SESSION['id'].".".$extensionsUpload,
					'id'=>$_SESSION['id']
					));
				$_SESSION['avatar'] = $_SESSION['id'].".".$extensionsUpload;
			}else{
				$msg="Erreur pendant l'importation du fichier";
			}
		}else{
			$msg='Votre fichier doit être aux formats jpg, jpeg, png ou gif';
		}
	}else{
		$msg='La taille de votre fichier ne doit pas dépasser 2Mo';
	}
}

if (isset($login) AND !empty($login))
{
	$req = $bdd->prepare('UPDATE users SET login = :login, password = :password WHERE id = :id');
	$req->execute(array(
	'login'=> $login,
	'password'=> $pass_hache,
	'id' => $_SESSION['id']
	));

	// Suppression des cookies de connexion automatique
	setcookie('login', '');
	setcookie('pass_hache', '');
	$_SESSION['login'] = $_POST['login'];
}

if (isset($msg) AND !empty($msg))
{
	header('Location: profil.php?msg='.$msg);
}else{
	header('Location: profil.php');
}


