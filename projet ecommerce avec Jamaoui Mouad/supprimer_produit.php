<?php

require_once "includes/database.php";

$id = $_GET['id'];


   
    $stmt = $pdo->prepare("DELETE FROM produit WHERE id = ?");
    $stmt->execute([$id]);
    
    
    header('Location: produits.php?succes=Le produit a été supprimé avec succès.');
    exit();



?>