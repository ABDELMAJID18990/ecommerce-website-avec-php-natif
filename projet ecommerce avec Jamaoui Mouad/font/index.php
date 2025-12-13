<?php
require_once "../includes/database.php";


$categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Liste des catégories</title>
    <style>
        .hover-effect {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid #007bff !important;
        }
    </style>
</head>

<body>
    <?php include "nav_front.php" ?>
    <div class="bg-light p-5 rounded-3 mb-4 text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bienvenue sur ShopEcommerce</h1>
            <p class="col-md-8 fs-4 mx-auto">Découvrez nos meilleures offres et une large sélection de produits de qualité.</p>
            <a href="#categories" class="btn btn-light btn-lg rounded-pill px-4 mt-3">Voir les catégories</a>
        </div>
    </div>
    <div class="container-fluid p-3">
        <h4 class="h4 text-center"><i class="fa-solid fa-list"></i> Liste des catégories</h4>

        <div class="container w-18">

            <div id="categories" class="container">
                <h3 class="text-center mb-4 text-muted text-uppercase fs-6">Nos Rayons</h3>
                <div class="row">
                    <?php foreach ($categories as $categorie): ?>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <a href="categorie.php?id=<?= $categorie['id'] ?>" class="text-decoration-none">
                                <div class="card shadow-sm h-100 text-center border-0 category-card hover-effect">
                                    <div class="card-body d-flex flex-col align-items-center justify-content-center p-5">
                                        <i class="<?= $categorie['icone'] ?> fa-3x text-primary mb-3"></i>
                                        <h4 class="card-title text-dark m-2"><?= $categorie['libelle'] ?></h4>
                                        <p class="text-muted small"><?= $categorie['description'] ?? 'Découvrir les produits' ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>

    </div>

</body>

</html>