<?php
include "header.php";
?>


<h1><?php echo _("Effectuer une nouvelle reservation :")?></h1>

<div class="formulaireClient">

    <fieldset>
        <legend><?php echo _("Réserver un emplacement")?></legend>
        <label><?php echo _("Nom :")?>
            <input name="nomClient" type="text" size="18" value="">
        </label>
        </br>
        <label><?php echo _("Prénom :")?>
            <input name="prenomClient" type="text" size="18" value="">
        </label>
        </br>
        <label><?php echo _("Longueur bateau (en pieds) :")?>
            <input name="longueurBateau" type="number" size="10" value="0">
        </label>
        </br>
        <label><?php echo _("Largeur bateau (en pieds) :")?>
            <input name="largeurBateau" type="number" size="10" value="0">
        </label>
        </br>
        <label><?php echo _("Date d'arrivée :")?>
            <input name="prenomClient" type="date" size="18" value="">
        </label>
        </br>
        <label><?php echo _("Date de départ :")?>
            <input name="dateDepart" type="date" size="18" value="">
        </label>
        </br>
        <label><?php echo _("Electricité :")?>
            <input name="electricité" type="checkbox" size="18" value="">
        </label>
        </br>
        <label><?php echo _("Essence :")?>
            <input name="essence" type="checkbox" size="18" value="">
        </label>
        </br>
        <label><?php echo _("Vidange :")?>
            <input name="vidange" type="checkbox" size="18" value="">
        </label>
        </br></br>
    </fieldset>

    <input type="submit" name="send" value="<?php echo _("Enregistrer :")?>">

    <div id='calendar'></div>
</div>

<?php include "footer.php" ?>
