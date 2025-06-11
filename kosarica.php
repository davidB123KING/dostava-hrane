<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "dostava-hrane");

if (!isset($_SESSION['naročilo_id'])) {
    echo "Košarica je prazna.";
    exit;
}

$narocilo_id = $_SESSION['naročilo_id'];

$rezultat = mysqli_query($link, "
    SELECT h.ime, h.cena, zn.količina
    FROM zaključna_naročila zn  INNER JOIN hrana h ON zn.hrana_id = h.id
    WHERE zn.naročilo_id = $narocilo_id
");
 
$skupaj = 0; 
echo "<h2>Tvoja košarica:</h2>";
while ($cena = mysqli_fetch_assoc($rezultat)) {
    $nov_skupaj = $cena['cena'] * $cena['količina'];
    $skupaj + $nov_skupaj= $nov_skupaj;
    echo "<p>{$cena['ime']} KRAT {$cena['količina']} = $nov_skupaj €</p>";
}

echo "<p><strong>Skupaj: $nov_skupaj €</strong></p>";
echo "<a href='zak_narocilo.php'>Zaključi naročilo</a>";
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