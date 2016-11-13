<?php
	require 'connect.php';

	// Hachage du mot de passe
	$pass_hache = sha1($_POST['password']);
	$login = $_POST['login'];

	// Vérification des identifiants
	$req = $bdd->prepare('SELECT id, type FROM users WHERE login = :login AND password = :password');
	$req->execute(array(
	    'login' => $login,
	    'password' => $pass_hache
	    ));

	$resultat = $req->fetch();

	if (!$resultat)
	{
	    header('Location: login.php');
	}
	else
	{
		session_start();
	    $_SESSION['id'] = $resultat['id'];
	    $_SESSION['type'] = $resultat['type'];
	    $_SESSION['pseudo'] = $login;
	    header('Location: admin.php');
	}

