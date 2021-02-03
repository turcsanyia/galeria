<?php

session_start();
$regError = "";
require_once('config/connect.php');

$sql = "INSERT INTO user (email, password, name, address , active) VALUES (?, ?, ?, ?, 1);";
$stmt = $con -> prepare($sql);


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm']) && !empty($_POST['name']) && !empty($_POST['address'])) {
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $pwdc = $_POST['confirm'];
        $user = $_POST['name'];
        $address = $_POST['address'];
        $regError .= ($pwd != $pwdc) ? "A két jelszó nem egyezik meg!" : "";
        $regError .= (strlen($pwd) < 8) ? "Túl rövid a jelszó!" : "";
        if ($regError == ""){
            
            
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $stmt -> bind_param("ssss", $email, $pwd, $user, $address);
            $stmt -> execute();
            
        }
    }
}
$stmt -> close();
$con -> close();


echo file_get_contents('html/header.html');
echo file_get_contents('html/reg_form.html');
echo file_get_contents('html/footer.html');
































 



