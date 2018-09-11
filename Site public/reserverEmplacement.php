<?php
/**
 * Created by PhpStorm.
 * User: Florent
 * Date: 07/09/2018
 * Time: 14:29
 */
include "header.php";
?>


<fieldset>
    <legend> Ajouter un Auteur</legend>
    <label>Nom auteur :
        <input name="nomAuteur" type="text" size="18" value="">
    </label>
    <?php if (isset($erreurs['nomAuteur'])) echo '<div class="alert alert-danger">'.$erreurs['nomAuteur'].'</div>'; ?>

    <label>Prenom auteur :
        <input name="prenomAuteur" type="text" size="18" value="">
    </label>
    <?php if (isset($erreurs['prenomAuteur'])) echo '<div class="alert alert-danger">'.$erreurs['prenomAuteur'].'</div>'; ?>


    <input type="submit" name="AddAuteur" value ="Add">
</fieldset>

<?php include "footer.php" ?>
