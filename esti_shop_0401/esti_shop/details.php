<?php

session_start(); //munkamenet követése miatt

require_once('config/connect.php'); //adatbázishoz csatlakozunk
echo file_get_contents("html/header.html");

if (isset($_SESSION['user']) && (!empty($_SESSION['user']))) {
    //Valaki be van jelentkezve
    echo file_get_contents("html/menu_in.html");
    echo "<h2>Üdvözöllek kedves ".$_SESSION['user'][1]."!</h2>";
} else {
    //senki nincs bejelentkezve
    echo file_get_contents("html/menu_out.html");
}
if (empty($_GET['pid'])) {
    echo "A keresett termék nem létezik!";
} else {
    $pid = $_GET['pid'];

    
    $sql = "SELECT * FROM products WHERE id=?;"; // query string

    $stmt = $con->prepare($sql);

    $stmt->bind_param('i', $pid);
    $stmt->execute();
    $stmt->store_result();      
    $stmt->bind_result($termek_id, $nev, $ar, $mennyiseg, $leiras);
    $stmt->fetch();
    
    
    echo $nev;
    echo '<br>';
    echo $ar;
    echo '<br>';
    echo $mennyiseg." ". 'db';
    echo '<br>';
    echo $leiras;
    
    
    $stmt->close();
}



$con->close();
echo file_get_contents("html/footer.html");

