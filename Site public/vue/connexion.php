<?php include 'headerConnexion.php';
include '../modele/Client.php';
include '../accesseur/ClientDAO.php';

// REDIRECION SI DEJA CONNECTÉ

$ClientDAO = new ClientDAO();

if (isset($_SESSION['id'])) {
    if ($ClientDAO->trouverClientId($_SESSION['id'])->bool_gerant) {
        header('Location: partieGerant.php');
        exit();
    } else {
        header('Location: partieClient.php');
        exit();
    }
}

$PASS = 0;
$PSEUDO = null;
$MDP = null;
if ((isset($_POST['mot_de_passe']))) {
    $MDP = $_POST['mot_de_passe'];
}
if ((isset($_POST['pseudo']))) {
    $PSEUDO = $_POST['pseudo'];
}

if (isset($PSEUDO) && isset($MDP)) {
    connexion($PSEUDO, $MDP);
}
?>

<div class="formulaireClient">
    <fieldset>
        <legend>Connexion à MarinaConnect</legend>

        <form class="form-horizontal" action="connexion.php" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2">Mail: </label><br>
                <input class="form-control" type="email" name="pseudo"/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Mot de passe: </label><br>
                <input class="form-control" type="password" name="mot_de_passe"/>
            </div>
            <input class="btn btn-default" type="submit" name="send" value="CONNEXION">
        </form>
    </fieldset>

    <a href="creerCompte.php">Creer un compte...</a>
</div>

<?php
function connexion($PSEUDO, $MDP)
{
    $ClientDAO = new ClientDAO();
    if ($ClientDAO->clientExiste($PSEUDO)) {
        $clientCourant = $ClientDAO->trouverClientMail($PSEUDO);

        if (motDePasseJuste($clientCourant->mot_de_passe, $MDP)) {
            $_SESSION['pseudo'] = $PSEUDO;
            $_SESSION['id'] = $clientCourant->id;

            if ($clientCourant->bool_gerant) {
                header('Location: partieGerant.php');
                exit();
            } else {
                header('Location: partieClient.php');
                exit();
            }
        }
    }
}

function motDePasseJuste($motDePasseActuel, $MDP)
{
    return ($motDePasseActuel === md5($MDP));
}


if (($PSEUDO != null) && ($MDP != null)) {
    ?>
    Mot de passe incorrect
    <?php
}
?>

<?php include 'footer.php'; ?>

