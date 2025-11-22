<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$connecte = false; 
if( isset($_SESSION['utilisateur'])){
    $connecte =  true;
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Ecommerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Liste des catégories</a>
        </li>  

      </ul>
      
    </div>
    <?php
    $productCount = 0;
        if (isset($_SESSION['utilisateur'])) {
            $idUtilisateur = $_SESSION['utilisateur']['id'];
            $productCount = count($_SESSION['panier'][$idUtilisateur] ?? []);
        }?>

    <a href="panier.php" class="btn float-end btn-outline-primary position-relative ms-3">
        <i class="fa-solid fa-cart-shopping"></i>Panier <span class="badge bg-danger"><?= $productCount//PRODUCTS_COUNT ?></span>
      </a>
  </div>
</nav>