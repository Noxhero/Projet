<?php
//commune
include './bdd.inc.php';
if(isset($_POST['keyword'])){
$keyword = '%'.$_POST['keyword'].'%';

$sql = "SELECT idcommune, ville, codepostal FROM commune WHERE afficher = true AND ville LIKE (:var) OR codepostal LIKE (:var) ORDER BY ville ASC LIMIT 0, 10";

$req = $con->prepare($sql);

$req->bindParam(':var', $keyword, PDO::PARAM_STR);

$req->execute();

$list = $req->fetchAll();

foreach ($list as $res) {

    //  affichage

    $Listecommune = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['ville'].' '.$res['codepostal']);

    // sélection

    echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['ville']).'\',\''
                                       .str_replace("'", "\'", $res['codepostal']).'\',\''
                                       .str_replace("'", "\'", $res['idcommune']) .'\')">'
        .$Listecommune.'</li>';
}}
//commune de la modification

if(isset($_POST['keyword21'])){
$keyword21 = '%'.$_POST['keyword21'].'%';

$sql = "SELECT idcommune, ville, codepostal FROM commune WHERE ville LIKE (:var) OR codepostal LIKE (:var) AND afficher = true ORDER BY ville ASC LIMIT 0, 10";

$req = $con->prepare($sql);

$req->bindParam(':var', $keyword21, PDO::PARAM_STR);

$req->execute();

$list = $req->fetchAll();

foreach ($list as $res) {

    //  affichage

    $Listecommune21 = str_replace($_POST['keyword21'], '<b>'.$_POST['keyword21'].'</b>', $res['ville'].' '.$res['codepostal']);

    // sélection

    echo '<li onclick="set_item21(\''.str_replace("'", "\'", $res['ville']).'\',\''
                                       .str_replace("'", "\'", $res['codepostal']).'\',\''
                                       .str_replace("'", "\'", $res['idcommune']) .'\',\''
                                       .$_POST['cavalier_id'].'\')">'
        .$Listecommune21.'</li>';
}
}

if(isset($_POST['keyword2'])){
//Galop
$keyword2 = '%'.$_POST['keyword2'].'%';
    
$sql = "SELECT idgalop, libgalop FROM galop WHERE libgalop LIKE (:var) ORDER BY libgalop ASC LIMIT 0, 10";

$req = $con->prepare($sql);

$req->bindParam(':var', $keyword2, PDO::PARAM_STR);

$req->execute();

$list = $req->fetchAll();

foreach ($list as $res) {

    //  affichage

    $Listegalop = str_replace($_POST['keyword2'], '<b>', $res['libgalop']);

    // sélection

    echo '<li onclick="set_item2(\''.str_replace("'", "\'", $res['libgalop']).'\',\''
                                       .str_replace("'", "\'", $res['idgalop']) .'\')">'
        .$Listegalop.'</li>';
}

}
//Galop de la modification
if(isset($_POST['keyword22'])){
    
    $keyword22 = '%'.$_POST['keyword22'].'%';
        
    $sql = "SELECT idgalop, libgalop FROM galop WHERE libgalop LIKE (:var) ORDER BY libgalop ASC LIMIT 0, 10";
    
    $req = $con->prepare($sql);
    
    $req->bindParam(':var', $keyword22, PDO::PARAM_STR);
    
    $req->execute();
    
    $list = $req->fetchAll();
    
    foreach ($list as $res) {
    
        //  affichage
    
        $Listegalop22 = str_replace($_POST['keyword22'], '<b>', $res['libgalop']);
    
        // sélection
    
        echo '<li onclick="set_item22(\''.str_replace("'", "\'", $res['libgalop']).'\',\''
                                           .str_replace("'", "\'", $res['idgalop']) .'\',\''
                                           .$_POST['cavalier_id'].'\')">'
            .$Listegalop22.'</li>';
    }
    
    }
