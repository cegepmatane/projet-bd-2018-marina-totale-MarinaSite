<?php
include 'header.php';
include '../accesseur/ClientDAO.php';


$ancien_mot_de_passe = null;
$ancien_mot_de_passe_test = null;

$nouveau_mot_de_passe = null;
$confirmer_mot_de_passe = null;

$erreurs = array();
$dejaPost = 0;
if (!empty($_POST)) {
    $dejaPost = 1;
}

$clientDAO = new ClientDAO();

if (isset($_SESSION['id_client_a_modifier'])) {
    $id = $_SESSION['id_client_a_modifier'];
    $clientAModifier = $clientDAO->trouverClientId($id);
    $ancien_mot_de_passe = $clientAModifier->mot_de_passe;
}

if ((isset($_POST['ancien_mot_de_passe']))) {
    $ancien_mot_de_passe_test = $_POST['ancien_mot_de_passe'];
}

if ((isset($_POST['nouveau_mot_de_passe']))) {
    $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];
}
if ((isset($_POST['confirmer_mot_de_passe']))) {
    $confirmer_mot_de_passe = $_POST['confirmer_mot_de_passe'];
}

if ($dejaPost == 1) {
    // gestion des erreurs
    if (!ancienMotDePasseCorrect($ancien_mot_de_passe, MD5($ancien_mot_de_passe_test))) {
        $erreurs['ancien_mot_de_passe'] = "<div class=\"alert alert-danger\">" . _("Votre mot de passe n'est pas correct") . "</div>";
    } else {
        if (MD5($nouveau_mot_de_passe) === $ancien_mot_de_passe) {
            $erreurs['mot_passe_passe_precedent'] = "<div class=\"alert alert-danger\">" . _("Votre mot de passe ne peut être identique au mot de passe précédant.") . "</div>";
        }
    }
    if ($nouveau_mot_de_passe !== $confirmer_mot_de_passe) {
        $erreurs['nouveau_mot_de_passe'] = "<div class=\"alert alert-danger\">" . _("Veuillez rentrer deux mot de passe identique") . "</div>";
    }
    if (strlen($nouveau_mot_de_passe) < 4) $erreurs['motdepasse'] = "<div class=\"alert alert-danger\">" . _("Votre mot de passe doit faire plus que 2 charachteres minimum.") . "</div>";
}
if ((isset($ancien_mot_de_passe_test)) && (isset($confirmer_mot_de_passe)) && (isset($nouveau_mot_de_passe))) {
    $clientAModifier = $clientDAO->trouverClientId($_SESSION['id_client_a_modifier']);

    $ancien_mot_de_passe = $clientAModifier->mot_de_passe;
    $nom = $clientAModifier->nom;
    $prenom = $clientAModifier->prenom;
    $numero = $clientAModifier->numero;
    $mail = $clientAModifier->mail;

    if (empty($erreurs)) {
        include '../modele/Client.php';
        $client = new Client($nom, $prenom, MD5($nouveau_mot_de_passe), $mail, $numero, false);

        $clientDAO->modifierClient($client, $_SESSION['id_client_a_modifier']);
        $_SESSION['id_client_a_modifier'] = null;

        include '../fonctions/envoyerMailCompte.php';
        $mail_envoye = envoyerMail("Mot de passe modifie", "Votre mot de passe a bien été modifié sur notre site marina connect ! Votre identifiant : " . $client->getMail());

        header('Location: partieClient.php');
        exit();
    }
}


function ancienMotDePasseCorrect($motDePasseActuel, $mdpTest)
{
    echo 'Mot de passe hache :' . $motDePasseActuel . '<br>';
    echo 'Mot de passe test hache :' . $mdpTest . '<br>';
    return $mdpTest === $motDePasseActuel;
}

?>
    <h1><?php echo _("Modifier mon mot de passe :")?></h1>

    <div class="w3-padding-24">
        <fieldset>
            <legend><?php echo _("Modifier mon mot de passe")?></legend>
            <form action="vueModifierMotDePasse.php" method="post">
                <div class="form-group">
                    <label>Ancien mot de passe:
                        <input type="password" name="ancien_mot_de_passe"
                               value="<?php if (isset($_POST['ancien_mot_de_passe'])) echo $_POST['ancien_mot_de_passe'] ?>"/>
                    </label>
                    <?php if (isset($erreurs['ancien_mot_de_passe'])) echo $erreurs['ancien_mot_de_passe']; ?>

                </div>
                <div class="form-group">
                    <label>Nouveau mot de passe:
                        <input type="password" name="nouveau_mot_de_passe"
                               value="<?php if (isset($_POST['nouveau_mot_de_passe'])) echo $_POST['nouveau_mot_de_passe'] ?>"/>
                    </label>
                </div>
                <div class="form-group">
                    <label><?php echo _("Confirmer mot de passe:")?>
                        <input type="password" name="confirmer_mot_de_passe" value=""/>
                    </label>
                    <?php if (isset($erreurs['nouveau_mot_de_passe'])) echo $erreurs['nouveau_mot_de_passe']; ?>
                    <?php if (isset($erreurs['motdepasse'])) echo $erreurs['motdepasse']; ?>
                    <?php if (isset($erreurs['mot_passe_passe_precedent'])) echo $erreurs['mot_passe_passe_precedent']; ?>
                </div>

                <div class="form-group span12 text-center w3-padding-16">
                    <input class="btn btn-primary btn-medium" type="submit" name="modiferMotDePasse"
                           value="Modifier mon mot de passe"/>
                </div>
            </form>
        </fieldset>
    </div>

<?php include 'footer.php';