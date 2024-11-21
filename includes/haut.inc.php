<?php
include 'bdd.inc.php';
session_start();

// Vérification de la session utilisateur
if (isset($_SESSION['user_id'])) {

    $session_idcompte = $_SESSION['user_id'];
    
    // Requête pour vérifier si l'utilisateur existe toujours
    $query = $con->prepare("SELECT COUNT(*) FROM compte WHERE idcompte = :idcompte");
    $query->bindParam(':idcompte', $session_idcompte);
    $query->execute();
    
    // Si l'utilisateur est valide, affichage du pseudo et du bouton de déconnexion
    if ($query->fetchColumn() > 0) {
        echo "Utilisateur : " . $_SESSION['user_pseudo'];
        echo"<br>";
        // Bouton de déconnexion
        echo '<form action="" method="post" style="all:unset">
                <button type="submit" name="logout">Déconnexion</button>
              </form>';

        
        
        // Si le bouton est cliqué, détruire la session
        if (isset($_POST['logout'])) {
            session_destroy(); // Détruire la session
            header('Location: ../connexion/connexion.php'); // Redirection vers la page de connexion
            exit();
        }

    } else {
        header('Location: ../connexion/connexion.php');
        exit();
    }

} else {
    header('Location: ../connexion/connexion.php');
    exit();
}
?>

<head>
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/script.js"></script>
    <!--Inclusion du Tableaudata -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <br><br>
</head><header>
    <div class="dropdown">
  &nbsp;  <img src='../../assets/images/menu.png' width="30 %"class="dropbtn"></img>
        <div class="dropdown-content">
            <a href="../../pages/calendrier/calendrier.php">calendrier</a>
            <a href="../../pages/cavalerie/cavalerie.php">cavalerie</a>
            <a href="../../pages/cavalier/cavalier.php">cavalier</a>
            <a href="../../pages/commune/commune.php">commune</a>
            <a href="../../pages/cours/cours.php">cours</a>
            <a href="../../pages/evenement/evenement.php">evenement</a>
            <a href="../../pages/galop/galop.php">galop</a>
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






//include '../../pages/calendrier/calendrier.class.php';
include '../../pages/cavalerie/cavalerie.class.php';
include '../../pages/cavalier/cavalier.class.php';
include '../../pages/commune/commune.class.php';
include '../../pages/cours/cours.class.php';
//include '../../pages/evenement/evenement.class.php';
include '../../pages/galop/galop.class.php';
include '../../pages/participation/participation.class.php';
include '../../pages/pension/pension.class.php';
//include '../../pages/photo/photo.class.php';
include '../../pages/prend/prend.class.php';
include '../../pages/race/race.class.php';
include '../../pages/robe/robe_class.php';

?>

<!-- FULL Calendar -->


