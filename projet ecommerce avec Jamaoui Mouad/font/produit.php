<?php

require_once "../includes/database.php";
$id = $_GET['id'];

$sql = "SELECT p.*, c.libelle as categorie_libelle 
        FROM produit p 
        INNER JOIN categorie c ON p.id_categorie = c.id 
        WHERE p.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    header('Location: index.php');
    exit();
}

$stmt2 = $pdo->prepare("SELECT * FROM produit WHERE id_categorie=? AND id != ? LIMIT 4");
$stmt2->execute([$produit['id_categorie'], $id]);
$produitsSimilaires = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "../includes/head.php"; // Si tu as créé ce fichier, sinon mets tes <link> ici 
    ?>
    <title><?= $produit['libelle'] ?> | Ecommerce</title>
    <style>
        .img-product-container {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .img-product-main {
            max-height: 500px;
            max-width: 100%;
            object-fit: contain;
        }

        .service-icon {
            font-size: 1.5rem;
            color: #0d6efd;
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <?php include "nav_front.php" ?>

    <div class="container py-5">

        <!-- Fil d'Ariane (Breadcrumb) -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="categorie.php?id=<?= $produit['id_categorie'] ?>" class="text-decoration-none"><?= $produit['categorie_libelle'] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $produit['libelle'] ?></li>
            </ol>
        </nav>

        <div class="row g-5">

            <!-- COLONNE GAUCHE : IMAGE -->
            <div class="col-md-6">
                <div class="img-product-container shadow-sm position-relative">
                    <?php if ($produit['discount'] > 0): ?>
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 fs-6">
                            Promo -<?= $produit['discount'] ?>%
                        </span>
                    <?php endif; ?>

                    <?php $imgPrd = !empty($produit['image']) ? '../' . $produit['image'] : "https://dummyimage.com/600x600/dee2e6/6c757d.jpg"; ?>
                    <img src="<?= $imgPrd ?>" class="img-product-main" alt="<?= $produit['libelle'] ?>">
                </div>
            </div>

            <!-- COLONNE DROITE : INFO & ACHAT -->
            <div class="col-md-6">
                <h1 class="fw-bold text-dark display-6"><?= $produit['libelle'] ?></h1>
                <p class="text-muted mb-4">Référence: PROD-<?= $produit['id'] ?></p>

                <!-- PRIX -->
                <div class="mb-4">
                    <?php if ($produit['discount'] > 0):
                        $prix = $produit['prix'];
                        $total = $prix - (($produit['discount'] * $prix) / 100);
                    ?>
                        <span class="fs-2 fw-bold text-primary"><?= number_format($total, 2) ?> MAD</span>
                        <span class="text-decoration-line-through text-muted ms-3 fs-5"><?= $prix ?> MAD</span>
                    <?php else: ?>
                        <span class="fs-2 fw-bold text-dark"><?= $produit['prix'] ?> MAD</span>
                    <?php endif; ?>
                </div>

                <!-- DESCRIPTION -->
                <div class="mb-4">
                    <h5 class="fw-bold">Description</h5>
                    <p class="text-secondary" style="line-height: 1.6;">
                        <?= !empty($produit['description']) ? nl2br($produit['description']) : "Aucune description détaillée disponible pour ce produit." ?>
                    </p>
                </div>

                <!-- BOUTONS D'ACTION (Compteur + Panier) -->
                <div class="card bg-white border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <?php $idProduit = $produit['id']; // Important pour ton counter.php 
                        ?>
                        <!-- On intègre ton compteur existant sans toucher à son style interne si tu veux -->
                        <?php include "../includes/front/counter.php" ?>
                    </div>
                </div>

                <!-- ÉLÉMENTS DE RASSURANCE (Icons) -->
                <div class="row mt-5 text-center">
                    <div class="col-4">
                        <i class="fa-solid fa-truck-fast service-icon"></i>
                        <p class="small fw-bold">Livraison Rapide</p>
                    </div>
                    <div class="col-4">
                        <i class="fa-solid fa-shield-halved service-icon"></i>
                        <p class="small fw-bold">Paiement Sécurisé</p>
                    </div>
                    <div class="col-4">
                        <i class="fa-solid fa-headset service-icon"></i>
                        <p class="small fw-bold">Support 24/7</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION PRODUITS SIMILAIRES -->
        <?php if (!empty($produitsSimilaires)): ?>
            <hr class="my-5">
            <h3 class="fw-bold mb-4">Vous aimerez aussi</h3>
            <div class="row">
                <?php foreach ($produitsSimilaires as $similaire): ?>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body p-2 text-center">
                                <?php $imgSim = !empty($similaire['image']) ? '../' . $similaire['image'] : "https://dummyimage.com/300x300/dee2e6/6c757d.jpg"; ?>

                                <?php if ($similaire['discount'] > 0): ?>
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-3 shadow">-<?= $similaire['discount'] ?>%</span>
                                <?php endif; ?>

                                <img src="<?= $imgSim ?>" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                <h6 class="text-truncate"><?= $similaire['libelle'] ?></h6>
                                <p class="text-primary fw-bold mb-0"><?= $similaire['prix'] ?> MAD</p>
                                <a href="produit.php?id=<?= $similaire['id'] ?>" class="stretched-link"></a> <!-- Rend toute la carte cliquable -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/produit/counter.js"></script>
</body>

</html>