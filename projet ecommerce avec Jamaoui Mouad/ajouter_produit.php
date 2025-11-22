<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ajouter Produit</title>
</head>
<body>
<div class="container-fluid">
<?php
include "includes/navbar.php";
require_once "includes/database.php";

if(empty($_SESSION['utilisateur'])){
    header('Location: connexion.php');
    exit();
}

$stmt = $pdo->query("SELECT id, libelle FROM categorie");


$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);


?> 
<div class="container">
    <h4 class="h4 text-center mt-3">Ajouter Produit</h4>

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
    <label class="form-label">Libellé</label>
    <input type="text" class="form-control" name="libelle">
    </div> 

    <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea class="form-control" placeholder="Laissez une description ici" name="description"></textarea>
    </div> 

    <div class="mb-3">
    <label for="Input" class="form-label">Prix</label>
    <input type="number" class="form-control" id="Input" name="prix" min="0" step="0.5">
    </div> 

    <div class="mb-3">
    <label class="form-label">Discount</label>
    <input type="number" class="form-control" name="discount" value="0" min="0" max="90" step="0.5">
    </div>
    
    <div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file" class="form-control" name="image" accept="image/*" >
    </div>

    <div class="mb-3">

    <label for="Input" class="form-label">Catégorie</label>
    <select class="form-select" name="categorie" aria-label="Floating label select example">
    <option selected>--Choissez une catégorie--</option>
    <?php foreach($categories as $categorie): ?>
    <option value="<?= $categorie['id'] ?>"><?= $categorie['libelle'] ?></option>
    <?php endforeach;?>
    </select>
  
    </div>

    <button type="submit" class="btn btn-primary">Ajouter produit</button>
    
  
  
  
  


</form>
<?php
if($_SERVER['REQUEST_METHOD']==="POST"){

    $libelle = $_POST['libelle'];
    $description= $_POST['description'];
    $prix = $_POST['prix'];
    $discount= $_POST['discount'];
    $image= $_FILES['image'];
    $categorie = $_POST['categorie'];
    $dateC = date(format:"Y-m-d");

    
      
    

    if(!empty($libelle) && !empty($prix) && !empty($categorie) && !empty($description) && !empty($image)){

      require_once "includes/database.php";

        $imageName = $image['name'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];

        $ext = explode('.', $imageName);
        $extension = strtolower(end($ext));
        $imageNewName = uniqid().'.'.$extension;
        $imageDestination = "uploads/produits/".$imageNewName;

        move_uploaded_file($imageTmpName, $imageDestination);
      

      $date =new DateTime();
      $dateP = $date->format("Y-m-d H:i:s");
      
      $stmt = $pdo->prepare("INSERT INTO produit VALUES(null, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([ $libelle, $prix, $discount, $categorie, $dateP, $description, $imageDestination]);

      //redirection
      
      ?>
      <div class="alert alert-success mt-2" role="alert">
            Le produit <?= $libelle ?> a été ajouté avec succes!
        </div>

        <?php
        header("Location: produits.php");
        exit();
    }else{?>
        <div class="alert alert-danger mt-2" role="alert">
            libelle, prix, description, image et catégorie sont obligatoires!
        </div>
        <?php }}?>
</div>

   


</div>
    
</body>
</html>

