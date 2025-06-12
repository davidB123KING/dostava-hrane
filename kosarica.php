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

<?php
include_once 'seja.php';
require_once 'baza.php';

echo "<div class='sredina-link'>";
echo "<a href='moja_narocila.php'>Moja naročila</a>";
echo "</div>";
if (!isset($_SESSION['naročilo_id'])) {
    echo "Košarica je prazna."; /* tukaj isto ni delal pravilno header ponekod pa mi je lepo delal*/
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
echo "<div class='sredina-link'>";
echo "<a href='zak_narocilo.php'>Zaključi naročilo</a>";
echo "<a href='meni.php'>Nazaj na meni</a>";
echo "</div>";
?>