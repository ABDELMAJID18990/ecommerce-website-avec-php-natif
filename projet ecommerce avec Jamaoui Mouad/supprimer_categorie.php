<?php

require_once "includes/database.php";

$id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM produit WHERE id_categorie = ? LIMIT 1");
$stmt->execute([$id]);

if ($stmt->fetch()) {
    // Redirection avec message d'erreur dans l'URL
    header("Location: categories.php?erreur=La catégorie contient des produits");
} else {
    // Suppression de la catégorie
    $pdo->prepare("DELETE FROM categorie WHERE id = ?")->execute([$id]);
    
    // Redirection avec message de succès
    header('Location: categories.php?succes=Catégorie supprimée avec succès');
}
exit();



?>