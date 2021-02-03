<?php

session_start();
require_once('config/connect.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$pwd';";
    //echo $sql; //itt ellenőriztük a lekérdezésünk helyességét
    $res = $con->query($sql);
    //var_dump($res); //Sikeres volt-e a lekérdezés?
    
    //Ide lehetne egy eldájoltatást írni!
    
    if ($res->num_rows == 1) {
	//sikeres a bejelentkezés
	$row = $res->fetch_assoc();
	//print_r($row); //tesztelési céllal kiírtuk a felhasználó adatbázisban tárolt adatait ez részletesebb, mint a var_dump;
        
        
	$_SESSION['user'] = array($row['id'], $row['name']);
	if (isset($_SESSION['error'])) {
	    unset($_SESSION['error']);
	}
	header("Location: index.php"); //vissza a kezdőlapra
    } else {
	//sikertelen bejelentkezés
	$_SESSION['error'] = "Helytelen belépési adatok!";
	//header("Location: login.php"); //Az oldal frissítése, az esetleg belépéshez
    }
}
echo file_get_contents("html/header.html");
echo file_get_contents("html/menu_out.html");
echo file_get_contents("html/login_form.html"); //fájlból beolvassuk a login formunkat

if (isset($_SESSION['error'])) {
    echo '<h2 class="text-danger text-center">'.$_SESSION['error'].'</h2>'; //Az error kulcs létezése esetén kiírjuk a tárolt hibaüzenetet.
    unset($_SESSION['error']);
}
echo file_get_contents("html/footer.html");


