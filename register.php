<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <?php
  session_start();
  require('config.php');
  if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
  }
  if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])) {
    // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    //requéte SQL + mot de passe crypté
    $select = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $_POST['username'] . "'");
    if (mysqli_num_rows($select)) {
      exit('This username already exists');
    }
    $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $_POST['email'] . "'");
    if (mysqli_num_rows($select)) {
      exit('This email is already used');
    }

    $query = "INSERT into `users` (username, email, password)
              VALUES ('$username', '$email', '" . hash('sha256', $password) . "')";
    // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if ($res) {
      echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
    }
  } else {
  ?>
    <form class="box" action="" method="post">
      <h1 class="box-title">S'inscrire</h1>
      <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
      <input type="text" class="box-input" name="email" placeholder="Email" required />
      <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
      <input type="submit" name="submit" value="S'inscrire" class="box-button" />
      <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
    </form>
  <?php } ?>
</body>

</html>