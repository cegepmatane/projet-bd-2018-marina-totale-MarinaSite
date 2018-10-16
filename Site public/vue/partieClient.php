<?php
include 'header.php';

include '../accesseur/BateauDAO.php';
$bateauDAO = new BateauDAO();
$donneesBateaux = $bateauDAO->listerBateau($_SESSION['id']);

include '../accesseur/ClientDAO.php';
$clientDAO = new ClientDAO();
$donneesClient = $clientDAO->trouverClientId($_SESSION['id']);


function possedeBateau()
{
    $bateauDAO = new BateauDAO();
    return $bateauDAO->possedeBateau($_SESSION['id']);
}

?>
    <h2>Ma page client</h2>

    <div class="span12 text-center w3-padding-16">
        <?php if (possedeBateau()): ?>
            <h4><a class="btn btn-primary btn-lg" href="vueReservationClient.php?id=<?php echo $_SESSION['id'] ?>">Consulter
                    mes reservations</a></h4>
        <?php else: ?>
            <span><i>Veuillez ajouter un bateau pour effectuer une nouvelle reservation...</i></span><br>
            <a href="vueAjouterBateau.php?id=<?php echo $_SESSION['id'] ?>">Cliquer ici pour ajouter un bateau...</a>
        <?php endif; ?>
    </div>

    <h3>Mes information :</h3>

    <div class="border w3-padding-24">
        <p class="p-l-md">Nom : <?php echo $donneesClient->nom ?></p>
        <p class="p-l-md">Prenom : <?php echo $donneesClient->prenom ?></p>
        <p class="p-l-md">Mail : <?php echo $donneesClient->mail ?></p>
        <p class="p-l-md">Numero : <?php echo $donneesClient->numero ?></p>

    </div>
    <br>
    <div class="span12 text-center w3-padding-16">
        <a class="btn btn-primary btn-lg" href="vueModifierClient.php?id=<?php echo $_SESSION['id'] ?>">Modifier mes
            informations</a>
    </div>

    <h3>Gestion de mes bateaux :</h3>

    <div class="table-responsive w3-padding-16">
        <table border="2" class="table table-striped table-hover">
            <?php if (isset($donneesBateaux[0])): ?>

                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Longueur</th>
                    <th>Largeur</th>
                    <th>Action...</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($donneesBateaux as $bateau) : ?>
                    <tr>
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
                            <a class="btn btn-outline-secondary" href="vueModifierBateau.php?id=<?= $bateau->id; ?>">modifier</a>
                            <a class="btn btn-outline-secondary" href="../fonctions/supprimerBateau.php?id=<?= $bateau->id; ?>">supprimer</a>
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
        <div class="span12 text-center">
            <a class="btn btn-primary btn-lg" href="vueAjouterBateau.php">Ajouter un bateau</a>
        </div>
    </div>

<?php include "footer.php"; ?>