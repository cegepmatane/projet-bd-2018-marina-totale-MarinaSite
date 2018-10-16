<?php
include 'header.php';

$nom = null;
$type_bateau = null;
$longueur = null;
$largeur = null;

if ((isset($_POST['largeur']))) {
    $largeur = $_POST['largeur'];
}
if ((isset($_POST['longueur']))) {
    $longueur = $_POST['longueur'];
}
if ((isset($_POST['nom']))) {
    $nom = $_POST['nom'];
}
if ((isset($_POST['type_bateau']))) {
    $type_bateau = $_POST['type_bateau'];
}

if ((isset($nom)) && (isset($type_bateau)) && (isset($longueur)) && (isset($largeur))) {
    include '../modele/Bateau.php';
    $bateau = new Bateau($nom, $type_bateau, $longueur, $largeur, $_SESSION['id']);

    include '../accesseur/BateauDAO.php';
    $bateauDAO = new BateauDAO();
    $bateauDAO->ajouterBateau($bateau);

    header('Location: partieClient.php');
    exit();
}

?>
    <h1>Ajouter un bateau :</h1>

    <div class="formulaireClient">
        <fieldset>
            <legend>Ajouter un nouveau bateau</legend>

            <form action="vueAjouterBateau.php" method="post">
                <div class="form-group">
                    <label>Nom:</label>
                    <input type="text" name="nom"/>
                </div>
                <div class="form-group">
                    <label>Type:</label>
                    <input type="text" name="type_bateau"/>
                </div>
                <div class="form-group">
                    <label>Longueur:</label>
                    <input type="text" name="longueur"/>
                </div>
                <div class="form-group">
                    <label>Largeur:</label>
                    <input type="text" name="largeur"/>
                </div>

                <input type="submit" name="ajouterBateau" value="Ajouter bateau"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';