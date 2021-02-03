$(document).ready(function () {
    
    $(document).on('change', '[name=continent]', function () {
        let value = $('[name=continent').val();
        let hely = "index.php?continent=" + value;
      window.location.replace(hely); 

    });

    /*$("[name=continent]").change(function(){ // A gomb megtalálása és az esemény meghatározása!
     let v = $(this).val(); //select value értékének kiolvasása.
     let loc = "index.php?continent=" + v; //url előállítása
     window.location.replace(loc); //átírányít
     });*/

});

