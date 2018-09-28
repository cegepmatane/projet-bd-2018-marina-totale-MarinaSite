<?php
include 'headerIndex.php';
include '../accesseur/BateauDAO.php';

$id = $_GET['id'];

$bateauDAO = new BateauDAO();

$bateauAModifier = $bateauDAO->trouverBateau($id);

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

    $bateauDAO->modifierBateau($bateau);

    header('Location: partieClient.php');
    exit();
}

?>

    <div class="modifierbateau">
        <fieldset>
            <legend>Modifier bateau</legend>

            <form action="vueModifierBateau.php" method="post">
                <label>Nom:
                    <input type="text" name="nom" value="<?php echo $bateauAModifier->nom?>"/>
                </label>
                </br>
                <label>Type:
                    <input type="text" name="type_bateau" value="<?php echo $bateauAModifier->type_bateau?>"/>
                </label>
                </br>
                <label>Longueur:
                    <input type="text" name="longeur" value="<?php echo $bateauAModifier->longueur?>"/>
                </label>
                </br>
                <label>Largeur:
                    <input type="text" name="largeur" value="<?php echo $bateauAModifier->largeur?>"/>
                </label>
                </br>

                <input type="submit" name="ajouterBateau" value="Modifier bateau"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';