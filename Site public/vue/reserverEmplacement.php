<?php
include "header.php";
?>


<h1>Effectuer une nouvelle reservation :</h1>

<div class="formulaireClient">

    <fieldset>
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
            <input name="longueurBateau" type="number" size="10" value="0">
        </label>
        </br>
        <label>Largeur bateau (en m):
            <input name="largeurBateau" type="number" size="10" value="0">
        </label>
        </br>
        <label>Date d'arrivé :
            <input name="prenomClient" type="date" size="18" value="">
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
    </fieldset>

    <input type="submit" name="send" value="ENREGISTRER">

    <div id='calendar'></div>
</div>

<?php include "footer.php" ?>
