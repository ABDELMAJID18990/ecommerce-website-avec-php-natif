<?php

require_once "../includes/database.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM produit WHERE id=?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>Produit | <?= $produit['libelle'] ?></title>
</head>
<body>
    <?php include "nav_front.php" ?>
    <div class="container-fluid py-2">
        
        <h4 class="h4 text-center mb-4"><?=$produit['libelle']?></h4>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php $imgPrd = !empty($produit['image']) ? '../'.$produit['image']  : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsXKkvbpiawZitYkuujSsTqF6eDWQm6oU4kw&s" ;?>
                    <img src="<?= $imgPrd ?>"class="card-img-top img-fluid rounded pt-1 w-75" alt="<?= $produit['libelle'] ?>">
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center pb-2">
                        <h1 class="w-100"><?=$produit['libelle']?></h1>
                    <?php if($produit['discount'] != 0 ): ?>
                    <h6>
                            <span class="badge text-bg-success">- <?= $produit['discount'] ?> %</span>
                    </h6>
                    <?php endif; ?>
                    </div>

                    <hr>

                    <?php if($produit['description'] !== "" ): ?>
                    <p class="py-2"><?=$produit['description']?></p>
                    <?php else: ?>
                    <p class="py-2">No description disponible</p>
                    <?php endif; ?>
                    <hr>


                    <?php if($produit['discount'] != 0){
                        $discount = $produit['discount'];
                        $prix = $produit['prix'];
                        $total = $prix - (($discount * $prix)/100);
                        ?>

                        <div class="d-flex py-4 mb-2 ">
                            <h5 class="m-2 ">
                                <span class="badge text-bg-danger"><strike><?=$prix?> MAD</strike></span>
                            </h5>
                            <h5 class="m-2 ">
                                <span class="badge text-bg-success"><?=$total?> MAD</span>
                            </h5>
                        </div>
                        

                        <?php

                    }else{
                        ?>
                        <h4>
                            <span class="badge text-bg-success mb-2"><?= $produit['prix'] ?> MAD</span>
                        </h4>
                        
                        <?php
                   } ?>
                    
                    <hr>
                    <div class="d-flex">
                        <div class="col-md-6">
                            <?php $idProduit = $produit['id']; ?>
                            <?php include "../includes/front/counter.php" ?>
                        </div>
                        <!--<div class="col-md-6">
                            <a class="btn btn-primary pt-2" href="#">Ajouter au panier</a>
                        </div>-->
                       
                    </div>
                   

                </div>
                
            </div>
                 
        </div>
 

    </div>

<script src="..\assets\js\produit\counter.js"></script>   
</body>
</html>

