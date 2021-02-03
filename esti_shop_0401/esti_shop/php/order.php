<?php

session_start();
require_once('../config/connect.php');
require_once('../config/functions.php');

if (!isLogged()) {
    // Jelentkezzen be!
    $_SESSION['error'] = "A rendelés feladáshoz jelentkezzen be!";
    header("Location: ../login.php");
}

$user = $_SESSION['user']; // kétdimenziós egy tömb (nem asszoc.)

if (empty($_SESSION['cart'])) {
    //Üres a kosár!
    $_SESSION['error'] = "A rendelés feladáshoz legalább 1 terméket tegyen a kosárba!";
    header("Location: ../products.php");
}

$cart = $_SESSION['cart'];

if (empty($_POST['pay'])) {
   echo $_SESSION['error'] .= "A fizetési mód nem volt kiválasztva!";
    //$_SESSION['error'] = $_POST['pay'];
    header("Location: ../cart.php");
}

$pay = $_POST['pay'];

$con->autocommit(FALSE);
//1. Lépés: 1 új rekord beszúrása a megrendelés táblába
//2. Lépés: keletkezik egy megrendelés id, ezt ki kell olvasnom
//3. Lépés: megrendelés id-vel tételeket rögzítem a tetelek táblában, annyiszor, ahány termék szerepel a kosárban
// 4. Lépés: $con->commit();
// Ha bárhol hiba történik, akkor $con->rollback();

$sql = "INSERT INTO megrendeles (vasarlo_id, fizetesi_mod) VALUES ('$user[0]','$pay')";
$con->query($sql);


$rendelesId = null;

if (!($rendelesId = $con->insert_id)) {
    $con->rollback();
   // $_SESSION['error'] = "A megrendelést nem sikerült rögzíteni!";
   http_response_code(501);
}
//termek_id, mennyiseg, ar, megrendeles_id

$sql = "INSERT INTO tetelek (megrendeles_id, termek_id, nev, ar, mennyiseg) VALUES (?,?,?,?,?);";
$stmt = $con->prepare($sql);

if (!$stmt) {
    $stmt->close();
    $con->close();
    $_SESSION['error'] = "Adatbázis hiba!";
    header("Location: ../cart.php");
}
//kosár bejárása
// alternatív mód a kulcsok megszerzésére array_keys()

foreach ($cart as $termek_id => $termek_darabszama) {
    $res = $con->query("SELECT ar FROM products WHERE id = '$termek_id'");
    if (!$res) {
        //hiba
    }
    $row = $res->fetch_array();
    $price = $row[2];
    $nev = $row[1];
    $stmt->bind_param('iiii', $rendelesId, $termek_id, $nev, $price, $termek_darabszama );
    $stmt->execute();
    if ($stmt->errno == 0) {
        $con->commit();
    } else {
        $con->rollback();
    }
}
unset($_SESSION['cart']);

$con->close();
