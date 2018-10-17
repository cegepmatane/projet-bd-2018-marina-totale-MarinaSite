<!DOCTYPE html>
<html style="height:100%;">
<title>Traversée du St-Laurent</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
            <h1 class="w3-text-teal">Traversée du St-Laurent</h1>
            <p>N'hésitez plus entre la Gaspésie et la Côte-Nord; le NM F.-A.-Gauthier  vous transporte en tout confort d'une rive à l'autre sur le majestueux Saint-Laurent!

                Vivez cette petite croisière sur le fleuve et profitez du tarif excursion (aller-retour le même jour) qui vous est offert à un prix avantageux.
            </p>
            <p>
                À découvrir : le bistro gourmand, les ponts extérieurs aménagés, les salons panoramiques avec vue sur le fleuve, la boutique, la salle de jeux pour enfants et beaucoup plus. Apprenez-en davantage sur <a href="https://www.traversiers.com/fr/nos-traverses/traverse-matane-baie-comeau-godbout/services/">les services offerts à bord.</a>

                Cet été, profitez de la promo excursion et économisez! <a href="https://www.traversiers.com/fr/nos-traverses/traverse-matane-baie-comeau-godbout/promo-excursion/">Pour plus de détails.<a>
            </p>
        </div>
        <div class="w3-third w3-container">
            <img class="w3-border w3-padding-32 w3-center" src="../img/bato.png">
        </div>
    </div>
    <div class="w3-row w3-padding-64 w3-margin-bottom">
        <div class="w3-twothird w3-container">
            <h1 class="w3-text-teal">Informations complémentaires:</h1>
            <p><b>Réservations :</b> Une réservation est recommandée pour les conducteurs de véhicule et les groupes de 15 personnes ou plus.</br>
            <b>En service :</b> toute l'année</br>
            <b>Durée de la traversée et distance parcourue :</b> </br>Matane – Godbout : 2 h 10 (55,3 km)</br>Matane – Baie-Comeau : 2 h 20 (62,1 km)
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
