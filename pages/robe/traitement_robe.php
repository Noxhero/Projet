<?php
require_once 'robe_class.php';
require_once '../../includes/bdd.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'ajouter') {
            // Ajout d'une robe
            if (isset($_POST['librove']) && !empty($_POST['librove'])) {
                $librobe = htmlspecialchars(trim($_POST['librove']));
                $robe = new Robe(null, $librobe);
                $insertedId = $robe->robe_ajout(null, $librobe);
                echo $insertedId ? "Robe ajoutée avec succès. ID: $insertedId" : "Erreur lors de l'ajout de la robe.";
            } else {
                echo "Veuillez remplir tous les champs obligatoires.";
            }
        } elseif ($_POST['action'] == 'modifier') {
            // Modification d'une robe
            if (isset($_POST['idrobe']) && isset($_POST['librove']) && !empty($_POST['librove'])) {
                $idrobe = (int)$_POST['idrobe'];
                $librobe = htmlspecialchars(trim($_POST['librove']));
                $robe = new Robe($idrobe, $librobe);
                $robe->robe_modifier($idrobe, $librobe);
            } else {
                echo "Veuillez remplir tous les champs obligatoires.";
            }
        } elseif ($_POST['action'] == 'supprimer') {
            // Suppression d'une robe
            if (isset($_POST['idrobe'])) {
                $idrobe = (int)$_POST['idrobe'];
                $robe = new Robe($idrobe, null);
                $robe->robe_supprimer($idrobe);
            } else {
                echo "ID de la robe manquant.";
            }
        }
    }
} else {
    echo "Méthode non autorisée.";
}
?>
