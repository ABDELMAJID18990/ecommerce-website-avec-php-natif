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
    <a class="navbar-brand" href="#">ShopEcommerce</a>
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

<style>
  /* Dans assets/css/style.css */
  .navbar {
    background-color: #ffffff !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    /* Ombre très légère */
    padding-top: 15px;
    padding-bottom: 15px;
  }

  .navbar-brand {
    font-weight: 800;
    letter-spacing: -0.5px;
    color: #1a1a1a !important;
  }

  .nav-link {
    font-weight: 500;
    color: #555 !important;
  }

  .nav-link:hover,
  .nav-link.active {
    color: #0d6efd !important;
    /* Bleu primaire au survol */
  }
</style>