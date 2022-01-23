<!DOCTYPE html>
<html>


<body>
    <?php
    require('config.php');
    require ('navigation.html');
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
        exit();
    }
    $username = $_SESSION["username"];
    if (isset($_POST['password'])) {

        $newPassword = stripslashes($_REQUEST['newPassword']);
        $newPassword = mysqli_real_escape_string($conn, $newPassword);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $query = "SELECT * FROM `users` WHERE username='$username' and password='" . hash('sha256', $password) . "'";
        //$query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $query = "UPDATE `users` SET  password='" . hash('sha256', $newPassword) . "' where username='$username'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
            $message = "<b>Mot de passe modifié avec succès.</b><br>";
        } else {
            $message = "Le mot de passe est incorrect.";
        }
        //echo "submit";
    } elseif (isset($_POST['email'])) {
        // echo "mail";
        $newEmail = stripslashes($_REQUEST['email']);
        $newEmail = mysqli_real_escape_string($conn, $newEmail);
        $query = "SELECT * FROM `users` WHERE email='$newEmail'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $rows = mysqli_num_rows($result);
        if ($rows == 0) {
            $query = "UPDATE `users` SET  email='$newEmail' where username='$username'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
            $message2 = "<b>Email modifié avec succès.</b><br>";
            //header("Refresh:0");

            //echo"email dispo";
        } else {
            $message2 = "Cet email est déja utilisé.";
        }
    }
    ?>
    <h1 class="box-title">Compte</h1>
    <?php
    // SQL query
    $strSQL = "SELECT username, email, admin FROM users WHERE username = '" . $_SESSION['username'] . "'";

    // Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($conn, $strSQL);

    // Loop the recordset $rs
    // Each row will be made into an array ($row) using mysqli_fetch_array
    while ($row = mysqli_fetch_array($rs)) {

        // Write the value of the column FirstName (which is now in the array $row)
        echo "<b>Nom d'utilisateur : </b>" . $row['username'] . "<br />";
        echo "<b>Email : </b>" . $row['email'] . "<br {/>";
        if ($row['admin'] == 1) {
            echo "<b>Administrateur</b>" . "<br {/>";
        } else {
            echo "<b>Membre</b>" . "<br {/>";
        }
    }

    ?>
    <form class="box" action="" method="post" name="login">

        <p>Modifier votre mot de passe</p>
        <input type="password" class="box-input" name="password" placeholder="Ancien mot de passe">
        <input type="password" class="box-input" name="newPassword" placeholder="Nouveau mot de passe">
        <input type="submit" value="Modifier " name="submit" class="box-button">
        <?php if (!empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
    </form>

    <form class="box" action="" method="post" name="email">

        <p>Modifier votre email</p>
        <input type="text" class="box-input" name="email" placeholder="Nouvel email">
        <input type="submit" value="Modifier " name="submit" class="box-button">
        <?php if (!empty($message2)) { ?>
            <p class="errorMessage"><?php echo $message2; ?></p>
        <?php } ?>
    </form>
    <br>
    <h1 class="box-title">Vos articles</h1>
    <table>
        <tr>
            <th>Titre</th>
            <th>Article</th>
        </tr>
        <?php
        // SQL query
        $strSQL = " SELECT title, description  FROM articles INNER JOIN users WHERE articles.author = users.ID AND users.username='$username'";

        // Execute the query (the recordset $rs contains the result)
        $rs = mysqli_query($conn, $strSQL);

        // Loop the recordset $rs
        // Each row will be made into an array ($row) using mysqli_fetch_array
        while ($row = mysqli_fetch_array($rs)) {

            // Write the value of the column FirstName (which is now in the array $row)
            // echo "<h3>" . $row['title'] . "</h3></b>";
            // echo "<h4>" . $row['description'] . "</h4></b>";
            echo "<tr>
				<td>" . $row['title'] . "</td>
				<td>" . $row['description'] . "</td>
			</tr>";
        }
        ?>
    </table>
    <br>

</body>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

</html>