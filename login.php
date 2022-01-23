<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="login.css" />
</head>

<body>
    <?php
    require('config.php');
    session_start();
    if (isset($_SESSION["username"])) {
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $query = "SELECT * FROM users WHERE username='$username' and password='" . hash('sha256', $password) . "'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $rows=mysqli_fetch_array($result);
            $_SESSION['ID'] =  $rows[0];
            header("Location: index.php");
        } else {
           $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
    }
    ?>
    <form class="box" action="" method="post" name="login">
        <h1 class="box-title">Connexion</h1>
        <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
        <input type="password" class="box-input" name="password" placeholder="Mot de passe">
        <input type="submit" value="Connexion " name="submit" class="box-button">
        <p class="box-register">Vous Ãªtes nouveau ici? <a href="register.php">S'inscrire</a></p>
        <?php if (!empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>


<!--   Mise en place balise Form + Action  -->
    <form class="box" action="index.html" methode="post">
<!--   Mise en place du SVG "user"     -->
      <svg width="30" height="30" viewBox="0 0 24 24">
  <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"></path>
</svg>





    </form>
</body>

</html>