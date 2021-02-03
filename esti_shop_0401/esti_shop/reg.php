<?php
session_start();
require_once('config/connect.php');
require_once('config/functions.php');

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (!empty($_POST['email']) && (!empty($_POST['password']))){
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        
        $stmt = $con -> prepare("INSERT INTO user (email, password, name, address) VALUES (?, ?, ?, ?);");
        $stmt -> bind_param("ssss", $email, $pwd, $name, $address);
        if ($stmt -> execute()){
            header("Location: index.php");
        }   else {
            $_SESSION['error'] = "Helytelen adatok!";
        }
        $stmt -> close();
        $con -> close();
    }
}


echo file_get_contents("html/header.html");
menu();
echo file_get_contents("html/reg_form.html");

if (!empty($_SESSION['error'])){
    echo "<h2>".$_SESSION['error']."</h2>";
    unset($_SESSION['error']);
}
echo file_get_contents("html/footer.html"); 
