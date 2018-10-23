<!DOCTYPE html>
<html style="height:100%;">
<title>Sécurité sur l'eau</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../img/marina.ico">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
    .w3-sidebar {
        z-index: 3;
        width: 250px;
        top: 43px;
        bottom: 0;
        height: inherit;
    }
</style>
<body style="height:100%;">

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
        <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
        <a href="index.php" class="w3-bar-item w3-button w3-theme-l1">Marina Connect&trade;</a>
    </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
        <i class="fa fa-remove"></i>
    </a>
    <h4 class="w3-bar-item"><b>Menu</b></h4>
    <a class="w3-bar-item w3-button w3-hover-black" href="pagePeche.php">Pêche</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="pageTraversee.php">Traversée</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="pageSecurite.php">Sécurité</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="connexion.php">Marina Connect &trade;</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px; height:100%;">
    <div style="min-height:92.8%;">
    <div class="w3-row w3-padding-64">
        <div class="w3-twothird w3-container">
            <h1 class="w3-text-teal">Sécurité</h1>
            <p>Le clapotis de l’eau au contact de la coque et la caresse du vent du large ne sont que quelques-uns des nombreux plaisirs associés à la navigation de plaisance. Aussi agréable soit-elle, la pratique d’une activité nautique nécessite un minimum de sérieux et de préparation afin que chaque sortie sur l’eau soit couronnée de succès.
            </p>
            <p>Allez vérifier si vous avez tout l'équipement obligatoire sur votre embarcation. N'oubliez pas, c'est une amende de 250$ par pièce d'équipement manquante.

                L’opérateur d’une embarcation de plaisance se doit d’effectuer un entretien périodique de tout son équipement nautique de façon à ce que tout fonctionne adéquatement réduisant ainsi la probabilité de défaillance.</p>
        </div>
        <div class="w3-third w3-container">
            <img class="w3-border w3-padding-32 w3-center" src="../img/secu.jpg">
        </div>
    </div>
    <div class="w3-row w3-padding-64 w3-margin-bottom">
        <div class="w3-twothird w3-container">
            <h1 class="w3-text-teal">En savoir plus:</h1>
            <br><a href = "https://www.tc.gc.ca/media/documents/securitemaritime/TP-511f.pdf">Guide de sécurité nautique</a>, contenant tout ce qu'il faut avoir sur la voile</br>
            <a href = "https://www.sportsexperts.ca/fr-CA/plein-air/equipements/nautique/vfi-veste-flottaison-individuel">Fournitures</a>, disponibles sur Sports Experts</br>
            <a href = "https://www.tc.gc.ca/fra/quebec/securitemaritime-plaisance-2061.htm">Conseils</a>, du gouvernement Canadien</br>
            </p>
        </div>
    </div>


</div>

    <footer id="myFooter">
        <div class="w3-container w3-theme-l2 w3-padding-25" >
            <h4>La Marina de Matane, un espace de détente fort en couleurs!</h4>
        </div>
    </footer>

    <!-- END MAIN -->
</div>

<script>
    // Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
            overlayBg.style.display = "none";
        } else {
            mySidebar.style.display = 'block';
            overlayBg.style.display = "block";
        }
    }

    // Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
        overlayBg.style.display = "none";
    }
</script>

</body>
</html>
