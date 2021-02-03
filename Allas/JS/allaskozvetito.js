$(document).ready(function () {

    //form alapértelmezett működésének megakadályozása
    $('#login-form').on('submit', function (e) {
        //console.log("Kattintottál");
        e.preventDefault();
    });

    //betöltéskor az állások megjelenítése 
    $('#jobs').ready(function(){
        $.get("php/betolt.php", {keyword:""}, function (valasz) {
        $("#jobs").html(valasz);
      });
    });
    

    //betöltődéskor a felhasznált kategóriák megjelenítése
    $("#categories").ready(function(){            
    $.get("php/categories.php", {}, function (valasz) {
        $("#categories").html(valasz);
     });
  });

    /*$.ajax({
        url: "php/categories.php",
        method: 'GET'
        data: {},
        success: function (valasz) {
            $("#categories").html(valasz);
        }
    });*/


    //login esemény megvalósítása ajax segítségével
    $("[name=enter]").click(function () {
        let email = $("#email").val();
        let pwd = $("#pwd").val();

        //$.post így is lehet....értelemszerűen!
        $.ajax({
            method: "POST",
            url: "php/log_in.php",
            data: {email: email,
                pwd: pwd},

            success: function (valasz) {
                window.location.replace = "index.php";

            },

            error: function (status) {
                console.log(valasz);
            }

        });
    }); // login esemény vége

    //állas felöltése az adatbázisba
    $("[name=feltolt]").click(function () {
        console.log("Feltöltök...");
        let katid = $('[name=katid]:checked').val();
        let munkaado = $('[name=munkaado]').val();
        let munkakor = $('[name=munkakor]').val();
        let hely = $('[name=hely]').val();
        let leiras = $('[name=leiras]').val();
        let fizetes = $('[name=fizetes]').val();

        $.ajax({
            method: "POST",
            url: "php/fel_tolt.php",
            data: {
                katid: katid,
                munkakado: munkaado,
                munkakor: munkakor,
                hely: hely,
                leiras: leiras,
                fizetes: fizetes},
            success: function (valasz) {
                console.log(valasz);
            },
        });
    }); //állás feltöltése VÉGE

    //keresés megvalósítása

    $("[name=search]").on("submit", function (e) {
        e.preventDefault();
    });

    $("[name=search]").click(function () {
        let word = $("#keyword").val();
        let cat = $("#categories").val();
        word = word.trim();
        if (cat == 0) {
            
            $.get("php/search.php", {keyword: word}, function (valasz) {
                $("#jobs").html(valasz);
            });
        } else {
            $.get("php/search.php", {keyword: word, cat_id: cat}, function (valasz) {
                $("#jobs").html(valasz);
            });
        }
    }); //keresés vége

}); //READY vége


