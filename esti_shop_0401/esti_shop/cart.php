<?php

session_start();

require_once('config/connect.php');
require_once('config/functions.php');


$sql = "SELECT nev, ar from products WHERE id = ?;";

$stmt = $con->prepare($sql);


if (isset($_SESSION['cart'])) {
    //var_dump($_SESSION['cart']);
    
    $cart = $_SESSION['cart'];
    
    $output = '<div class="container">';
    $output .= '<table class="container-fluid table-striped">'
	    . '<tr>'
	    . '<th>Megnevezés</th>'
	    . '<th>Egységár</th>'
	    . '<th>Mennyiség</th>'
	    . '<th>Összesen</th>'
	    . '<th>Művelet</th>'
	    . '</tr>';
    //array
    foreach ($cart as $termek_id => $termek_darabszama) {
        
       	$stmt->bind_param('i', $termek_id);
	$stmt->execute();
        $stmt->store_result();
	$stmt->bind_result($nev, $ar);
	$stmt->fetch();
	$output .= '<tr>'
		. '<td>'. $nev.'</td>'
		. '<td>' . $ar . '</td>'
		. '<td id="' . $termek_id . '"contenteditable>' . $termek_darabszama . '</td>'
		. '<td>' . $ar * $termek_darabszama . '</td>'
		. '<td>'
                . '<span data-id="' . $termek_id . '" class="mr-3 modify btn btn-outline-success">&#128190;</span>' 
                . '<span data-id="' . $termek_id . '" class="mr-3 delete-product btn btn-outline-danger">&#128465;</span>'
                . '</td>'
		. '</tr>';
	//&#128190;
    }
    $output .= '</table>'
            
	    . '<span style="margin:80px 50px 0 0" class="order btn btn-success">Rendelés elküldése</span>'
	    . '<a style="margin:20px 0 0 50px" class="btn btn-danger" href="php/emptycart.php">Kosár ürítése</a>'
            
            
	    . '<p class="mt-4"><label>Kérem válasszon alábbi fizetési módok közül!</label></p>'
            
	    . '<select id="payment" class="form-control">'
            
	    . '<option value="0">Fizetési mód</option>'
	    . '<option value="cash">Utánvét</option>'
	    . '<option value="paypal">Paypal</option>'
	    . '<option value="card">Bankkártya</option>'
            
	    . '</select>';
} else {
    $output = '<h3 class="text-warning">Üres a kosár!</h3>';
}
echo file_get_contents("html/header.html");

menu();

if (!empty($_SESSION['error'])) {
     echo "<h2 class='text-danger text-center'> {$_SESSION['error']} </h2>";
    unset($_SESSION['error']);
}
echo $output . '</div>';

echo file_get_contents("html/footer.html");
$con->close();
