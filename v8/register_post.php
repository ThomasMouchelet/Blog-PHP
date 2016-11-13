<?php 
require 'connect.php';

// Hachage du mot de passe
	$pass_hache = sha1($_POST['password']);
	$login = $_POST['login'];



$req = $bdd->prepare('INSERT INTO users (login, password) VALUES(:login, :password)');
$req->execute(array(
    'login'=>$login,
    'password'=>$pass_hache
    ));

//Redirection du visiteur vers la page du minichat
header('Location: login.php');