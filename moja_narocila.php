<?php
include_once 'seja.php';
require_once 'baza.php';

$uporabnik_id = $_SESSION['idu'];

echo "<h2>Moja naročila</h2>";

$query = "
    SELECT id, datum, status
    FROM naročila n
    WHERE uporabnik_id = $uporabnik_id
";

$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<p>Nimaš še nobenega naročila.</p>";
    exit;
}

while ($narocilo = mysqli_fetch_assoc($result)) {
    echo "Naročilo št: " . $narocilo['id'] . "<br>";
    echo "Datum: " . $narocilo['datum'] . "<br>";
    echo "Status: " . $narocilo['status'] . "<br>";

    $narocilo_id = $narocilo['id'];
    $query = "
        SELECT h.ime, zn.količina, h.cena
        FROM zaključna_naročila zn INNER JOIN hrana h ON zn.hrana_id = h.id INNER JOIN naročila n ON zn.naročilo_id = n.id
        WHERE zn.naročilo_id = $narocilo_id
        ORDER BY n.datum DESC;
    ";

    $result_jedi = mysqli_query($link, $query);

    $skupaj = 0;
    echo "<ul>";
    while ($cena = mysqli_fetch_assoc($result_jedi)) {
        $nov_skupaj = $cena['količina'] * $cena['cena'];
        $skupaj += $nov_skupaj;
        echo "<li>" . $cena['ime'] . " - " . $cena['količina'] . " KRAT " . $cena['cena'] . " € = " . $nov_skupaj . " €</li>";
    }
    echo "</ul>";
    echo "Skupaj: " . $skupaj . " €<br><br>";
    echo "<hr>";
    echo "<a href='index.php'>Nazaj na začetek</a><br>";
}
?>
<!DOCTYPE html>
<html lang="sl">   
<head>
    <meta charset="UTF-8">
    <title>Meni</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>
</body>
</html>