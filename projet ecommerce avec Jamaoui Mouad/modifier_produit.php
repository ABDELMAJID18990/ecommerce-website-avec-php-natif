<?php
require_once "includes/database.php";

$id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM produit WHERE id=?");
$stmt->execute([$id]);
$prd = $stmt->fetch();


$stmt = $pdo->query("SELECT id, libelle FROM categorie");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);



if($_SERVER['REQUEST_METHOD']==="POST"){
    $libelle = $_POST['libelle'];
    $description= $_POST['description'];
    $prix = $_POST['prix'];
    $discount= $_POST['discount'];
    $image= $_FILES['imagePrd'];
    $newCategorie = $_POST['categorie'];

    
    
    if(!empty($libelle) && !empty($prix) && !empty($newCategorie) && !empty($description)){
        
        if(!empty($image['tmp_name'])){
                  
            $imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $imageError = $image['error'];

             if($imageError === 0) {

                $ext = explode('.', $imageName);
                $extension = strtolower(end($ext));
                $imageNewName = uniqid().'.'.$extension;
                $imageDestination = "uploads/produits/".$imageNewName;

                // Supprimer l'ancienne image si elle existe
                if(!empty($prd['image']) && file_exists($prd['image'])) {
                    unlink($prd['image']);
                }
                if(move_uploaded_file($imageTmpName, $imageDestination)) {

                $stmt1 = $pdo->prepare("UPDATE produit SET image=? WHERE id=?");
                $stmt1->execute([$imageDestination, $id]);

            } else {
                echo '<div class="alert alert-danger">Erreur lors du téléchargement de l\'image</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Type de fichier non autorisé</div>';
            }

                

                
                    
             }
           
        

      
      
      $stmt = $pdo->prepare("UPDATE produit SET libelle=?, prix=?, discount=?, id_categorie=?, description=? WHERE id=?");
      $stmt->execute([ $libelle, $prix, $discount, $newCategorie, $description, $id]);

      
      ?>
      <div class="alert alert-success mt-2" role="alert">
            Produit mise à jour avec succès !
        </div>

        <?php
        //redirection
        header("Location:produits.php");
        exit();
    }else{?>
        <div class="alert alert-danger mt-2" role="alert">
            libellé, prix, description et catégorie sont obligatoires!
        </div>
        <?php }}?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Modifier Produit</title>
</head>
<body>
<div class="container-fluid">
<?php
include "includes/navbar.php";
if(empty($_SESSION['utilisateur'])){
    header('Location: connexion.php');
    exit();
}
?> 
<div class="container">
    <h4 class="h4 text-center mt-3">Modifier Produit</h4>
    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
    <label class="form-label">Libellé</label>
    <input type="text" class="form-control"name="libelle" value="<?= $prd['libelle'] ?>">
    </div> 

    <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea class="form-control" placeholder="Laissez une description ici" name="description"><?= $prd['description'] ?></textarea>
    </div>  
    
    <div class="mb-3">
    <label  class="form-label">Prix</label>
    <input type="number" class="form-control" name="prix" min="0" step="0.5" value="<?= $prd['prix'] ?>">
    </div> 

    <div class="mb-3">
    <label  class="form-label">Discount</label>
    <input type="number" class="form-control"name="discount" min="0" max="90" step="0.5" value="<?= $prd['discount'] ?>">
    </div> 

    <div class="mb-3">
    <label class="form-label">Image</label>
    <?php $imgPrd = !empty($prd['image']) ? htmlspecialchars($prd['image'])  : "https://www.feed-image-editor.com/sites/default/files/perm/wysiwyg/image_not_available.png" ;?>
    
        <img src="<?= $imgPrd ?>" class="img img-thumbnail img-fluid rounded" alt="Image actuelle" 
        style="max-height: 150px; display: block; margin-bottom: 10px;">
    

    <input type="file" class="form-control" name="imagePrd"  accept="image/*" >
    </div>

    <div class="mb-3">
    <label class="form-label">Catégorie</label>
    <select class="form-select" name="categorie" aria-label="Floating label select example">
    <option selected>--Choissez une catégorie--</option>
    <?php foreach($categories as $categorie): ?>

        <?php $selected = $categorie['id'] == $prd['id_categorie']?'selected':'' ?>
    
        <option value="<?= $categorie['id'] ?>" <?=$selected?>><?= $categorie['libelle'] ?></option>
    
    <?php endforeach;?>
    </select>
  
    </div>
    <button type="submit" class="btn btn-primary">Modifier produit</button>
    
  
</form>
</div>
</div>
    
</body>
</html>
<?php


