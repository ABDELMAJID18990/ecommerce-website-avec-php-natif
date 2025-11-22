<?php
session_start();

if(empty($_SESSION['utilisateur'])){
    header('Location: ../connexion.php');   
    exit();
}


$id = $_POST['id'];
$qte = $_POST['qte'];
$idUtilisateur = $_SESSION['utilisateur']['id'];

unset($_SESSION['panier'][$idUtilisateur][$id]);

header("location: ".$_SERVER['HTTP_REFERER']);
exit();


?>