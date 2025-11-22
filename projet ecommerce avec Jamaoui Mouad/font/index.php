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
</head>
<body>
    <?php include "nav_front.php" ?>
    <div class="container-fluid p-3">
        <h4 class="h4 text-center"><i class="fa-solid fa-list"></i> Liste des catégories</h4>
        
        <div class="container w-18">
            <ul class="list-group list-group-flush">
                <?php foreach($categories as $categorie): ?>
                    <li class="list-group-item">
                        <a class="btn btn-light" href="categorie.php?id=<?= $categorie['id']  ?>"><i class="<?= $categorie['icone']?> m-2"></i>  <?= $categorie['libelle']?></a>
                    </li>
                <?php endforeach;?>    
            </ul>
        </div>
       
    </div>
    
</body>
</html>

