<?php

function dd($var) {
    var_dump($var);
    die();
}

function isLogged() {
    if (!empty($_SESSION['fid'])) {
        return true;
    } else {
        return false;
    }
}

function printHTML($path) {
    
    echo file_get_contents($path);
    
}

function printMenu() {
    
    $menu = file_get_contents('html/menu.html');
    
    if (isLogged()) {
        
        $menu = str_replace('::ki_belepes', '<li class="nav-item">  <a class="nav-link text-light" href="upload.php">Feltöltés</a></li>'
                . '<li class="nav-item">  <a class="nav-link text-light" href="logout.php">Kilép</a> </li>', $menu);
    } else {
        $menu = str_replace('::ki_belepes', '<li class="nav-item">  <a class="nav-link text-light" href="reg.php">Regisztráció</a> </li>'
                . '<li class="nav-item">  <a class="nav-link text-light" href="login.php">Belép</a> </li>', $menu);
    }
    return $menu;
}
