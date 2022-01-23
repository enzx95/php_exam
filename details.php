<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="details.css" />
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
        exit();
    }
    require('config.php');
    require ('navigation.html');
    if (is_string($_GET['ID']) && preg_match('#^[0-9]+$#', $_GET['ID'])) {
        //echo 'Bonjour ' . htmlspecialchars($_GET["ID"]) . '!';
        $ID = htmlspecialchars($_GET["ID"]);
        $query = "SELECT * FROM Articles INNER JOIN users ON Articles.author = Users.ID WHERE Articles.ID = '$ID'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            while ($row = mysqli_fetch_array($result)) {
                // Write the value of the column FirstName (which is now in the array $row)
                echo "<div class=\"title\">" . $row['title'] . "</div>";
                echo "<div class=\"article\">" . $row['description'] . "</div>";
                echo "<div class=\"intro\">" . $row['date'] . "</div>";
                echo "<div class=\"article\">" . $row['username'] . "</div>";
                    //echo $row['ID'];
                    if($row['ID'] == $_SESSION["ID"]){
                        echo "<br><a href=\"edit.php?ID=$ID\">Modifier</a>
                        <br>";
                    }
                    
            }
        } else {
            echo "L'ID est incorrect.";
        }
    } else
        // entry is incorrect
        echo "Format incorrect.";
    ?>

    <br>

</html>