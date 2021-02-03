<?php
require_once('config/init.php');

$content = "";
if (!isLogged()){
    $_SESSION['loginError'] = 'Képek megtekintéséhez először jelentkezz be!';
    header('Location: login.php');
} else {
    
    $fid = $_SESSION['fid'];
    $sql = "SELECT * FROM kepek WHERE fid = $fid";
    $res = $con -> query($sql);
    if (!$res){
        die('Hiba a lekérdezés végrehajtásában!');
    }
    $content = '<div class="card-deck">';
    while ($row = $res -> fetch_assoc()){
        
        $content .= '<div class="card">'
                . '<img class="w-100 card-image-top" src="'.$row['utvonal'].$row['fajlnev'].'">'
                . '<div class="card-body">'
                . '<h2 class="card-title">'.$row['cim'].'</h2>'
                . '<p data-azonosito="'.$row['id'].'" class="reszletek btn btn-primary">Részletek</p>'
                . '</div>'                
                . '</div>';
    }
    $content .= '</div>';
}
printHTML('html/header.html');
echo printMenu();
echo $content;
printHTML('html/footer.html');

$con -> close();