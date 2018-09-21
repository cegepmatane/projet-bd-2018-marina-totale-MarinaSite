<?php include 'header.php';
session_start();
$PSEUDO = null;
$PASS = 0;
$MDP = null;
if ((isset($_POST['mot_de_passe']))){
    $MDP = $_POST['mot_de_passe'];
}
if ((isset($_POST['pseudo']))){
    $PSEUDO = $_POST['pseudo'];
}
?>

<div class="formulaireClient">
    <fieldset>
        <legend>Connexion à MarinaConnect</legend>

        <form action="index.php" method="post">
            <p> <label>Mail: </label>
                <input type="email" name="pseudo" />
                <label>Mot de passe: </label>
                <input type="password" name="mot_de_passe" />
                <input type="submit" name="send" value="CONNECTION">
            </p>
        </form>
        <a href="ajouterUtilisateur.php">Creer un compte</a>
</div>

<?php

if (($PSEUDO == "user@user.com") &&($MDP ==  "user"))
{
    $PASS = 1;
    ?>
    Redirection en cours user
    <?php
    $_SESSION['pseudo'] = $PSEUDO;
    header('Location: reserverEmplacement.php');
    exit();
}
if (($PSEUDO == 'admin@admin.com')&&($MDP == 'admin'))
{
    $PASS = 1;
    ?>
    Redirection en cours admin
    <?php
    $_SESSION['pseudo'] = $PSEUDO;
    header('Location: partieGerant.php');
    exit();
}
else if(($PSEUDO != null)&&($MDP != null)&&($PASS ==0))
{
    ?>
    Mot de passe incorrect
    <?php
}
?>

<?php include 'footer.php'; ?>

