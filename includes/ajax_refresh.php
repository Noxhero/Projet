<?php
include './bdd.inc.php';
// Pour l'autocomplétion des communes
if(isset($_POST['type']) && $_POST['type'] == 'commune') {
    $keyword = '%'.$_POST['keyword'].'%';

    $sql = "SELECT idcommune, ville, codepostal FROM commune
            WHERE ville LIKE :var OR codepostal LIKE :var
            AND afficher = true
            ORDER BY ville ASC LIMIT 0, 10";

    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    while($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $Listecommune = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['ville'].' '.$res['codepostal']);
        echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['ville']).'\',\''.str_replace("'", "\'", $res['codepostal']).'\',\''.str_replace("'", "\'", $res['idcommune']).'\')">'.$Listecommune.'</li>';
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
    $keyword = $_POST['keyword'];
    
    $sql = "SELECT numsire, nomcheval 
            FROM cavalerie 
            WHERE nomcheval LIKE :keyword 
            AND afficher = true 
            ORDER BY nomcheval ASC";
    
    $stmt = $con->prepare($sql);
    $stmt->execute([':keyword' => '%'.$keyword.'%']);
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $nomCheval = str_replace($keyword, '<b>'.$keyword.'</b>', $row['nomcheval']);
        echo '<li onclick="set_item_cheval(\''
            .str_replace("'", "\'", $row['nomcheval']).'\', \''
            .str_replace("'", "\'", $row['numsire']).'\')">'
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
// Pour l'autocomplétion des galops
elseif(isset($_POST['type']) && $_POST['type'] === 'galop') {
    $keyword = '%'.$_POST['keyword'].'%';

    $sql = "SELECT idgalop, libgalop FROM galop
            WHERE libgalop LIKE :var
            AND afficher = true
            ORDER BY libgalop ASC LIMIT 0, 10";

    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    while($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $libGalop = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libgalop']);
        echo '<li onclick="set_item2(\''
            .str_replace("'", "\'", $res['libgalop']).'\',\''
            .str_replace("'", "\'", $res['idgalop']).'\')">'
            .$libGalop.'</li>';
    }
}


// Pour l'autocomplétion des galops en modification
elseif(isset($_POST['keyword22'])) {
    $keyword = '%'.$_POST['keyword22'].'%';
    $cavalier_id = $_POST['cavalier_id'];
    
    $sql = "SELECT idgalop, libgalop FROM galop 
            WHERE libgalop LIKE :var 
            AND afficher = true 
            ORDER BY libgalop ASC LIMIT 0, 10";
    
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();
    
    while($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $libGalop = str_replace($_POST['keyword22'], '<b>'.$_POST['keyword22'].'</b>', $res['libgalop']);
        echo '<li onclick="set_item22(\''
            .str_replace("'", "\'", $res['libgalop']).'\',\''
            .str_replace("'", "\'", $res['idgalop']).'\',\''
            .$cavalier_id.'\')">'
            .$libGalop.'</li>';
    }
}
// Pour l'autocomplétion des robes
elseif (isset($_POST['type']) && $_POST['type'] == 'robe') {
    $keyword = '%'.$_POST['keyword'].'%';

    $sql = "SELECT idrobe, librobe FROM robe
            WHERE librobe LIKE :var
            AND afficher = true
            ORDER BY librobe ASC LIMIT 0, 10";

    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    while($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $libRobe = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['librobe']);
        echo '<li onclick="set_item3(\''
            .str_replace("'", "\'", $res['librobe']).'\',\''
            .str_replace("'", "\'", $res['idrobe']).'\')">'
            .$libRobe.'</li>';
    }
}

// Pour l'autocomplétion des races
elseif (isset($_POST['type']) && $_POST['type'] == 'race') {
    $keyword = '%'.$_POST['keyword'].'%';

    $sql = "SELECT idrace, libRace FROM race
            WHERE libRace LIKE :var
            AND afficher = true
            ORDER BY libRace ASC LIMIT 0, 10";

    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    while($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $libRace = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libRace']);
        echo '<li onclick="set_item4(\''
            .str_replace("'", "\'", $res['libRace']).'\',\''
            .str_replace("'", "\'", $res['idrace']).'\')">'
            .$libRace.'</li>';
    }
}


?>