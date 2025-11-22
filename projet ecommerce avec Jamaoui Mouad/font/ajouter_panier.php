<?php
session_start();

if(empty($_SESSION['utilisateur'])){
    header('Location: ../connexion.php');   
    exit();
}


$id = $_POST['id'];
$qte = $_POST['qte'];
$idUtilisateur = $_SESSION['utilisateur']['id'];



if(!isset($_SESSION['panier'][$idUtilisateur])){
        $_SESSION['panier'][$idUtilisateur] = [];
    }

if( $qte == 0){
    unset($_SESSION['panier'][$idUtilisateur][$id]);
}else{
    $_SESSION['panier'][$idUtilisateur][$id] = $qte; 
}


header("location: ".$_SERVER['HTTP_REFERER']);
exit();
?>