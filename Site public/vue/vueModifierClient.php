<?php
include 'header.php';
include '../accesseur/ClientDAO.php';

$id;
$clientDAO = new ClientDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['id_client_a_modifier'] = $id;
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

if ((isset($nom)) && (isset($prenom)) && (isset($numero)) && (isset($mail))) {
    $clientAModifier = $clientDAO->trouverClientId($_SESSION['id_client_a_modifier']);
    $mot_de_passe = $clientAModifier->mot_de_passe;

    include '../modele/Client.php';
    $client = new Client($nom, $prenom, $mot_de_passe,$mail, $numero,false);

    $clientDAO->modifierClient($client, $_SESSION['id_client_a_modifier']);

    $_SESSION['id_client_a_modifier'] = null;

    header('Location: partieClient.php');
    exit();
}

?>

    <h1>Modifier mes informations :</h1>

    <div class="modifierclient">
        <fieldset>
            <legend>Modifier mes informations</legend>

            <form action="vueModifierClient.php" method="post">
                <label>Nom:
                    <input type="text" name="nom" value="<?php echo $clientAModifier->nom ?>"/>
                </label>
                </br>
                <label>Prenom:
                    <input type="text" name="prenom" value="<?php echo $clientAModifier->prenom ?>"/>
                </label>
                </br>
                <label>Numero:
                    <input type="number" name="numero" value="<?php echo $clientAModifier->numero ?>"/>
                </label>
                </br>
                <label>Mail:
                    <input type="email" name="mail" value="<?php echo $clientAModifier->mail ?>"/>
                </label>
                </br>
               <a href="vueModifierMotDePasse.php?id=<?php echo $_SESSION['id']?>">Modifier mon mot de passe</a>
                </br>

                <input type="submit" name="modiferClient" value="Modifier mes informations"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';