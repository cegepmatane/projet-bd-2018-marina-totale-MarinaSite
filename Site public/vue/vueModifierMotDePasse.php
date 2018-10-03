<?php
include 'headerIndex.php';
include '../accesseur/ClientDAO.php';


$ancien_mot_de_passe = null;
$ancien_mot_de_passe_test = null;

$nouveau_mot_de_passe = null;
$confirmer_mot_de_passe = null;

$clientDAO = new ClientDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['id_client_a_modifier'] = $id;
    $clientAModifier = $clientDAO->trouverClientId($_SESSION['id_client_a_modifier']);
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

if ((isset($ancien_mot_de_passe_test)) && (isset($confirmer_mot_de_passe)) && (isset($nouveau_mot_de_passe))) {
    $clientAModifier = $clientDAO->trouverClientId($_SESSION['id_client_a_modifier']);

    $ancien_mot_de_passe = $clientAModifier->mot_de_passe;
    $nom = $clientAModifier->nom;
    $prenom = $clientAModifier->prenom;
    $numero = $clientAModifier->numero;
    $mail = $clientAModifier->mail;
    
    if (ancienMotDePasseCorrect($ancien_mot_de_passe, MD5($ancien_mot_de_passe_test))) {
        if ($nouveau_mot_de_passe === $confirmer_mot_de_passe) {

            include '../modele/Client.php';
            $client = new Client($nom, $prenom, MD5($nouveau_mot_de_passe), $mail, $numero, false);

            $clientDAO->modifierClient($client, $_SESSION['id_client_a_modifier']);
            $_SESSION['id_client_a_modifier'] = null;

            header('Location: partieClient.php');
            exit();
        }
    }
}


function ancienMotDePasseCorrect($motDePasseActuel, $mdpTest)
{
    echo 'Mot de passe hache :'.$motDePasseActuel.'<br>';
    echo 'Mot de passe test hache :'.$mdpTest.'<br>';
    return $mdpTest === $motDePasseActuel;
}

?>

    <div class="modifiermotdepasse">
        <fieldset>
            <legend>Modifier mon mot de passe</legend>
            <form action="vueModifierMotDePasse.php" method="post">
                <label>Ancien mot de passe:
                    <input type="password" name="ancien_mot_de_passe" value=""/>
                </label>
                </br>
                <label>Nouveau mot de passe:
                    <input type="password" name="nouveau_mot_de_passe" value=""/>
                </label>
                </br>
                <label>Confirmer mot de passe:
                    <input type="password" name="confirmer_mot_de_passe" value=""/>
                </label>
                </br>
                <input type="submit" name="modiferMotDePasse" value="Modifier mon mot de passe"/>
            </form>
        </fieldset>
    </div>

<?php include 'footer.php';