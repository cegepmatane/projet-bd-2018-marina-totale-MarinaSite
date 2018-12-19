<?php
include 'header.php';
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
    $bateau = new Bateau($nom, $type_bateau, $longueur, $largeur, $_SESSION['id_bateau_a_modifier']);

    $bateauDAO->modifierBateau($bateau, $_SESSION['id_bateau_a_modifier']);
    $_SESSION['id_bateau_a_modifier'] = null;
    header('Location: partieClient.php');
    exit();
}

?>
<div class="p-lg-5 p-md-3">
    <h1><?php echo _("Modifier mon bateau :") ?></h1>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 pb-5">

            <form action="vueModifierBateau.php" method="post">
                <label><?php echo _("Nom du bateau: ") ?>  </label>
                <div class="input-group mb-3">
                    <input class="form-control" type="text" name="nom" value="<?php echo $bateauAModifier->nom ?>"/>
                </div>
                <label><?php echo _("Type: ") ?>  </label>
                <div class="input-group mb-3">
                    <input class="form-control" type="text" name="type_bateau" value="<?php echo $bateauAModifier->type_bateau ?>"/>
                </div>
                <label><?php echo _("Longueur: ") ?>  </label>
                <div class="input-group mb-3">
                    <input class="form-control" type="text" name="longueur" value="<?php echo $bateauAModifier->longueur ?>"/>
                </div>
                <label><?php echo _("Largeur: ") ?></label>
                <div class="input-group mb-3">
                    <input class="form-control" type="text" name="largeur" value="<?php echo $bateauAModifier->largeur ?>"/>
                </div>

                <input class="btn-primary btn btn-lg" type="submit" name="modifierBateau" value="<?php echo _("Modifier bateau") ?>"/>

            </form>
            <br>
            <a class="btn btn-outline-secondary btn-lg" style="text-align: center;" href="partieClient.php"><?php echo _("Retour")?></a>

        </div>
    </div>
</div>
<?php include 'footer.php';