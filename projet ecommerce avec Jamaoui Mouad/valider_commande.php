<?php 
require_once "includes/database.php";

$id = $_GET['id'];
$etat = $_GET['etat'];

$stmt = $pdo->prepare('UPDATE commande SET valide = ? WHERE id = ?');
$stmt->execute([$etat, $id]);

header('Location: commande.php?id='.$id);
exit();


?>