<?php include 'headerIndex.php';
$PASS = 0;
$PSEUDO = null;
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
                <input type="submit" name="send" value="CONNEXION">
            </p>
        </form>
        <a href="creerCompte.php">Creer un compte</a>
</div>

<?php
function connexion($PSEUDO, $MDP){

    include '../modele/Client.php';
    include '../accesseur/ClientDAO.php';
    $ClientDAO = new ClientDAO();
    if ($ClientDAO ->clientExiste($PSEUDO)){
        $clientCourant = $ClientDAO ->trouverClientMail($PSEUDO);
        if(motDePasseJuste($clientCourant, $MDP)){
            $_SESSION['pseudo'] = $PSEUDO;
            if($clientCourant->getBoolGerant()){
                header('Location: partieGerant.php');
                exit();
            }
            header('Location: partieClient.php');
            exit();

        }
    }
}
function motDePasseJuste(Client $client, $MDP){
    return ($client -> getMotDePasse() === md5($MDP));
}


if(($PSEUDO != null)&&($MDP != null))
{
    ?>
    Mot de passe incorrect
    <?php
}
?>

<?php include 'footer.php'; ?>

