<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['id']) && (isset($_POST['value'])))) {
    
    $termek_id = $_POST['id'];
    $termek_darabszama = $_POST['value'];
    
    if ($termek_darabszama == 0){ 
        
	if (isset($_SESSION['cart'][$termek_id])) {
            
	    unset($_SESSION['cart'][$termek_id]);
            
	    if (empty($_SESSION['cart'])){
		unset($_SESSION['cart']);
	    }
            
	}else{
            
            
        }
        
        
    } else {
        
	if (isset($_SESSION['cart'][$termek_id])) {
	    //ez a termék már megtalálható a kosárban
	    $_SESSION['cart'][$termek_id] = $termek_darabszama;
            
	}else{
            
                        
            
        }
        
        
    }
    
    
   } else{
    http_response_code(501);
   }


    
