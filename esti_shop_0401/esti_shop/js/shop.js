$(document).ready(function () {

    //kosárhoz ad
    $('.addcart').click(function () {
	let id = $(this).data('id');
	//console.log(id);
        
	$.ajax({
	    url: 'php/addtocart.php',
	    method: 'POST',
	    data: {id: id},
	    success: function () {
		alert("Kosárhoz adva.");
	    },
	    error: function () {
		alert("Nem sikerült a kosárhoz adni!"); 
                //Összességében elmondható, hogy egyenlőre ezt memóriaszinten tárolja és utána rajzolja ki a cart felületre!
	    }
	});
    });//VÉGE kosárhoz ad

    //termék törlése a kosárból
    $(document).on('click','.delete-product',function(){            
	let id = $('.delete-product').data('id');
	//console.log("katt",id);
	$.ajax({
	    url: 'php/deleteproduct.php',
	    method: 'POST',
	    data: {delete: id},
	    success: function () {
		//oldal frissítése
		window.location.reload();
	    },
	    error: function () {
		alert("Hiba a termék törlésekor!");
	    }
	});

    });//termék törlése


    //mennyiség módosítása
    $('.modify').click(function () {
	let dataId = $(this).data('id'); // <button>  termék id-je a db-ből, pl. táska: 8
        // a tr-nek van data-id-je
        
        console.log(dataId);
        
	let value = $('#' + dataId).text();
        // let value = $('#8').text();
        
        if (isNaN(value)) {
	    alert('Ide csak számot írhat!');
	} else {
	    value = Math.ceil(value); // egész számra kerekítés (felfelé)
	    $.ajax({
		url: 'php/valuemodification.php',
		method: 'POST',
		data: {id: dataId, value: value},
		success: function (adat) {
                     
		    //frissítjük az adatokat
		    window.location.reload();
		},
		error: function () {
		    alert("A módosítása nem sikerült");
		}
	    });
	}
    }); //VÉGE mennyiség módosítása
    
    //rendelés gomb katív/inaktív
    $(".order").addClass("disabled"); //Először csak inaktív!
    
    $("#payment").change(function(){ //Aztán aktivizálom!
	if ($('#payment option:selected').val() == 0){
            
	    $(".order").addClass('disabled');
            
	} else {
            
	    $('.order').removeClass('disabled');
	}
    }); //Vége rendelés aktív/inaktív
    
    //megrendelés
    $(".order").click(function(){ 
        let paymentMethod=$("#payment option:selected").val();
	//console.log('pay',paymentMethod);
	//payVal = $('#payment').val(); //EZ IS HASZNÁLHATÓ
	//console.log('pay',payVal);
	
        $.ajax({
            url: 'php/order.php',
            method: 'POST',
            data:{pay : paymentMethod},
            success: function (){
		alert("Rendelése rögzítésre került.");
		window.location.reload();
            },
            error: function(){
                alert("Hiba a rendelés elküldésénél");
            }
        });
	
    }); //VÉGE megrendelés
    
});//ready


