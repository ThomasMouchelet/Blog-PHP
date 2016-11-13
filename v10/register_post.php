<?php 
require 'connect.php';

// Hachage du mot de passe
	$pass_hache = sha1($_POST['password']);
	$login = $_POST['login'];



$req = $bdd->prepare('INSERT INTO users (login, password, avatar, type) VALUES(:login, :password, :avatar, :type)');
$req->execute(array(
    'login'=>$login,
    'password'=>$pass_hache,
    'avatar'=>'default.png',
    'type'=>'admin'
    ));

$msg='Votre compte a bien été créé';

//Redirection du visiteur vers la page du minichat
header('Location: login.php?msg='.$msg);