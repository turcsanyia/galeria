<?php

require_once('../config/init.php');

$keyword;
$cat = "";
if (isset($_GET['cat_id'])) {   
    
    if (!isset($_GET['keyword'])) {
        $keyword = "%";
    } else {
        $keyword = "%" . $_GET['keyword'] . "%";
    }
    $cat = " AND kategoria_id=".$_GET['cat_id'];
    
} else {
    if (!isset($_GET['keyword'])) {
        $keyword = "%";
    } else {
        $keyword = "%" . $_GET['keyword'] . "%";
    }
}
$sql = "SELECT munkakor, fizetes, leiras, hely, munkaado FROM allasok WHERE (munkakor LIKE ? OR leiras LIKE ? OR hely LIKE ?)";
//var_dump($sql);
$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $keyword, $keyword, $keyword);
$res = $stmt->execute();

$html = "<table class='table-striped table-hover'>"
        . "<tr>"
        . "<th>Munkakör</th>"
        . "<th>Fizetés</th>"
        . "<th>Leírás</th>"
        . "<th>Hely</th>"
        . "<th>Munkaado</th>"
        . "</tr>";
if (!$res) {
    die("Hiba a lekérdezés során");
}

$stmt->bind_result($munka, $fizetes, $leiras, $hely, $munkaado);

while ($row = $stmt->fetch()) {
    $html .= "<tr>"
            . "<td>{$munka}</td>"
            . "<td>{$fizetes}</td>"
            . "<td>{$leiras}</td>"
            . "<td>{$hely}</td>"
            . "<td>{$munkaado}</td>"
            . "</tr>";
}

echo $html;

$stmt->close();
$conn->close();
