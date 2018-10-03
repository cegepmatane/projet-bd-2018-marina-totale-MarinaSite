<?php
include 'headerIndex.php';

include '../accesseur/BateauDAO.php';
$bateauDAO = new BateauDAO();
$donneesBateaux = $bateauDAO->listerBateau($_SESSION['id']);

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

    <div class="ajouterbateau">
        <fieldset>
            <legend>Effectuer une nouvelle réservation</legend>

            <form action="vueAjouterReservation.php" method="post">
                <label>Date d'arrivé:
                    <input type="date" name="nom"/>
                </label>
                </br>
                <label>Date de départ:
                    <input type="date" name="type_bateau"/>
                </label>
                </br>
                <label>Bateau:
                    <select required>
                        <?php if (isset($donneesBateaux[0])): ?>
                            <option selected="selected">-SELECTIONNEZ VOTRE BATEAU-</option>
                            <?php foreach ($donneesBateaux as $bateau) : ?>
                                <option value="<?php $bateau->id?>"><?php echo $bateau->nom?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Pas de bateaux</option>
                        <?php endif; ?>
                    </select>
                </label>
                </br>
                <label><u>Services</u></label><br>

                <label>Electricité:
                    <input type="checkbox" name="electricite"/>
                </label>
                </br>
                <label>Vidange:
                    <input type="checkbox" name="vidange"/>
                </label>
                </br>
                <label>Essence:
                    <input type="checkbox" name="essence"/>
                </label>
                </br>

                <input type="submit" name="ajouterReservation" value="Effectuer une demande de réservation"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';