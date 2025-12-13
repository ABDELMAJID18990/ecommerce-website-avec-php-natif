<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Document</title>
</head>

<body>
  <div class="container-fluid">
    <?php
    include "includes/navbar.php";
    ?>
    <div class="container">
      <form action="" method="post">
        <div class="mb-3">
          <h4 class="h4 text-center mt-2">Connexion</h4>
          <label for="InputEmail" class="form-label">Login</label>
          <input type="email" class="form-control" id="InputEmail" name="login" required>

        </div>
        <div class="mb-3">
          <label for="InputPassword" class="form-label">Password</label>
          <input type="password" class="form-control" id="InputPassword" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Connexion</button>


      </form>
      <?php
      if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (!empty($login) && !empty($password)) {

          require_once "includes/database.php";



          $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login = ?");
          $stmt->execute([$login]);

          if ($stmt->rowCount() > 0) {

            $utilisateur = $stmt->fetch();

            // On vérifie le mot de passe crypté
            if (password_verify($password, $utilisateur['password'])) {

              $_SESSION['utilisateur'] = $utilisateur;
              header('Location: admin.php');
              exit();
            } else {
              // Mot de passe incorrect
              echo '<div class="alert alert-danger">Login ou mot de passe incorrect !</div>';
            }
          } else {
            // Utilisateur non trouvé
            echo '<div class="alert alert-danger">Login ou mot de passe incorrect !</div>';
          }
        }
      }


      ?>
    </div>




  </div>

</body>

</html>