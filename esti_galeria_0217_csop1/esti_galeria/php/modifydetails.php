<?php
require_once('../config/init.php');
if (!isLogged()){
    header('Location: index.php');
}
// Kép címének módosítása
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['cim'])) &&(!empty($_POST['id']))){
    $cim = $_POST['cim'];
    $cim = mb_strlen($cim) < 65 ? $cim : mb_substr($cim, 0, 64); 
    $id = $_POST['id'];
    $sql = "UPDATE kepek SET cim = '$cim' WHERE id = '$id';";  
    $con -> query($sql);
    if ($con -> errno){
        //Van hiba
        http_response_code(503);
    }
    echo $cim;
}
// Kép leírásának módosítása
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['desc'])) &&(!empty($_POST['id']))){
    $desc = $_POST['desc'];
    $desc = mb_strlen($desc) < 1001 ? $desc : mb_substr($desc, 0, 1000);
    $id = $_POST['id'];
    $sql = "UPDATE kepek SET leiras = '$desc' WHERE id = '$id';";
    $con -> query($sql);
    if ($con -> errno){
        //Van hiba
        http_response_code(503);
    }
    echo $desc;
}
$con -> close();