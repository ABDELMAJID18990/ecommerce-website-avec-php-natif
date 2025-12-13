<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $icone = $_POST['icone'];
    $dateC = date(format: "Y-m-d");

    if (!empty($libelle) && !empty($description) && !empty($icone)) {

        require_once "includes/database.php";



        $stmt = $pdo->prepare("INSERT INTO categorie VALUES(null, ?,?,?, ?)");
        $stmt->execute([$libelle, $description, $icone, $dateC]);


?>
        <div class="alert alert-success mt-2" role="alert">
            La catégorie <?= $libelle ?> a été ajouté avec succes!
        </div>

    <?php
        //redirection
        header("Location: categories.php");
        exit();
    } else { ?>
        <div class="alert alert-danger mt-2" role="alert">
            libellé et description et icône sont obligatoires!
        </div>
<?php }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Liste des catégories</title>
    <title>Ajouter Catégorie</title>
</head>

<body>
    <div class="container-fluid">
        <?php
        include "includes/navbar.php";
        if (empty($_SESSION['utilisateur'])) {
            header('Location: connexion.php');
            exit();
        }

        ?>
        <div class="container">
            <form action="" method="post">

                <h4 class="h4 text-center mt-3">Ajouter Catégorie</h4>

                <div class="mb-3">
                    <label for="Input" class="form-label">Libellé</label>
                    <input type="text" class="form-control" id="Input" name="libelle">
                </div>

                <div class="mb-3">

                    <label class="form-label">Description</label>
                    <textarea class="form-control" placeholder="Laissez une description ici" name="description"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Icône (Seulement la valeur de class depuis <span class="fw-bolder">Font Awesome</span> <i class="fa-solid fa-font-awesome"></i>)</label>
                    <input type="text" class="form-control" name="icone">
                </div>

                <button type="submit" class="btn btn-primary">Ajouter catégorie</button>







            </form>

        </div>




    </div>

</body>

</html>