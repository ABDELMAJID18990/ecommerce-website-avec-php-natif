<?php 
session_start();
require_once "includes/database.php";

if(empty($_SESSION['utilisateur'])){
    header('Location: connexion.php');
    exit();
}

$idCommande = $_GET['id'];


$stmt = $pdo->prepare("SELECT commande.*, utilisateur.login FROM commande 
                        INNER JOIN utilisateur ON commande.id_client = utilisateur.id 
                        WHERE commande.id = ?
                        ORDER BY commande.date_creation");
$stmt->execute([$idCommande]);
$commande = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Commande | Numéro <?=$commande["id"]?> </title>
</head>
<body>
<div class="container-fluid">
<?php include "includes/navbar.php";?> 
    <div class="container py-2">
   <h2 class="text-center">Détails de la commande</h2> 
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
                <tr>
                    <th scope="row"><?=$commande["id"]?></th>
                    <td><?=$commande["login"]?></td>
                    <td><?=$commande["total"]?> MAD</td>
                    <td><?=$commande["date_creation"]?></td>
                    
                    <td>
                        <?php if($commande["valide"] == 0): ?>
                        <a href="valider_commande.php?id=<?= $commande["id"] ?>&etat=1" class="btn btn-success">Valider la commande</a>   
                        <?php else: ?>
                        <a href="valider_commande.php?id=<?= $commande["id"] ?>&etat=0" class="btn btn-danger">Annuler la commande</a> 
                        <?php endif; ?>
                    </td>
                </tr>
        </tbody>
    </table>

     <?php 
                $sql = 'SELECT ligne_commande.*, produit.libelle, produit.image FROM ligne_commande
                INNER JOIN produit ON ligne_commande.id_produit = produit.id
                WHERE id_commande = ?';
                $sqlState = $pdo->prepare($sql);
                $sqlState->execute([$idCommande]);

                $lignesCommande = $sqlState->fetchAll(PDO::FETCH_ASSOC);

            ?>

    <h2 class="text-center">Produits</h2> 
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Produit</th>
                <th scope="col">Prix unitaire</th>
                <th scope="col">Quantité</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lignesCommande as $commande): ?>
             <tr>
                    <th scope="row"><?=$commande["id"]?></th>
                    <td><?=$commande["libelle"]?></td>
                    <td><?=$commande["prix"]?> MAD</td>
                    <td>X <?=$commande["quantite"]?></td>
                    <td><?=$commande["total"]?> MAD</td>
                    <td>
                        
                        
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>

    </div>
</div>  
</body>
</html>

