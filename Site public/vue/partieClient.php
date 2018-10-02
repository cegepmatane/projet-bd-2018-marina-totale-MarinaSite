<?php
include 'header.php';
include '../accesseur/BateauDAO.php';
$bateauDAO = new BateauDAO();
$donnees = $bateauDAO->listerBateau($_SESSION['id']);
?>
Bonjour, <?php echo  $_SESSION['pseudo']?>

<h1>Ma page client</h1>

<h2>Mes bateaux :</h2>


<div class="row">
    <table border="2">
        <caption>Recapitulatifs des Bateaux</caption>
        <?php if(isset($donnees[0])): ?>
            <thead>
            <tr><th>ID bateau</th><th>Nom</th><th>Type</th><th>Longueur</th><th>Largeur</th><th>Action...</th></tr>
            </thead>
            <tbody>
            <?php foreach ($donnees as $bateau) :?>
                <tr><td>
                        <?php echo $bateau->id; ?>
                    </td>
                    <td>
                        <?php echo $bateau->nom; ?>
                    </td>
                    <td>
                        <?php echo $bateau->type_bateau; ?>
                    </td>
                    <td>
                        <?php echo $bateau->longueur; ?>
                    </td>
                    <td>
                        <?php echo $bateau->largeur; ?>
                    </td>
                    <td>
                        <a href="vueModifierBateau.php?id=<?=$bateau->id; ?>">modifier</a>
                        <a href="../fonctions/supprimerBateau.php?id=<?=$bateau->id; ?>">supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        <?php else: ?>
            <tr>
                <td>Pas de bateau</td>
            </tr>
        <?php endif; ?>
    </table>

    <a href="vueAjouterBateau.php">Ajouter un bateau</a>
</div>

<?php include "footer.php"; ?>