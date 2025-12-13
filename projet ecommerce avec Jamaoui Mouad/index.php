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
          <h4 class="h4 text-center mt-2">S'inscrire</h4>
          <label for="InputEmail" class="form-label">Login</label>
          <input type="email" class="form-control" id="InputEmail" name="login" required>
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="InputPassword" class="form-label">Password</label>
          <input type="password" class="form-control" id="InputPassword" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>


      </form>

    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $login = $_POST['login'];
      $password = $_POST['password'];
      $dateC = date("Y-m-d");

      if (!empty($login) && !empty($password)) {

        require_once "includes/database.php";

        // ÉTAPE 1 : Vérifier si le login existe déjà
        $check = $pdo->prepare("SELECT id FROM utilisateur WHERE login = ?");
        $check->execute([$login]);

        if ($check->rowCount() > 0) {
    ?>
          <div class="alert alert-warning mt-2" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i> Ce login est déjà utilisé. Veuillez en choisir un autre ou vous connecter.
          </div>

        <?php
        } else {
          // ÉTAPE 2 : Si le login est libre, on inscrit

          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

          $stmt = $pdo->prepare("INSERT INTO utilisateur (login, password, date_creation) VALUES (?, ?, ?)");
          $stmt->execute([$login, $hashedPassword, $dateC]);

          header('Location: connexion.php');
          exit();
        }
      } else {
        ?>
        <div class="alert alert-danger mt-2" role="alert">
          Login et mot de passe sont obligatoires !
        </div>
    <?php
      }
    }
    ?>

  </div>

</body>

</html>