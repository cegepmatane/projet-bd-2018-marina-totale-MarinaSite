<?php
include 'headerIndex.php';
$nom = null;
$longeur = null;
$largeur = null;

if ((isset($_POST['largeur']))){
    $mail = $_POST['largeur'];
}
if ((isset($_POST['longeur']))){
    $prenom = $_POST['longeur'];
}
if ((isset($_POST['nom']))){
    $nom = $_POST['nom'];
}

if ((isset($longeur)) && (isset($largeur)) && (isset($nom))){
    include '../modele/Bateau.php';
    $bateau = new BateauDAO('kol',34,34);

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

        <form action="vueAjouterBateau.php.php" method="post">
            <label>Nom:
                <input type="text" name="nom"/>
            </label>
            </br>
            <label>Longueur:
                <input type="text" name="longueur"/>
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