<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Liste des Commandes</title>
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

$stmt = $pdo->query("SELECT commande.*, utilisateur.login FROM commande INNER JOIN utilisateur ON commande.id_client = utilisateur.id ORDER BY commande.date_creation");
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?> 
    <div class="container py-2">
   <h2 class="text-center">Liste des commandes</h2> 
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Client</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
                <th scope="col">Opérations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($commandes as $commande): ?>
                <tr>
                    <th scope="row"><?=$commande["id"]?></th>
                    <td><?=$commande["login"]?></td>
                    <td><?=$commande["total"]?> MAD</td>
                    <td><?=$commande["date_creation"]?></td>
                    <td>
                        <a href="commande.php?id=<?= $commande["id"] ?>" class="btn btn-primary btn-sm">َAfficher détails</a>
                    </td>
                </tr>
            <?php endforeach; ?>    

        </tbody>
    </table>

    </div>
</div>  
</body>
</html>

