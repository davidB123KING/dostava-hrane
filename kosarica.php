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
    FROM zaključna_naročila zn
    JOIN hrana h ON zn.hrana_id = h.id
    WHERE zn.naročilo_id = $narocilo_id
");

$skupaj = 0;

echo "<h2>Tvoja košarica:</h2>";

while ($vrstica = mysqli_fetch_assoc($rezultat)) {
    $vmesna = $vrstica['cena'] * $vrstica['količina'];
    $skupaj += $vmesna;
    echo "<p>{$vrstica['ime']} x {$vrstica['količina']} = $vmesna €</p>";
}

echo "<hr><p><strong>Skupaj: $skupaj €</strong></p>";
echo "<a href='zak_narocilo.php'>Zaključi naročilo</a>";
?>