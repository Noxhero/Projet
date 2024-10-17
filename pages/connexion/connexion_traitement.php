<?php
include '../../includes/bdd.inc.php';
session_start();  

if (isset($_POST["email"]) && isset($_POST["mdp"])) {

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];  

    $requete = $con->prepare("SELECT * FROM compte WHERE email = :email");
    $requete->bindParam(':email', $email);
    $requete->execute();
    $user = $requete->fetch();

  
    if ($user) {
     
        if (password_verify($mdp, $user['mdp'])) {  
            $_SESSION['user_id'] = $user['idcompte'];
            $_SESSION['user_pseudo'] = $user['pseudo'];

            
            header("Location: ../cours/cours.php");
            exit();
        } 
    } else {
   
        echo "<script type='text/javascript'>
                alert('Aucun utilisateur trouvé avec cet email.');
                window.history.back();
              </script>";
    }
} else {
   
    header("Location: ../connexion.php");
    exit();
}
?>
