<?php 
session_start();
require_once "../includes/database.php"; 

$idUtilisateur = $_SESSION['utilisateur']['id'] ?? 0;


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vider'])){

     $_SESSION['panier'][$idUtilisateur] = [];
     header('Location: panier.php');
     exit();
  }
                               ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link  rel="stylesheet" href="..\assets\css\produit.css">
    <title>Panier</title>
</head>
<body>
    <?php include "nav_front.php" ?>
    <div class="container-fluid py-2">
        
        <h4 class="h4 text-center mb-4">Panier</h4>
        <div class="container">
            <div class="row">
                <?php 
                $panier = $_SESSION['panier'][$idUtilisateur] ?? [];
                $inserted = false;
                 ?>
                 <?php if(isset($_GET['success']) && $_GET['success'] == 1): ?>
                        <div class="alert alert-success mt-2" role="alert">
                            Commande confirmée ! Montant : <?= number_format($_GET['total'], 2, ',', ' ') ?> MAD
                        </div>
                <?php endif; ?>
                <?php if(empty($panier)):?>
                    <div class="alert alert-warning pt-4" role="alert">
                        <p class="fw-bolder">Votre panier est vide.</p> 
                    </div>
                <?php else:?>
                    <?php 

                        $idProduits = array_keys($panier);
                        $idProduits = implode(',', $idProduits); 
                        $produits = $pdo->query("SELECT * FROM produit WHERE id IN ($idProduits)")->fetchAll(PDO::FETCH_ASSOC);

                        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider'])){
                            
                            $sql = 'INSERT INTO ligne_commande(id_produit,id_commande, prix, quantite, total) VALUES'; 
                          
                            $total = 0;
                            $infosProduits = [];
                            foreach($produits as $produit){
                                $idProduit = $produit['id'];
                                $qte = $panier[$idProduit];
                                $prix = $produit['prix'];
                                $total += $qte*$prix;

                                $infosProduits[$idProduit] = [
                                    'id' => $idProduit,
                                    'prix' => $prix,
                                    'qte' => $qte,
                                    'total' => $qte * $prix
                                ];
                            }
                            $sqlStateCommande = $pdo->prepare("INSERT INTO commande(id_client, total) VALUES(?, ?)");
                            $sqlStateCommande->execute([$idUtilisateur, $total]);
                            $idCommande = $pdo->lastInsertId();

                            foreach($infosProduits as $produit){
                                $id = $produit['id'];                                 
                                $sql .= "(:id$id, '$idCommande', :prix$id, :qte$id, :total$id),";
                            }
                            $sql = substr($sql, 0, -1);
                            $sqlState = $pdo->prepare($sql);

                            foreach($infosProduits as $produit){
                                $id = $produit['id'];                                 
                                $sqlState->bindParam(':id'.$id, $produit['id']) ;
                                $sqlState->bindParam(':prix'.$id, $produit['prix']) ;
                                $sqlState->bindParam(':qte'.$id, $produit['qte']) ;
                                $sqlState->bindParam(':total'.$id, $produit['total']) ;
                            }
                            $inserted = $sqlState->execute();
                            if ($inserted) {
                                $_SESSION['panier'][$idUtilisateur] = [];
                                header('Location: panier.php?success=1&total=' . $total);
                                exit();
                            }
                            } ?>
                            

                    <h1 class="text-center">Liste des produits</h1>
        
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>                                
                                <th scope="col">Libellé</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php $total = 0 ?> 
                    <?php foreach($produits as $prd): ?> 
                        
                        <?php
                            $idProduit = $prd['id'];
                            $totalProduit = $prd['prix'] * $panier[$idProduit];
                            $total += $totalProduit;
                            ?>

                         <tr>
                            <td><?php echo $prd['id']; ?></td>
                            <td>
                                <?php $imgPrd = !empty($prd['image']) ? '../'.$prd['image']  : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsXKkvbpiawZitYkuujSsTqF6eDWQm6oU4kw&s" ;?>
                                <img src="<?= $imgPrd ?>"class="card-img-top img-fluid rounded pt-1 w-75" alt="<?= $prd['libelle'] ?>">
                            </td>
                            <td><?php echo $prd['libelle']; ?></td>
                            <td>
                                <?php  include "../includes/front/counter.php"  ?>
                            </td>
                            <td><?= $prd['prix']?>  MAD</td>
                            <td><?= $totalProduit ?>  MAD </td>
                        </tr>
                        
                    <?php endforeach; ?> 

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" align="right" ><strong>Total</strong></td>
                            <td><?= $total ?> MAD</td>    
                        </tr>
                        <tr>
                            <td colspan="6" align="right" >
                                <form method="post">
                                    <input type="submit" class="btn btn-success" name="valider" value="Valider la commande">
                                    <input type="submit" onclick="return confirm('Voulez vous vraiment vider le panier ?')" class="btn btn-danger" name="vider" value="Vider le panier">
                                </form>
                            </td>     
                        </tr>
                    </tfoot>
                </table>
                <?php endif;?>    
            </div>   
        </div>
    </div>

<script src="..\assets\js\produit\counter.js"></script>   
</body>
</html>

