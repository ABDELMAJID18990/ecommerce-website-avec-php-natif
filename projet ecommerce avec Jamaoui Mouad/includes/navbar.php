<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$connecte = false;
if (isset($_SESSION['utilisateur'])) {
  $connecte =  true;
}

$currentPage = $_SERVER['PHP_SELF'];

?>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ShopEcommerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php if ($currentPage == '/index.php') echo 'active' ?>" aria-current="page" href="index.php">
            <i class="fa-solid fa-user-plus"></i> S 'inscrire</a>
        </li>
        <?php if ($connecte): ?>
          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == '/admin.php') echo 'active' ?>" aria-current="page" href="admin.php">
              <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == '/categories.php') echo 'active' ?> " aria-current="page" href="categories.php">
              <i class="fa-brands fa-dropbox"></i> Liste catégories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == '/produits.php') echo 'active' ?>" aria-current="page" href="produits.php">
              <i class="fa-solid fa-tag"></i> Liste produits</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == '/commandes.php' || $currentPage == '/commande.php') echo 'active' ?>" aria-current="page" href="commandes.php">
              <i class="fa-solid fa-barcode"></i> Commandes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="deconnexion.php">
              <i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == '/connexion.php') echo 'active' ?>" href="connexion.php">
              <i class="fa-solid fa-arrow-right-to-bracket"></i> Connexion</a>
          </li>
        <?php endif; ?>



      </ul>
    </div>
    <a class="btn btn-outline-dark ms-auto" href="../font/index.php"><i class="fa-solid fa-cart-shopping"></i> Site front</a>
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