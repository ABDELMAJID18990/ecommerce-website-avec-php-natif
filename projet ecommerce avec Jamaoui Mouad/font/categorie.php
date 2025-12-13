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
    <link rel="stylesheet" href="..\assets\css\produit.css">
    <title>Catégorie | <?= $categorie['libelle'] ?> </title>

</head>

<body>
    <?php include "nav_front.php" ?>
    <div class="container-fluid p-3">

        <h4 class="h4 text-center mb-4"><i class="<?= $categorie['icone'] ?> m-2"></i> <?= $categorie['libelle'] ?></h4>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $categorie['libelle'] ?></li>
                </ol>
            </nav>
            <div class="row">
                <?php if (empty($produits)): ?>
                    <div class="alert alert-info pt-4" role="alert">
                        <p class="fw-bolder">Pas de produits pour l'instant.</p>
                    </div>

                <?php endif; ?>

                <?php foreach ($produits as $prd): ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm border-0 product-card position-relative">

                            <!-- Badge Discount -->
                            <?php if ($prd['discount'] > 0): ?>
                                <span class="badge bg-danger position-absolute top-0 start-0 m-3 shadow">-<?= $prd['discount'] ?>%</span>
                            <?php endif; ?>

                            <!-- Image Container  -->
                            <div class="d-flex align-items-center justify-content-center bg-white rounded-top p-3" style="height: 250px; overflow: hidden;">
                                <?php $imgPrd = !empty($prd['image']) ? '../' . $prd['image'] : "https://dummyimage.com/600x400/dee2e6/6c757d.jpg"; ?>
                                <img src="<?= $imgPrd ?>" style="max-height: 100%; max-width: 100%; object-fit: contain;" alt="<?= $prd['libelle'] ?>">
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark text-truncate"><?= $prd['libelle'] ?></h5>
                                <p class="card-text text-muted small">
                                    Added: <?= date_format(date_create($prd['date_creation']), 'd/m/Y') ?>
                                </p>

                                <!-- Prix Section -->
                                <div class="mt-auto">
                                    <?php if ($prd['discount'] > 0):
                                        $total = $prd['prix'] - (($prd['discount'] * $prd['prix']) / 100);
                                    ?>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-decoration-line-through text-muted small"><?= $prd['prix'] ?> MAD</span>
                                            <span class="h5 fw-bold text-primary mb-0"><?= number_format($total, 2) ?> MAD</span>
                                        </div>
                                    <?php else: ?>
                                        <span class="h5 fw-bold text-dark"><?= $prd['prix'] ?> MAD</span>
                                    <?php endif; ?>

                                    <div class="d-grid gap-2 mt-3">
                                        <a href="produit.php?id=<?= $prd['id'] ?>" class="btn btn-outline-dark btn-sm rounded-pill">
                                            <i class="fa-solid fa-eye"></i> Voir détails
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-top-0 pb-3">
                                <?php
                                $idProduit = $prd['id'];
                                include "../includes/front/counter.php";
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <script src="..\assets\js\produit\counter.js"></script>

</body>

</html>