<?php
//commune
include './bdd.inc.php';
if(isset($_POST['keyword'])){
$keyword = '%'.$_POST['keyword'].'%';

$sql = "SELECT idcommune, ville, codepostal FROM commune WHERE ville LIKE (:var) OR codepostal LIKE (:var) ORDER BY ville ASC LIMIT 0, 10";

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

?>
