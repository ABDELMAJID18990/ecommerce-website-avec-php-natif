<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- J'utilise Google Fonts pour un look plus moderne -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }

        .card-counter {
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: .3s linear all;
            position: relative;
            overflow: hidden;
        }

        .card-counter:hover {
            box-shadow: 4px 4px 20px #DADADA;
            transform: scale(1.02);
        }

        .card-counter.primary {
            background-color: #007bff;
            color: #FFF;
        }

        .card-counter.success {
            background-color: #198754;
            color: #FFF;
        }

        .card-counter.danger {
            background-color: #ef5350;
            color: #FFF;
        }

        .card-counter.warning {
            background-color: #ffc107;
            color: #333;
        }

        .card-counter.warning i {
            color: #fff;
            
        }



        .card-counter i {
            font-size: 5em;
            opacity: 0.2;
            position: absolute;
            right: 15px;
            top: 15px;
        }

        .card-counter .count-numbers {
            font-size: 32px;
            display: block;
            font-weight: 700;
        }

        .card-counter .count-name {
            font-size: 18px;
            text-transform: capitalize;
            opacity: 0.9;
            display: block;
        }
    </style>
</head>

<body>

    <?php
    include "includes/navbar.php";
    require_once "includes/database.php";

    if (empty($_SESSION['utilisateur'])) {
        header('Location: connexion.php');
        exit();
    }

    $prodsCount = $pdo->query("SELECT COUNT(*) FROM produit")->fetchColumn();
    $cmdCount   = $pdo->query("SELECT COUNT(*) FROM commande")->fetchColumn();
    $cmdAttente = $pdo->query("SELECT COUNT(*) FROM commande WHERE valide = 0")->fetchColumn();

    $ca = $pdo->query("SELECT SUM(total) FROM commande WHERE valide = 1")->fetchColumn() ?: 0;
    ?>

    <div class="container py-4">
        <h2 class="mb-4 text-center fw-bold">Tableau de Bord</h2>

        <div class="row">
            <!-- Carte Produits -->
            <div class="col-md-3">
                <div class="card-counter primary">
                    <i class="fa fa-box"></i>
                    <span class="count-numbers"><?= $prodsCount ?></span>
                    <span class="count-name">Produits</span>
                </div>
            </div>


            <!-- Carte Commandes -->
            <div class="col-md-3">
                <div class="card-counter danger">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="count-numbers"><?= $cmdCount ?></span>
                    <span class="count-name">Commandes</span>
                </div>
            </div>

            <!-- Carte Commandes à valider-->
            <div class="col-md-3">
                <div class="card-counter warning">
                    <i class="fa fa-hourglass-half"></i>
                    <span class="count-numbers"><?= $cmdAttente ?></span>
                    <span class="count-name">Commandes à valider</span>
                </div>
            </div>

            <!-- Carte Chiffre d'Affaires -->
            <div class="col-md-3">
                <div class="card-counter success">
                    <i class="fa fa-money-bill"></i>
                    <span class="count-numbers"><?= number_format($ca, 0, ',', ' ') ?> DH</span>
                    <span class="count-name">Chiffre d'affaires (Validé)</span>
                </div>
            </div>
        </div>

        <!-- Actions Rapides -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fa fa-bolt text-warning"></i> Actions Rapides</h5>
                    </div>
                    <div class="card-body">
                        <a href="ajouter_produit.php" class="btn btn-outline-primary m-1"><i class="fa fa-plus"></i> Nouveau Produit</a>
                        <a href="ajouter_categorie.php" class="btn btn-outline-secondary m-1"><i class="fa fa-tags"></i> Nouvelle Catégorie</a>
                        <a href="commandes.php" class="btn btn-outline-success m-1"><i class="fa fa-list"></i> Gérer les Commandes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>