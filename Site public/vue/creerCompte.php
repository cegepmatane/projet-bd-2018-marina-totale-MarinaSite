<?php include 'headerConnexion.php';
$prenom = null;
$nom = null;
$mail = null;
$motDePasse = null;
$password2 = null;
$mobile = null;

$dejaPost = 0;
if (!empty($_POST)) {
    $dejaPost = 1;
}

if ((isset($_POST['motDePasse']))) {
    $motDePasse = $_POST['motDePasse'];
}
if ((isset($_POST['password2']))) {
    $password2 = $_POST['password2'];
}
if ((isset($_POST['mail']))) {
    $mail = $_POST['mail'];
}
if ((isset($_POST['prenom']))) {
    $prenom = $_POST['prenom'];
}
if ((isset($_POST['nom']))) {
    $nom = $_POST['nom'];
}
if ((isset($_POST['numero']))) {
    $numero = $_POST['numero'];
}




if ($dejaPost == 1) {

    //php filters
    $mail =     filter_var($mail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_EMPTY_STRING_NULL);
    $nom =      filter_var($nom, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    $prenom =   filter_var($prenom, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    $numero =   filter_var($numero, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);


    //Gestion des erreurs
    if (!preg_match("/^[A-Za-z]{2,}/", $nom))           $erreurs['nom'] = "<div class=\"alert alert-danger\">Votre nom doit faire plus que 2 lettres minimum.</div>";
    if (!preg_match("/^[A-Za-z]{2,}/", $prenom))        $erreurs['prenom'] = "<div class=\"alert alert-danger\">Votre prenom doit faire plus que 2 lettres minimum.</div>";
    if (!preg_match("/^[0-9]{9}$/", $numero))           $erreurs['numero'] = "<div class=\"alert alert-danger\">Votre numeros doit faire 9 digit.</div>";
    if (strlen($motDePasse) < 3)                               $erreurs['motdepasse'] = "<div class=\"alert alert-danger\">Votre mot de passe doit faire plus que 2 charachteres minimum.</div>";

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $erreurs['mail'] = "<div class=\"alert alert-danger\">Veuillez rentrer un mail valide.</div>";
    }

    if (!verifMDP($motDePasse, $password2)) {
        $erreurs['motdepasse_identique'] = "<div class=\"alert alert-danger\">Veuillez deux mots de passe identiques.</div>";
    }
}

function verifMDP($motDePasse, $password2)
{
    return $motDePasse === $password2;
}

if ((isset($mail)) && (isset($motDePasse)) && (isset($nom)) && (isset($prenom))
    && (isset($numero)) && (isset($password2))
    && verifMDP($motDePasse, $password2)) {
    include '../accesseur/ClientDAO.php';
    $clientDAO = new ClientDAO();
    include '../modele/Client.php';
    if (!($clientDAO->clientExiste($mail))) {
        $client = new Client($nom, $prenom, md5($motDePasse), $mail, $numero, false);
        $clientDAO->ajouterClient($client);


        header('Location: connexion.php');
        exit();
    } else {
        echo 'Un compte existe deja avec cet email.';
    }
}

?>
    <h3>Créer mon compte :</h3>

    <div class="creerCompte w3-padding-24">
        <fieldset>

            <form action="creerCompte.php" method="post">

                <div class="form-group">
                    <label>Mail:
                        <input type="email" name="mail" value="<?php if (isset($_POST['mail'])) echo $_POST['mail']; ?>"/>
                    </label>
                </div>
                <?php if (isset($erreurs['mail'])) {
                    echo $erreurs['mail'];
                } ?>

                <div class="form-group">
                    <label>Nom :
                        <input type="text" name="nom" value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>"/>
                    </label>
                </div>
                <?php if (isset($erreurs['nom'])) {
                    echo $erreurs['nom'];
                } ?>

                <div class="form-group">
                    <label>Prenom:
                        <input type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) echo $_POST['prenom']; ?>"/>
                    </label>
                </div>
                <?php if (isset($erreurs['prenom'])) {
                    echo $erreurs['prenom'];
                } ?>

                <div class="form-group">
                    <label>Mobile :
                        <input type="number" name="numero" value="<?php if (isset($_POST['numero'])) echo $_POST['numero']; ?>"/>
                    </label>
                </div>
                <?php if (isset($erreurs['numero'])) {
                    echo $erreurs['numero'];
                } ?>

                <div class="form-group">
                    <label>Mot de passe:
                        <input type="password" name="motDePasse" value="<?php if (isset($_POST['motDePasse'])) echo $_POST['motDePasse']; ?>"/>/>
                    </label>
                </div>

                <div class="form-group">
                    <label>Confirmer mot de passe :
                        <input type="password" name="password2"/>
                    </label>
                </div>

                <?php if (isset($erreurs['motdepasse'])) {
                    echo $erreurs['motdepasse'];
                } ?>

                <?php if (isset($erreurs['motdepasse_identique'])) {
                    echo $erreurs['motdepasse_identique'];
                } ?>

                <input class="btn btn-primary" type="submit" name="creerCompte" value="Créer compte"/>

            </form>
        </fieldset>
    </div>

<?php include "footer.php"; ?>