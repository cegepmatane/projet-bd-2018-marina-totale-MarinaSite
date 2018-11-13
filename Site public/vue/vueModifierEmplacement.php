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


<h1><?php echo _("Modifier un emplacement")?></h1>
<div class="modifierEmplacement">

        <form action="vueModifierEmplacement.php" method="post">
            <label><?php echo _("Label:")?>
                <input class="form-control" type="text" name="label" value="<?php echo $emplacementAModifier->label ?>"/>
            </label>
            </br>
            <label><?php echo _("Longueur:")?>
                <input class="form-control" type="text" name="longueur" value="<?php echo $emplacementAModifier->longueur ?>"/>
            </label>
            </br>
            <label><?php echo _("Largeur:")?>
                <input class="form-control" type="text" name="largeur" value="<?php echo $emplacementAModifier->largeur ?>"/>
            </label>

            </br>

            <input class="btn btn-primary" type="submit" name="modifierEmplacement" value="<?php echo _("Modifier emplacement:")?>"/>

        </form>

</div>

<?php include 'footer.php';
