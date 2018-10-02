<?php include 'headerIndex.php';
$prenom = null;
$nom = null;
$mail = null;
$motDePasse = null;
$password2 = null;
$mobile = null;
if ((isset($_POST['motDePasse']))){
    $motDePasse = $_POST['motDePasse'];
}
if ((isset($_POST['password2']))){
    $password2 = $_POST['password2'];
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
if ((isset($_POST['numero']))){
    $numero = $_POST['numero'];
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
                <label>Mobile :
                    <input type="number" name="numero"/>
                </label>
                </br>
                <label>Mot de passe:
                    <input type="password" name="motDePasse"/>
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
function verifMDP($motDePasse, $password2){
    return $motDePasse === $password2;
}
if ((isset($mail)) && (isset($motDePasse)) && (isset($nom)) &&(isset($prenom))
    && (isset($numero)) && (isset($password2))
    && verifMDP($motDePasse, $password2)){
    include '../accesseur/ClientDAO.php';
    $clientDAO = new ClientDAO();
    include '../modele/Client.php';

    $client = new Client($nom, $prenom, md5($motDePasse), $mail, $numero);
    $clientDAO ->ajouterClient($client);

    header('Location: index.php');
    exit();
}



include "footer.php"; ?>