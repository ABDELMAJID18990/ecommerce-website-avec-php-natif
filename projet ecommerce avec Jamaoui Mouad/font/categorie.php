<?php

require_once "../includes/database.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM categorie WHERE id=?");
$stmt->execute([$id]);
$categorie = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare("SELECT * FROM produit WHERE id_categorie=?");
$stmt2->execute([$id]);
$produits = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link  rel="stylesheet" href="..\assets\css\produit.css">
    <title>Catégorie | <?=$categorie['libelle']?> </title>
    
</head>
<body>
    <?php include "nav_front.php" ?>
    <div class="container-fluid p-3">
        
        <h4 class="h4 text-center mb-4"><i class="<?= $categorie['icone']?> m-2"></i> <?=$categorie['libelle']?></h4>
        <div class="container">
            <div class="row">
                <?php if(empty($produits)):?>
                    <div class="alert alert-info pt-4" role="alert">
                        <p class="fw-bolder">Pas de produits pour l'instant.</p> 
                    </div>

                <?php endif;?>    

                <?php foreach($produits as $prd): ?> 
                <?php $idProduit = $prd['id']  ?> 

                <div class="card mb-3 col-md-4">
                    <?php $imgPrd = !empty($prd['image']) ? '../'.$prd['image']  : "https://www.feed-image-editor.com/sites/default/files/perm/wysiwyg/image_not_available.png" ;?>
                    <img src="<?= $imgPrd ?>" height="400" class="card-img-top img-fluid rounded pt-1" alt="<?= $prd['libelle'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $prd['libelle'] ?></h5>
                        <p class="card-text"><?= $prd['prix'] ?> MAD</p>
                        <p class="card-text"><small class="text-body-secondary">Ajouté le : <?= date_format(date_create($prd['date_creation']), 'Y-m-d') ?></small></p>
                        <a href="produit.php?id=<?= $prd['id'] ?>" class="btn btn-primary stretched-link">Afficher détaills</a>
                    </div>

                    <div class="card-footer bg-transparent" style="z-index: 10;">
                        <?php include "../includes/front/counter.php" ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>   
        </div>
    </div>
<script src="..\assets\js\produit\counter.js"></script>
    
</body>
</html>

