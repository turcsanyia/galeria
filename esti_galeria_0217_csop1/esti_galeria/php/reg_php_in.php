<?php

if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['email'])) && (!empty($_POST['pwd']))) {
    //itt történik a regisztráció feldolgozása
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwdc = $_POST['pwdc'];
    if ($pwd != $pwdc) {
        http_response_code(400);
    }

    


    $sql = "INSERT INTO felhasznalo (email, jelszo) VALUES (?, ?)";

     // INSERT INTO felhasznalo (email, jelszo) VALUES ('jlmg@gmail.com', '12345')


    $fid = null;
    try {
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $email, $pwd);
        $stmt->execute();
        $fid = $stmt->insert_id; //beillesztett rekord id-jának lekérdezése
    } catch (Exception $exc) {
        echo $exc;
    }
    $_SESSION['fid'] = $fid; //be is léptetjük a felhasználót

    $stmt->close();
    $con->close();
} 
