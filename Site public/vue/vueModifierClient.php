<?php
include 'header.php';
include '../accesseur/ClientDAO.php';

$id = null;
$clientAModifier = null;

$clientDAO = new ClientDAO();

$erreurs = array();

$dejaPost = 0;
if (!empty($_POST)) {
    $dejaPost = 1;
}

//<br /><b>Notice</b>:  Trying to get property 'prenom' of non-object in <b>/var/www/site/vue/vueModifierClient.php</b> on line <b>91</b><br />

if (isset($_SESSION['id'])) {
    $_SESSION['id_client_a_modifier'] = $_SESSION['id'];
    $clientAModifier = $clientDAO->trouverClientId($_SESSION['id_client_a_modifier']);
}

$nom = null;
$prenom = null;
$numero = null;
$mail = null;

if ((isset($_POST['mail']))) {
    $mail = $_POST['mail'];
}
if ((isset($_POST['numero']))) {
    $numero = $_POST['numero'];
}
if ((isset($_POST['nom']))) {
    $nom = $_POST['nom'];
}
if ((isset($_POST['prenom']))) {
    $prenom = $_POST['prenom'];
}

if ($dejaPost == 1) {

    //php filters
    $mail = filter_var($mail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_EMPTY_STRING_NULL);
    $nom = filter_var($nom, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    $prenom = filter_var($prenom, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    $numero = filter_var($numero, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);


    //Gestion des erreurs
    if (!preg_match("/^[A-Za-z]{2,}/", $nom)) $erreurs['nom'] = "<div class=\"alert alert-danger\">" . _("Votre nom doit faire plus que 2 lettres minimum.") . "</div>";
    if (!preg_match("/^[A-Za-z]{2,}/", $prenom)) $erreurs['prenom'] = "<div class=\"alert alert-danger\">" . _("Votre prenom doit faire plus que 2 lettres minimum.") . "</div>";
    if (!preg_match("/^[0-9]{9}$/", $numero)) $erreurs['numero'] = "<div class=\"alert alert-danger\">" . _("VVotre numeros doit faire 9 digit.") . "</div>";

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $erreurs['mail'] = "<div class=\"alert alert-danger\">" . _("Veuillez entrer un email valide") . "</div>";
    }
}


if ((isset($nom)) && (isset($prenom)) && (isset($numero)) && (isset($mail))) {
    if (empty($erreurs)) {
        $clientAModifier = $clientDAO->trouverClientId($_SESSION['id_client_a_modifier']);
        $mot_de_passe = $clientAModifier->mot_de_passe;

        include '../modele/Client.php';
        $client = new Client($nom, $prenom, $mot_de_passe, $mail, $numero, false);

        $clientDAO->modifierClient($client, $_SESSION['id_client_a_modifier']);

        $_SESSION['id_client_a_modifier'] = null;

        header('Location: partieClient.php');
        exit();
    }
}

?>

    <h1><?php echo _("Modifier mes informations :")?></h1>

    <div class="w3-padding-24">
        <fieldset>
            <legend><?php echo _("Modifier mes informations")?></legend>

            <form action="vueModifierClient.php" method="post">

                <div class="form-group">
                    <label><?php echo ("Prénom:")?>
                        <input type="text" name="prenom"
                               value="<?php if (isset($_POST['prenom'])) {
                                   echo $_POST['prenom'];
                               } else echo $clientAModifier->prenom ?>"/>
                    </label>
                    <?php if (isset($erreurs['prenom'])) echo $erreurs['prenom']; ?>
                </div>

                <div class="form-group">
                    <label><?php echo _("Nom:")?>
                        <input type="text" name="nom"
                               value="<?php if (isset($_POST['nom'])) {
                                   echo $_POST['nom'];
                               } else echo $clientAModifier->nom ?>"/>
                    </label>
                    <?php if (isset($erreurs['nom'])) echo $erreurs['nom']; ?>
                </div>

                <div class="form-group">
                    <label><?php echo ("Numero:")?>
                        <input type="number" name="numero"
                               value="<?php if (isset($_POST['numero'])) {
                                   echo $_POST['numero'];
                               } else echo $clientAModifier->numero ?>"/>
                    </label>
                    <?php if (isset($erreurs['numero'])) echo $erreurs['numero']; ?>
                </div>

                <div class="form-group">
                    <label><?php echo _("Mail:")?>
                        <input type="text" name="mail"
                               value="<?php if (isset($_POST['mail'])) {
                                   echo $_POST['mail'];
                               } else echo $clientAModifier->mail ?>"/>
                    </label>
                    <?php if (isset($erreurs['mail'])) echo $erreurs['mail']; ?>
                </div>

                <div class="form-group">
                    <a class="btn btn-outline-secondary center" href="vueModifierMotDePasse.php"><?php echo _("Modifier mon mot de passe") ?></a>
                </div>

                <div class="form-group">
                    <input class="btn btn-primary btn-medium center" type="submit" name="modiferClient" value="<?php echo _("Modifier mes informations")?>"/>
                </div>
            </form>

        </fieldset>
    </div>

<?php include 'footer.php';