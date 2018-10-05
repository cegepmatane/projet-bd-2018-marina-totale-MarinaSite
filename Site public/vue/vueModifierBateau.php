<?php
include 'headerConnexion.php';
include '../accesseur/BateauDAO.php';

$id;
$bateauDAO = new BateauDAO();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $bateauAModifier = $bateauDAO->trouverBateau($id);

    $_SESSION['id_bateau_a_modifier'] = $id;
}

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
    $bateau = new Bateau($nom, $type_bateau, $longueur, $largeur,$_SESSION['id_bateau_a_modifier']);

    $bateauDAO->modifierBateau($bateau, $_SESSION['id_bateau_a_modifier']);
    $_SESSION['id_bateau_a_modifier'] = null;
     header('Location: partieClient.php');
     exit();
}

?>
    <h1>Modifier mon bateau :</h1>

    <div class="modifierbateau">
        <fieldset>
            <legend>Modifier bateau</legend>

            <form action="vueModifierBateau.php" method="post">
                <label>Nom:
                    <input type="text" name="nom" value="<?php echo $bateauAModifier->nom ?>"/>
                </label>
                </br>
                <label>Type:
                    <input type="text" name="type_bateau" value="<?php echo $bateauAModifier->type_bateau ?>"/>
                </label>
                </br>
                <label>Longueur:
                    <input type="text" name="longueur" value="<?php echo $bateauAModifier->longueur ?>"/>
                </label>
                </br>
                <label>Largeur:
                    <input type="text" name="largeur" value="<?php echo $bateauAModifier->largeur ?>"/>
                </label>
                </br>

                <input type="submit" name="modifierBateau" value="Modifier bateau"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';