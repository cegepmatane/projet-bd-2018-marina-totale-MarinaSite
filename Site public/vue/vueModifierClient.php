<?php
include 'headerIndex.php';
include '../accesseur/ClientDAO.php';

$id;
$clientDAO = new ClientDAO();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $clientAModifier = $clientDAO->trouverClientId($id);

    $_SESSION['id_client_a_modifier'] = $id;
}

$nom = null;
$mot_de_passe = null;
$prenom = null;
$numero = null;
$mail = null;

if ((isset($_POST['mail']))) {
    $mail = $_POST['mail'];
}

if ((isset($_POST['mot_de_passe']))) {
    $mot_de_passe = $_POST['mot_de_passe'];
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

if ((isset($nom)) && (isset($prenom)) && (isset($numero)) && (isset($mail)) && (isset($mot_de_passe))) {
    include '../modele/Client.php';
    $client = new Client($nom, $prenom, MD5($mot_de_passe),$mail, $numero,false);

    $clientDAO->modifierClient($client, $_SESSION['id_client_a_modifier']);
    $_SESSION['id_client_a_modifier'] = null;

    header('Location: partieClient.php');
    exit();
}

?>

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
               <a href="vueModifierMotDePasse.php?id=<?php echo $_SESSION['id']?>">Modifier mon mot de passe</a>
                </br>

                <input type="submit" name="modiferClient" value="Modifier mes informations"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';