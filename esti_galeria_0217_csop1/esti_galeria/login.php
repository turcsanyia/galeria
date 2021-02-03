<?php

require_once('config/init.php');

if (!empty($_POST['email']) && (!empty($_POST['password']))){
    
    if (isset($_SESSION['loginError'])){
        unset($_SESSION['loginError']);
        
    }
    
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $sql = "SELECT id, email FROM felhasznalo WHERE email = ? AND jelszo = ?";
    $stmt = $con -> prepare($sql);
    $stmt -> bind_param("ss",$email, $pwd);
    $stmt -> execute();
    $stmt ->store_result();
    //dd($stmt);
    if ($stmt -> num_rows == 1){
        //belépett
        $stmt -> bind_result($id, $email);
        $stmt -> fetch();
        //dd($id);
        $_SESSION['fid'] = $id;
        header('Location: galeria.php');
    } else {
        //sikertelen a belépés
        $_SESSION['loginError'] = "Helytelen belépési adatok!";
    }
}
printHTML('html/header.html');

echo printMenu();

if (!empty($_SESSION['loginError'])){
    echo '<h3 class="text-center text-danger">'.$_SESSION['loginError'].'</h3>';
    unset($_SESSION['loginError']);
}
printHTML('html/login_form.html');
printHTML('html/footer.html');
$con -> close();

