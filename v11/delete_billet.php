<?php
session_start();

require 'connect.php';


print_r($_POST['billet']);

$req = $bdd->prepare('DELETE FROM billets WHERE id =?');
$req->execute(array($_POST['billet']));

// header('Location: admin.php');
?>