<?php
include 'headerIndex.php';

$nom = null;
$type_bateau = null;
$longeur = null;
$largeur = null;

if ((isset($_POST['largeur']))) {
    $largeur = $_POST['largeur'];
}
if ((isset($_POST['longeur']))) {
    $longeur = $_POST['longeur'];
}
if ((isset($_POST['nom']))) {
    $nom = $_POST['nom'];
}
if ((isset($_POST['type_bateau']))) {
    $type_bateau = $_POST['type_bateau'];
}

if ((isset($nom)) && (isset($type_bateau)) && (isset($longeur)) && (isset($largeur))) {
    include '../modele/Bateau.php';
    $bateau = new Bateau($nom,$type_bateau,$longeur,$largeur);

    include '../accesseur/BateauDAO.php';
    $bateauDAO = new BateauDAO();
    $bateauDAO->ajouterBateau($bateau);

    header('Location: partieClient.php');
    exit();
}

?>

    <div class="ajouterbateau">
        <fieldset>
            <legend>Ajouter un nouveau bateau</legend>

            <form action="vueAjouterBateau.php" method="post">
                <label>Nom:
                    <input type="text" name="nom"/>
                </label>
                </br>
                <label>Type:
                    <input type="text" name="type_bateau"/>
                </label>
                </br>
                <label>Longueur:
                    <input type="text" name="longeur"/>
                </label>
                </br>
                <label>Largeur:
                    <input type="text" name="largeur"/>
                </label>
                </br>

                <input type="submit" name="ajouterBateau" value="Ajouter bateau"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';