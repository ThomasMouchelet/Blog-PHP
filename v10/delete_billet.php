<?php
session_start();

require 'connect.php';

$req = $bdd->prepare('DELETE FROM billets WHERE id =?');
$req->execute(array($_GET['billet']));

header('Location: admin.php');
?>