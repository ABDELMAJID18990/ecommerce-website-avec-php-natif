<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Liste des Produits</title>
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
$sql= "SELECT c.libelle AS libelle_categorie, p.* FROM produit p
INNER JOIN categorie c ON c.id = p.id_categorie
ORDER BY p.date_creation DESC";
$stmt = $pdo->query($sql);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

?> 
<div class="container py-2">
   <h2 class="text-center">Liste des produits</h2> 
   <a href="ajouter_produit.php" class="btn btn-primary my-2">Ajouter produit</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Libellé</th>
                <th scope="col">Prix</th>
                <th scope="col">Image</th>
                <th scope="col">Discount</th>
                <th scope="col">Nom Catégorie</th>
                <th scope="col">Date Création</th>
                <th scope="col">Opérations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produits as $produit): ?>
                <tr>
                    <th scope="row"><?=$produit["id"]?></th>
                    <td><?=$produit["libelle"]?></td>
                    <td><?=$produit["prix"]?> DH</td>
                    <td>
                        <?php $imgPrd = !empty($produit['image']) ? htmlspecialchars($produit['image'])  : "https://www.feed-image-editor.com/sites/default/files/perm/wysiwyg/image_not_available.png" ?>
                        <img class="img img-thumbnail img-fluid rounded" height="100" width="100" src="<?=$imgPrd?>" alt="<?=$produit["libelle"]?>"   > 
                    </td>
                    <td><?=$produit["discount"]?>%</td>
                    <td><?=$produit["libelle_categorie"]?></td>
                    <td><?=$produit["date_creation"]?></td>
                    <td>
                        <a href="modifier_produit.php?id=<?= $produit["id"] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_produit.php?id=<?= $produit["id"] ?>"  onclick="return confirm
                        ('Voulez vous vraiment supprimer le produit')" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>    

        </tbody>
    </table>
    
    
  
  
  
  



<?php

// Afficher le message si présent dans l'URL

if (isset($_GET['succes'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_GET['succes']) . '</div>';
}
?>
</div>
</div>



    
</body>
</html>

