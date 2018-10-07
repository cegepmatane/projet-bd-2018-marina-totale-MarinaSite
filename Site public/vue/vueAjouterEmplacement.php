<?php
include 'header.php';

$label = null;
$longueur = null;
$largeur = null;


if ((isset($_POST['label']))) {
    $label = $_POST['label'];
}
if ((isset($_POST['longueur']))) {
    $longueur = $_POST['longueur'];
}
if ((isset($_POST['largeur']))) {
    $largeur = $_POST['largeur'];
}

if ((isset($label)) && (isset($longueur)) && (isset($largeur))) {
    include '../modele/Emplacement.php';
    $emplacement = new Emplacement($longueur, $largeur, $label);

    print_r($emplacement);

    include '../accesseur/EmplacementDAO.php';
    $emplacementDAO = new EmplacementDAO();

    $emplacementDAO->ajouterEmplacement($emplacement);

   header('Location: vueEmplacement.php');
    exit();
}

?>
    <div class="ajouterEmplacement">
        <fieldset>
            <legend>Ajouter un nouvel emplacement</legend>

            <form action="vueAjouterEmplacement.php" method="post">
                <label>Label:
                    <input class="form-control" type="text" name="label" value="<?php if (isset($_POST['label'])) echo $_POST['label'] ?>"/>
                </label>
                </br>
                <label>Longueur:
                    <input class="form-control" type="text" name="longueur" value="<?php if (isset($_POST['longueur'])) echo $_POST['longueur'] ?>"/>
                </label>
                </br>
                <label>Largeur:
                    <input class="form-control" type="text" name="largeur" value="<?php if (isset($_POST['largeur'])) echo $_POST['largeur'] ?>"/>
                </label>

                </br>

                <input class="btn btn-primary" type="submit" name="ajouterEmplacement" value="Ajouter emplacement"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';