<?php

session_start();
//require_once('../config/connect.php');

if (($_SERVER['REQUEST_METHOD'] == "POST") && (!empty($_POST['delete']))) {
    
    if (isset($_SESSION['cart'])) {
	//nem üres a kosár
	$cart = $_SESSION['cart']; //segédváltozó
	$termek_id = $_POST['delete']; //termék id tárolása
        
	unset($cart[$termek_id]); //adott termék törlése a kosárból
        
	if (empty($cart)) {
	    unset($_SESSION['cart']);
	} else {
	    $_SESSION['cart'] = $cart;
	}
    } else {
	//üres a kosár
	http_response_code(503);
    }
} else {
    http_response_code(502);
}

