<?php

session_start(); //munkamenet követése miatt

require_once('config/connect.php'); //adatbázishoz csatlakozunk
echo file_get_contents("html/header.html");

if (isset($_SESSION['user']) && (!empty($_SESSION['user']))) {
    //Valaki be van jelentkezve
    
    echo file_get_contents("html/menu_in.html");
} else {
    //senki nincs bejelentkezve
    //header("Location: index.php");
    echo file_get_contents("html/menu_out.html");
}


if (!empty($_SESSION['error'])){
    echo '<h3 class="text-danger text-center"> '.$_SESSION['error'].'</h3>';
    unset($_SESSION['error']);
    
}

$sql = "SELECT * FROM products";
$res = $con -> query($sql);
$products = '';
if (!$res){
    echo 'Hiba a lekérdezés végrehajtásakor!';
} else {
    $products .= '<div class="container card-columns">';
    while ($row = $res -> fetch_assoc()){
        //var_dump($row['id']);
        $products .= '<div class="card">'
                . '<img  class="card-image-top" src="images/no-image.jpg" style="width: 100%">'
                . '<div class="card-body">'
                    . '<h4 class="card-title">'.$row['nev'].'</h4>'
                    . '<p class="card-text">'.$row['ar'].' Ft</p>'
                    . '<a class="btn btn-outline-success" href="details.php?pid='.$row['id'].'">Részletek</a>&emsp;'
                    . '<button data-id="'. $row['id'].'" class="addcart btn btn-success">Kosárba</button>'
                . '</div>'
                . '</div>';
    }
    $products .= '</div>';
}

echo $products;
echo file_get_contents("html/footer.html");
$con->close();

