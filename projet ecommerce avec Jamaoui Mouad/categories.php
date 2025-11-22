<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Liste des Catégorie</title>
</head>
<body>
<div class="container-fluid">
<?php
include "includes/navbar.php";

if(empty($_SESSION['utilisateur'])){
    header('Location: connexion.php');
    exit();
}
require_once "includes/database.php";

$stmt = $pdo->query("SELECT * FROM categorie");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?> 
<div class="container py-2">
   <h2 class="text-center">Liste des catégories</h2> 
   <a href="ajouter_categorie.php" class="btn btn-primary my-2">Ajouter categorie</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Libellé</th>
                <th scope="col">Description</th>
                <th scope="col">Icône</th>
                <th scope="col">Date Création</th>
                <th scope="col">Opérations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $categorie): ?>
                <tr>
                    <th scope="row"><?=$categorie["id"]?></th>
                    <td><?=$categorie["libelle"]?></td>
                    <td><?=$categorie["description"]?></td>
                    <td><i class="<?=$categorie["icone"]?>"></i></td>
                    <td><?=$categorie["date_creation"]?></td>
                    <td>
                        <a href="modifier_categorie.php?id=<?= $categorie["id"] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_categorie.php?id=<?= $categorie["id"] ?>"  onclick="return confirm
                        ('Voulez vous vraiment supprimer la catégorie')" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>    

        </tbody>
    </table>
    
    
  
  
  
  



<?php

// Afficher le message si présent dans l'URL
if (isset($_GET['erreur'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['erreur']) . '</div>';
}
if (isset($_GET['succes'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_GET['succes']) . '</div>';
}
?>

</div>

</div>

    
</body>
</html>

