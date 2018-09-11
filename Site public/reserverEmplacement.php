<?php
/**
 * Created by PhpStorm.
 * User: Florent
 * Date: 07/09/2018
 * Time: 14:29
 */
include "header.php";
?>


<fieldset class="formulaireClient">
    <legend>Réserver un emplacement</legend>
    <label>Nom :
        <input name="nomClient" type="text" size="18" value="">
    </label>
    </br>
    <label>Prenom :
        <input name="prenomClient" type="text" size="18" value="">
    </label>
    </br>
    <label>Longueur bateau (en m):
        <input name="longueurBateau" type="number" size="18" value="">
    </label>
    </br>
    <label>Largeur bateau (en m):
        <input name="largeurBateau" type="number" size="5" value="">
    </label>
    </br>
    <label>Date d'arrivé :
        <input name="prenomClient" type="date" size="5" value="">
    </label>
    </br>
    <label>Date de départ :
        <input name="dateDepart" type="date" size="18" value="">
    </label>
    </br>
    <label>Electricité :
        <input name="electricité" type="checkbox" size="18" value="">
    </label>
    </br>
    <label>Éssence :
        <input name="essence" type="checkbox" size="18" value="">
    </label>
    </br>
    <label>Vidange :
        <input name="vidange" type="checkbox" size="18" value="">
    </label>
    </br></br>

    <input type="submit" name="send" value ="ENREGISTRER">
</fieldset>

<?php include "footer.php" ?>
