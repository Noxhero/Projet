<?php
include './bdd.inc.php';

// Pour l'autocomplétion des cours
if (isset($_POST['type']) && $_POST['type'] == 'cours') {
    // Debug
    error_log('Requête cours reçue: ' . $_POST['keyword']);
    
    $keyword = $_POST['keyword'];
    $sql = "SELECT c.idcours, c.libcours 
            FROM cours c
            WHERE c.libcours LIKE :keyword 
            AND c.afficher = true";
    $stmt = $con->prepare($sql);
    $stmt->execute([':keyword' => '%'.$keyword.'%']);
    
    // Debug
    error_log('Nombre de résultats: ' . $stmt->rowCount());
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // On vérifie si c'est pour le cours base ou associé
        $onclick = isset($_POST['for']) && $_POST['for'] == 'associe' 
            ? "set_item_cours_associe"
            : "set_item_cours_base";
            
        echo '<li onclick="'.$onclick.'(\''.$row['libcours'].'\', '.$row['idcours'].')">'
            .$row['libcours'].'</li>';
    }
}

// Pour l'autocomplétion des cavaliers
elseif (isset($_POST['type']) && $_POST['type'] == 'cavalier') {
    $keyword = $_POST['keyword'];
    $sql = "SELECT idcavalier, nomcavalier, prenomcavalier FROM cavalier 
            WHERE (nomcavalier LIKE :keyword OR prenomcavalier LIKE :keyword) 
            AND afficher = true";
    $stmt = $con->prepare($sql);
    $stmt->execute([':keyword' => '%'.$keyword.'%']);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $nom_complet = $row['nomcavalier'] . ' ' . $row['prenomcavalier'];
        echo '<li onclick="set_item_cavalier(\''.$nom_complet.'\', '.$row['idcavalier'].')">'.$nom_complet.'</li>';
    }
}

// Pour l'autocomplétion des chevaux
elseif(isset($_POST['type']) && $_POST['type'] === 'cheval') {
    $keyword = '%'.$_POST['keyword'].'%';
    
    $sql = "SELECT numsire, nomcheval FROM cavalerie 
            WHERE nomcheval LIKE :var 
            AND afficher = true 
            ORDER BY nomcheval ASC LIMIT 0, 10";
    
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();
    
    while($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $nomCheval = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['nomcheval']);
        
        echo '<li onclick="set_item_cheval(\''.str_replace("'", "\'", $res['nomcheval']).'\',\''
            .str_replace("'", "\'", $res['numsire']) .'\''
            .(!empty($_POST['pension_id']) ? ',\''.$_POST['pension_id'].'\'' : '')
            .')">'
            .$nomCheval.'</li>';
    }
}

//commune
elseif(isset($_POST['keyword']) && !isset($_POST['type'])){
    $keyword = '%'.$_POST['keyword'].'%';
    
    $sql = "SELECT idcommune, ville, codepostal FROM commune WHERE ville LIKE (:var) OR codepostal LIKE (:var) AND afficher = true ORDER BY ville ASC LIMIT 0, 10";
    
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();
    
    $list = $req->fetchAll();
    
    foreach ($list as $res) {
        $Listecommune = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['ville'].' '.$res['codepostal']);
        echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['ville']).'\',\''
                                           .str_replace("'", "\'", $res['codepostal']).'\',\''
                                           .str_replace("'", "\'", $res['idcommune']) .'\')">'
            .$Listecommune.'</li>';
    }
}

// Le reste de votre code pour les autres autocompletions...
// (commune modification, galop, robe, race, etc.)

?>