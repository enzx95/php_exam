<?php
require('config.php');
require ('navigation.html');
session_start();
if ($_SESSION['admin'] == true) {
} else {
    header("Location: index.php");
    exit();
}
?>
<?php
if (isset($_POST['id'])) {
    $answer = $_POST['radio'];
    //echo $answer;
    $ID = stripslashes($_REQUEST['id']);
    $ID = mysqli_real_escape_string($conn, $ID);
    if ($answer == null) {
        $message = "Veuillez choisir une option.";
        //echo"invalid";
    } else {
        //echo $answer;
        //echo $ID;
        if ($ID == null) {
            $message = "Veuillez fournir un ID.";
        } else {
            if ($answer != "users" and $answer != "articles") {
                $message = "Option invalide.";
            } else {
                $query = "SELECT * FROM $answer WHERE ID='$ID'";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
                $rows = mysqli_num_rows($result);
                if ($rows == 1) {
                    $query = "DELETE FROM $answer WHERE ID='$ID'";
                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
                    if ($result) {
                        switch ($answer) {
                            case "users":
                                $message = "Utilisateur supprimé avec succès.";
                                break;

                            case "articles":
                                $message = "Article supprimé avec succès.";
                                break;
                        }
                    }
                } else {
                    $message = "L'ID spécifié est introuvable.";
                }
            }
        }
    }
}
?>
<form class="box" action="" method="post" name="login">
    <p> Voulez-vous supprimer un article ou un utilisateur?</p>

    <input type='radio' name='radio' value='articles' />Article</br>
    <input type='radio' name='radio' value='users' />Utilisateur</br>
    <br>
    <input type="text" class="box-input" name="id" placeholder="ID">
    <input type="submit" value="Supprimer" name="submit" class="box-button">
    <?php if (!empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
</form>
<br>
<table>
    <tr>
        <th>Utilisateurs</th>
        <th>ID</th>
    </tr>
    <?php
    // SQL query
    $strSQL = "SELECT * FROM users";

    // Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($conn, $strSQL);

    // Loop the recordset $rs
    // Each row will be made into an array ($row) using mysqli_fetch_array
    while ($row = mysqli_fetch_array($rs)) {

        echo "<tr>
				<td>" . $row['username'] . "</td>
                <td>" . $row['ID'] . "</td>
			</tr>";
    }
    ?>
</table>
<br>

<table>
    <tr>
        <th>Titre</th>
        <th>ID</th>
    </tr>
    <?php
    // SQL query
    $strSQL = "SELECT * FROM articles ";

    // Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($conn, $strSQL);

    // Loop the recordset $rs
    // Each row will be made into an array ($row) using mysqli_fetch_array
    while ($row = mysqli_fetch_array($rs)) {
        echo "<tr>
				<td>" . $row['title'] . "</td>
				<td>" . $row['ID'] . "</td>
			</tr>";
    }
    ?>
</table>
<br>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>