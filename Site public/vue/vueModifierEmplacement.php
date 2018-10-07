<?php
include 'headerConnexion.php';
include '../accesseur/EmplacementDAO.php';

$id;
$emplacementDAO = new EmplacementDAO();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $emplacementAModifier = $emplacementDAO->trouverEmplacement($id);

    $_SESSION['id_emplacement_a_modifier'] = $id;
}

$longueur = null;
$largeur = null;
$label = null;


if ((isset($_POST['largeur']))) {
    $largeur = $_POST['largeur'];
}
if ((isset($_POST['longueur']))) {
    $longueur = $_POST['longueur'];
}
if ((isset($_POST['label']))) {
    $label = $_POST['label'];
}

if ((isset($label)) && (isset($longueur)) && (isset($largeur))) {
    include '../modele/Emplacement.php';
    $emplacement = new Emplacement($longueur, $largeur, $label);

    $emplacementDAO->modifierEmplacement($emplacement, $_SESSION['id_emplacement_a_modifier']);
    $_SESSION['id_emplacement_a_modifier'] = null;
    header('Location: vueEmplacement.php');
    exit();
}

?>

<div class="ModifierEmplacement">
    <fieldset>
        <legend>Modifier un emplacement</legend>

        <form action="vueModifierEmplacement.php" method="post">
            <label>Label:
                <input type="text" name="label" value="<?php echo $emplacementAModifier->label ?>"/>
            </label>
            </br>
            <label>Longueur:
                <input type="text" name="longueur" value="<?php echo $emplacementAModifier->longueur ?>"/>
            </label>
            </br>
            <label>Largeur:
                <input type="text" name="largeur" value="<?php echo $emplacementAModifier->largeur ?>"/>
            </label>

            </br>

            <input type="submit" name="modifierEmplacement" value="Modifier emplacement"/>

        </form>

    </fieldset>
</div>

<?php include 'footer.php';
