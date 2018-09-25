<?php include 'headerIndex.php';
$prenom = null;
$nom = null;
$mail = null;
$password = null;
$mobile = null;
if ((isset($_POST['password']))){
    $password = $_POST['password'];
}
if ((isset($_POST['mail']))){
    $mail = $_POST['mail'];
}
if ((isset($_POST['prenom']))){
    $prenom = $_POST['prenom'];
}
if ((isset($_POST['nom']))){
    $nom = $_POST['nom'];
}
if ((isset($_POST['mobile']))){
    $mobile = $_POST['mobile'];
}?>

    <div class="creerCompte">
        <fieldset>
            <legend>Créer mon compte</legend>

            <form action="creerCompte.php" method="post">
                <label>Mail:
                    <input type="email" name="mail"/>
                </label>
                </br>
                <label>Nom :
                    <input type="text" name="nom"/>
                </label>
                </br>
                <label>Prenom:
                    <input type="text" name="prenom"/>
                </label>
                </br>
                <label>Mot de passe:
                    <input type="password" name="password"/>
                </label>
                </br>
                <label>Confirmer mot de passe :
                    <input type="password" name="password2"/>
                </label>
                </br>
                <input type="submit" name="creerCompte" value="Créer compte" />

            </form>
        </fieldset>
    </div>

<?php
if ((isset($mail)) && (isset($password)) && (isset($nom)) &&(isset($prenom))){
    echo 'merci';
    header('Location: index.php');
    exit();
}



include "footer.php"; ?>