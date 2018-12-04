<?php
include 'header.php';

$nom = null;
$type_bateau = null;
$longueur = null;
$largeur = null;

$erreurs = array();

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

    if (!preg_match('/^[0-9]{1,2}/', $longueur) || $longueur == 0) {
        $erreurs['longueur'] = '<div class="alert alert-danger">'._("La longueur doit etre un nombre compris entre 1 et 99.").'</div>';
    }
    if (!preg_match('/^[0-9]{1,2}/', $largeur) || $largeur == 0) {
        $erreurs['largeur'] = '<div class="alert alert-danger">'._("La largeur doit etre un nombre compris entre 1 et 99.").'</div>';
    }
    if (!preg_match("/^[A-Za-z]{2,}/", $nom)) {
        $erreurs['nom'] = '<div class="alert alert-danger">'._("Le nom doit être composé de lettres uniquement.").'</div>';
    }
    if (!preg_match("/^[A-Za-z]{2,}/", $type_bateau)) {
        $erreurs['type'] = '<div class="alert alert-danger">'._("Le type doit être composé de lettres uniquement.").'</div>';
    }


    if (empty($erreurs)) {
        include '../modele/Bateau.php';
        $bateau = new Bateau($nom, $type_bateau, $longueur, $largeur, $_SESSION['id']);

        include '../accesseur/BateauDAO.php';
        $bateauDAO = new BateauDAO();
        $bateauDAO->ajouterBateau($bateau);

        header('Location: partieClient.php');
        exit();
    }
}

?>
    <h1><?php echo _("Ajouter un bateau :")?></h1>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 pb-5">

                <form action="vueAjouterBateau.php" method="post">

                    <label><?php echo _("Nom du bateau")?></label>
                    <div  class="input-group mb-3">
                        <input class="form-control" type="text" name="nom" value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>"/>
                    </div>

                    <?php if (isset($erreurs['nom'])) {
                        echo $erreurs['nom'];
                    } ?>

                    <label><?php echo _("Type")?></label>
                    <div  class="input-group mb-3">
                        <input class="form-control" type="text" name="type_bateau"
                               value="<?php if (isset($_POST['type_bateau'])) echo $_POST['type_bateau']; ?>"/>
                    </div>

                    <?php if (isset($erreurs['type'])) {
                        echo $erreurs['type'];
                    } ?>

                    <label><?php echo _("Longueur (en pieds)")?></label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="longueur"
                               value="<?php if (isset($_POST['longueur'])) echo $_POST['longueur']; ?>"/>
                    </div>

                    <?php if (isset($erreurs['longueur'])) {
                        echo $erreurs['longueur'];
                    } ?>

                    <label><?php echo _("Largeur (en pieds)")?></label>
                    <div  class="input-group mb-3">
                        <input class="form-control" type="text" name="largeur"
                               value="<?php if (isset($_POST['largeur'])) echo $_POST['largeur']; ?>"/>
                    </div>

                    <?php if (isset($erreurs['largeur'])) {
                        echo $erreurs['largeur'];
                    } ?>


                    <input type="submit" name="ajouterBateau" value="<?php echo _("Ajouter bateau")?>" class="btn btn-primary btn-lg"/>

                </form>
                <br>
                <a class="btn btn-outline-secondary btn-lg" style="text-align: center;" href="partieClient.php"><?php echo _("Retour")?></a>
            </div>
    </div>

<?php include 'footer.php';