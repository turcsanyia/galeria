<?php

function isLogged(){
    if (isset($_SESSION['user']) && (!empty($_SESSION['user']))) {
        //Valaki be van jelentkezve
        return true;
    } else { 
        return false; //senki nincs bejelentkezve
    }
}



function menu(){
    if (isLogged()){
     echo file_get_contents("html/menu_in.html");
     echo "<h2>Üdvözöllek kedves " . $_SESSION['user'][1] . "!</h2>";
     
    } else {
        echo file_get_contents("html/menu_out.html");
    }
}





