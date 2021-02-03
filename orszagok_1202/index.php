<?php
  
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Föld országai</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script src="jquery-3.3.1.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <!-- szűrés kezdődik -->
    <form action="<?php $_SERVER['PHP_SELF'] ?>"> <!--hívó script lekérdezése a szerverről-->
        
    <select name="continent" class="">
        <!-- Az itt lévő parancs lesz az URL-ben, pontosabban a másik oldalon a script.js-ben
            található parancs és GET-es kérés! Ugyanolyan, mint az a href-elés, amiben kérdőjel van! -->
        
        <option value="0">Mind</option>
    <?php
        //földrészek és id-juk lekérdezése a foldresz táblából, dinamikus select elem előállítása 
        require_once('connect.php');
        
        $sql = "SELECT * FROM foldreszek";
        $res = $connect -> query($sql); // C# var res = connect.Query(sql);
        if (!$res){
            echo ("Hiba a földrészekkel!");
        } else {
            while ($row = $res -> fetch_array()){
                echo "<option value= \"{$row[0]}\" > {$row[1]} </option>";
            }
        }
    ?>
        </select>
        
        <select name="limit">
            <option value="0">mind</option>
            <option value="10">10</option>
            <option value="25">25</option>
        </select>
        <p>csökkenő sorrend<input type="radio" name="sorrend" value="csokkeno"></p>
        <p>növekvő sorrend<input type="radio" name="sorrend" value="novekvo"></p> 
        
     <p><input type="checkbox" name="rendez[]" value="O">Országnév
        <input type="checkbox" name="rendez[]" value="F">Főváros
        <input type="checkbox" name="rendez[]" value="N">Népesség</p>
        <input type="submit" value="Szűrés">
        
    </form> 
    <!-- szűrés vége -->
 
    <!-- adatok megjelenítésére szolgáló tábla fejléce -->
    <table class="table">
        
    <caption style="caption-side: top; text-align: center">Országok adatai</caption>
    
    <thead class="table-dark">
        <tr>
            <th>Kód</th>
            <th>Ország</th>
            <th>Főváros</th>
            <th>Népesség</th>
        </tr>
    </thead>
    
    <!-- tábla fejlécének a vége -->
    <?php
    
        $sql = "SELECT * FROM orszagok";
        if (isset($_GET['continent'])){
            //lekérdezés bővítése a kontinensre történő szűréssel         
                     
            
            $sql .= $_GET['continent'] == 0 ? "" : " WHERE foldreszkod = ".$_GET['continent'];

            /*
            if ($_GET['continent']==0){
                $sql.="";
            }else{
                $sql.=" WHERE foldreszkod = ".$_GET['continent'];
            }*/
            
            /*echo 4>3?"Igen, nagyobb!":"Nem nagyobb!";
           
            if (4>3) {
                echo"Igen nagyobb";
        }else{
            echo"Nem nagyobb";
        }*/
            
        }
        //lekérdezés sorrendjének meghatározása
        $order = " ORDER BY"; // string order = "ORDER BY";
        
        if (isset($_GET['rendez']) && count($_GET['rendez']) > 0){
            
            $rendez = $_GET['rendez']; // F
            
                foreach ($rendez as $r) {
                    // foreach (string r in rendez)
                    switch ($r){
                        
                    case "O" : 
                    $order .= " onev,";
                    break;
                
                    case "F" :
                    $order .= " fovaros,"; 
                    break;
                
                    case "N" : 
                    $order .= " nepesseg,";
                    break;
                }
            }
            $order = substr($order, 0, /*strlen($order)*/ -1);                
            
            /*
            var_dump($order);
            var_dump(substr($order, 1,7)); // 1. melyik stringet, 2. honnan (indexszám), 3. hány karaktert?
            die();*/
        } 
        /*else {
            $order = " ORDER BY fovaros";
        }*/
        if (isset($_GET['sorrend'])){
            $sql .= $_GET['sorrend'] == 'csokkeno' ? $order." DESC" : $order." ASC";
        }
        //sorrend beállításának befejezése
        //a tábla sorrainak oldalakra tördelése és paraméterezése 
        
        $limit = 0;
        $pageCount = 0;
        $start = 0;
        
        // A limit az ott fölül van 10 ill. 25 szám és onnan veszi ki!
        if (isset($_GET['limit']) && $_GET['limit'] != 0){
            
            if ($res = $connect -> query($sql)){
                $limit = $_GET['limit'];
                $pageCount = ceil($res -> num_rows / $limit);
                //Elhoz 193 sort és azt osztja el pl.: 25-el! Így adja ki a pageCountot!
                                                
            }
            if (!empty($_GET['page'])){
                 $page = $_GET['page'];
                 
                 
                if ($page > 1){
                    
                    $start = ($_GET['page'] - 1) * $limit; // Ez a linkekre való klikkeléskor indul el, kiírja, az adott
                    /* összmennyiséget!*/
                }
                                
            }
            $sql .= " LIMIT {$start},".$limit;
        }
        //VÉGE az oldalakra tördelésnek
        $sql .= ";";  //lekérdezés lezárása
        echo $sql."<br>"; //teszt jeleggel kiíratjuk a lekérdezésünket, ellenőrizzük a szintaktikát
        /* Ez a rész ugyanaz, ami megjelenik az URL-ben csak más szintaxissal értelemszerűen  mert*/
                
        $res = $connect -> query($sql); //lekérdezés végrehajtása
        if (!$res)
            
            { //Sikeresen létre jött-e a a result tip. objektum, ha sikertelen a lekérdezés, akkor false értékű a változó.
            echo "Hiba a lekérdezés végrehajtásakor!";
        } else {
            $number = 1;
            echo "A lekérdezésnek ".$res -> num_rows." sor felelt meg."; // teszt jellegű, Ez a limit, amint fönt beállítok!
            /* Amennyiben limitet állítok be, akkor mindig az lesz a num_rows, amennyiben nem akkor 193.*/
            
            while ($row = $res -> fetch_assoc()){ 
               //Sorokra bontás művelete, amíg van újabb sor a res objektumban.
                echo "<tr>";
                echo '<td>'.$number.'</td>';
                echo '<td>'.$row['onev'].'</td>';
                echo '<td>'.$row['fovaros'].'</td>';
                echo '<td>'.$row['nepesseg'].'</td>';
                echo "</tr>";
                $number++;
                //Ez a számozás pedig a grafikus felületen a tábla sorszámai pontosabban az országoké 1-től 193-ig.
            }
        }
        echo "</table>";
        echo $pageCount."<br>"; /*Kiírja az oldalszám mennyiségét! Alul ugyanúgy ott van a pageCount de ott 
        *egyesével írja ki az oldalszámokat!*/
        echo $_SERVER['QUERY_STRING']."<br>"; // Ez ugyanaz, mint az alábbi sor!
        echo $link = $_SERVER['QUERY_STRING']; //url azon része, mely a scriptet követően szerepel pl. ?continent=0&limit=10 
        //$pageFound = strpos($link, "page"); //van-e már page szó az urlben
        //var_dump($pageFound)."<br>";
        /*if ($pageFound !== false) { //a page szó kezdete a sztringben
            $link = substr($link, 0, $pageFound-1);
        }*/
        //echo $link."<br>";
        // Navigációs linkek előállítása és megjelenítése.
        if ($pageCount > 0){ 
            for($i = 1; $i <= $pageCount; $i++){
                echo '<a href="index.php?'.$link.'&page='.$i.'">'.$i.'</a>&nbsp&nbsp;';
                //A fönti page-ra ugrik fel mert href, vagyük észre!
                // ...és azt is vegyük észre, hogy kérdőjeles a href és megjelenik az URL-ben
            }
        }
        
    ?>
    
    
    
</body>
</html>