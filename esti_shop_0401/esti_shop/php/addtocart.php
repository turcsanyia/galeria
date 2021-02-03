<?php

session_start(); //Kell mert önmagában fut le ez a logikai php oldal és nincs behúzva a webpagephp-ra! Ajax esetén!



if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['id']))) {
    //van ajax kérés
    if (!isset($_SESSION['cart'])) {
        //üres a kosár
        $_SESSION['cart'] = array();
    }

    $termek_id = $_POST['id'];

    if (isset($_SESSION['cart'][$termek_id])) {

        //ez a termék már megtalálható a kosárban
        $_SESSION['cart'][$termek_id] += 1;
    } else {
        //ez a termék még nincs a kosárban
        $_SESSION['cart'][$termek_id] = 1;
    }
}



