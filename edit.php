<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="new.css" />
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

    $author = $_SESSION["ID"];
    //echo $author;
    //echo $_SESSION["username"];
    if (!empty($_POST['nvTitre'])) {
       // echo "salit";
        $nvTitre = stripslashes($_REQUEST['nvTitre']);
        $nvTitre = mysqli_real_escape_string($conn, $nvTitre);
        $query = "UPDATE `articles` SET  title='$nvTitre' where author='$author'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $message = "<b>Titre modifié avec succès.</b><br>";
        //echo "submit";
    } elseif (!empty($_POST['article'])) {
        
        //echo "mail";
        $article = stripslashes($_REQUEST['article']);
        $article = mysqli_real_escape_string($conn, $article);
        $query = "UPDATE `articles` SET  description='$article' where author='$author'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $message2 = "<b>Article modifié avec succès.</b><br>";
    }


    if (is_string($_GET['ID']) && preg_match('#^[0-9]+$#', $_GET['ID'])) {
        //echo 'Bonjour ' . htmlspecialchars($_GET["ID"]) . '!';
        $ID = htmlspecialchars($_GET["ID"]);
        $query = "SELECT * FROM Articles INNER JOIN users ON Articles.author = Users.ID WHERE Articles.ID = '$ID'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            while ($row = mysqli_fetch_array($result)) {

                if ($row['username'] != $_SESSION["username"]) {
                    echo "Vous ne pouvez pas faire cela.";
                } else {
    ?>
                    
    <?php
                    echo "<b>Titre : </b>" . $row['title'] . "<br />";
                    echo "<b>Article : </b>" . $row['description'] . "<br {/>";
                }
            }
        } else {
            echo "L'ID est incorrect.";
        }
    } else
        echo "Format incorrect.";
    ?>

    <br>

    <div class="container-contact100">

		<div class="wrap-contact100">
            <form class="box" action="" method="post" name="modif">
				<span class="contact100-form-title">
					Modifier votre article
				</span>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" class="box-input" name="nvTitre" placeholder="Nouveau titre">
                    <div class="container-contact100-form-btn">
					    <button class="contact100-form-btn">
						    <span>
						    <i class="fa fa-paper-plane-o m-r-6" aria-hidden="true" type="submit" name="submit" value="modifier"></i>
							Modifier
						    </span>
					    </button>
				    </div>
                    <?php if (!empty($message)) { ?>
                        <p class="errorMessage"><?php echo $message; ?></p>
                    <?php } ?>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" >
					<textarea class="input100" name="article" placeholder="Modifier votre texte"></textarea>
                    <div class="container-contact100-form-btn">
					    <button class="contact100-form-btn">
						    <span>
						    <i class="fa fa-paper-plane-o m-r-6" aria-hidden="true" type="submit" value="Modifier " name="submit"></i>
							Modifier
						    </span>
					    </button>
				    </div>
                    <?php if (!empty($message2)) { ?>
                        <p class="errorMessage"><?php echo $message2; ?></p>
                    <?php } ?>
					<span class="focus-input100"></span>
				</div>

			</form>
		</div>
	</div>



	

</body>

</html>