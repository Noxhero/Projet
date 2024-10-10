<head>
    <link rel="stylesheet" href="../../css/style.css">
    <script href="../../js/jquery.min.js"></script>
</head><header>
    <div class="dropdown">
        <button class="dropbtn">Pages</button>
        <div class="dropdown-content">
            <a href="../../pages/calendrier/calendrier.php">calendrier</a>
            <a href="../../pages/cavalerie/cavalerie.php">cavalerie</a>
            <a href="../../pages/cavalier/cavalier.php">cavalier</a>
            <a href="../../pages/commune/commune.php">commune</a>
            <a href="../../pages/cours/cours.php">cours</a>
            <a href="../../pages/evenement/evenement.php">evenement</a>
            <a href="../../pages/galop/galop.php">galop</a>
            <a href="../../pages/inserer/inserer.php">inserer</a>
            <a href="../../pages/participation/participation.php">participation</a>
            <a href="../../pages/pension/pension.php">pension</a>
            <a href="../../pages/photo/photo.php">photo</a>
            <a href="../../pages/prend/prend.php">prend</a>
            <a href="../../pages/race/race.php">race</a>
            <a href="../../pages/robe/robe.php">robe</a>
        </div>
    </div>
</header>
<?php
// bouton pages avec liens vers les pages

// inclure la connexion à la BDD
include 'bdd.inc.php';

// le script requis pour les autocomplétions

// toutes les classes
include '../../pages/calendrier/calendrier.class.php';
include '../../pages/cavalerie/cavalerie.class.php';
include '../../pages/cavalier/cavalier.class.php';
include '../../pages/commune/commune.class.php';
include '../../pages/cours/cours.class.php';
include '../../pages/evenement/evenement.class.php';
include '../../pages/galop/galop.class.php';
include '../../pages/inserer/inserer.class.php';
include '../../pages/participation/participation.class.php';
include '../../pages/pension/pension.class.php';
include '../../pages/photo/photo.class.php';
include '../../pages/prend/prend.class.php';
include '../../pages/race/race.class.php';
include '../../pages/robe/robe.class.php';
