let specialis = "?!.%+-=";
let pwd;
let pwdc;
$(document).ready(function(){
    //name=password/confirm
    //check password
    $("[name=password]").focusout(function(){
        //$("#pwdError").text(''); Érdekes hibát ír ki.
	let pwdError = "";	
	pwd = $(this).val();
	pwd = pwd.trim();
	if (pwd.length < 8){
	    pwdError += "Túl rövid!";
	}
	pwdError += vanESpecialis() ? "" : "Nem tartalmaz speciális karaktert!";	
	$("#pwdError").text(pwdError);
    }); // password
    
    //check cofirm
    $('[name=confirm]').focusout(function(){
	let pwdErrorer="";
	let pwdc = $(this).val();
	if (pwd !== pwdc){
	pwdErrorer = "A kettő jelszó nem egyezik!" ;   
        $("#pwdcError").text(pwdErrorer);
	}
       
        
    });
}); //READY

 

function vanESpecialis(){
    let betu;
    for (let i=0; i < pwd.length; i++){
	betu = pwd.charAt(i);
	if (specialis.includes(betu)) {
	    return true;
	}
    }
    return false;
}







    
    
    
    
    
    
    
    


























