//robe
if(isset($_POST['keyword3'])){
    $keyword3 = '%'.$_POST['keyword3'].'%';
    
    $sql = "SELECT idrobe, librobe FROM robe WHERE librobe LIKE (:var) AND afficher = true ORDER BY librobe ASC LIMIT 0, 10";
    
    $req = $con->prepare($sql);
    
    $req->bindParam(':var', $keyword3, PDO::PARAM_STR);
    
    $req->execute();
    
    $list = $req->fetchAll();
    
    foreach ($list as $res) {
    
        //  affichage
    
        $Listerobe= str_replace($_POST['keyword3'], '<b>', $res['librobe']);
    
        // sélection
    
        echo '<li onclick="set_item3(\''.str_replace("'", "\'", $res['librobe']).'\',\''
        .str_replace("'", "\'", $res['idrobe']) .'\')">'
        .$Listerobe.'</li>';
    }
    }

//race 

if(isset($_POST['keyword4'])){
    $keyword4 = '%'.$_POST['keyword4'].'%';
    
    $sql = "SELECT idrace, librace FROM race WHERE librace LIKE (:var) AND afficher = true ORDER BY librace ASC LIMIT 0, 10";
    
    $req = $con->prepare($sql);
    
    $req->bindParam(':var', $keyword4, PDO::PARAM_STR);
    
    $req->execute();
    
    $list = $req->fetchAll();
    
    foreach ($list as $res) {
    
        //  affichage
    
        $Listerace= str_replace($_POST['keyword4'], '<b>', $res['librace']);
    
        // sélection
    
        echo '<li onclick="set_item4(\''.str_replace("'", "\'", $res['librace']).'\',\''
        .str_replace("'", "\'", $res['idrace']) .'\')">'
        .$Listerace.'</li>';
    }
    }

// Modifier la partie recherche de chevaux
if(isset($_POST['keyword']) && isset($_POST['type']) && $_POST['type'] === 'cheval') {
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

//cours 

if(isset($_POST['keyword']) && isset($_POST['type']) && $_POST['type'] === 'cours') {
    $keyword = '%'.$_POST['keyword'].'%';
    
    $sql = "SELECT  idcours, libcours FROM cours 
            WHERE libcours LIKE :var 
            AND afficher = true 
            ORDER BY libcours ASC LIMIT 0, 10";
    
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();
    
    while($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $nomCours = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libcours']);
        
        echo '<li onclick="set_item_cours(\''.str_replace("'", "\'", $res['libcours']).'\',\''
            .str_replace("'", "\'", $res['idcours']) .'\''
            .')">'
            .$nomCours.'</li>';
    }
}

// Pour les cours en mode modification
if(isset($_POST['keyword21']) && isset($_POST['type']) && $_POST['type'] === 'cours') {
    $keyword = '%'.$_POST['keyword21'].'%';
    
    $sql = "SELECT idcours, libcours FROM cours 
            WHERE libcours LIKE :var 
            AND afficher = true 
            ORDER BY libcours ASC LIMIT 0, 10";
    
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();
    
    while($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $nomCours = str_replace($_POST['keyword21'], '<b>'.$_POST['keyword21'].'</b>', $res['libcours']);
        
        echo '<li onclick="set_item_cours21(\''
            .str_replace("'", "\'", $res['libcours']).'\',\''
            .str_replace("'", "\'", $res['idcours']).'\',\''
            .$_POST['row_id'].'\')">'
            .$nomCours.'</li>';
    }
}

// Pour les cavaliers en mode modification
if(isset($_POST['keyword22']) && isset($_POST['type']) && $_POST['type'] === 'cavalier') {
    $keyword = '%'.$_POST['keyword22'].'%';
    
    $sql = "SELECT idcavalier, nomcavalier FROM cavalier 
            WHERE nomcavalier LIKE :var 
            AND afficher = true 
            ORDER BY nomcavalier ASC LIMIT 0, 10";
    
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();
    
    while($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $nomCavalier = str_replace($_POST['keyword22'], '<b>'.$_POST['keyword22'].'</b>', $res['nomcavalier']);
        
        echo '<li onclick="set_item_cavalier22(\''
            .str_replace("'", "\'", $res['nomcavalier']).'\',\''
            .str_replace("'", "\'", $res['idcavalier']).'\',\''
            .$_POST['row_id'].'\')">'
            .$nomCavalier.'</li>';
    }
}

?>
