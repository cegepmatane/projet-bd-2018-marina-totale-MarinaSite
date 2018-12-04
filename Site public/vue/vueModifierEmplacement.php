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
    <div class="p-lg-5 p-md-3 row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 pb-5">
            <h1><?php echo _("Modifier un emplacement") ?></h1>

            <form action="vueModifierEmplacement.php" method="post">
                <label><?php echo _("Label:") ?>
                    <input class="form-control" type="text" name="label"
                           value="<?php echo $emplacementAModifier->label ?>"/>
                </label>
                </br>
                <label><?php echo _("Longueur: (en pieds)") ?>
                    <input class="form-control" type="number" name="longueur"
                           value="<?php echo $emplacementAModifier->longueur ?>"/>
                </label>
                </br>
                <label><?php echo _("Largeur: (en pieds)") ?>
                    <input class="form-control" type="number" name="largeur"
                           value="<?php echo $emplacementAModifier->largeur ?>"/>
                </label>

                </br>

                <input class="btn btn-primary" type="submit" name="modifierEmplacement"
                       value="<?php echo _("Modifier emplacement:") ?>"/>

            </form>
        </div>
    </div>

<?php include 'footer.php';
