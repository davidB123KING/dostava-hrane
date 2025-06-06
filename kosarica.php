<?php
session_start();
require_once 'baza.php';

$narocilo_id = $_SESSION['narocilo_id'] ?? null;

if (!$narocilo_id) {
    echo "<p>Košarica je prazna.</p>";
    exit;
}

// Pridobi jedi iz zaključna-naročila za to naročilo
$query = "
SELECT h.ime, zn.kolicina, zn.cena, (zn.kolicina * zn.cena) AS skupno
FROM `zaključna-naročila` zn
JOIN hrana h ON zn.hrana_id = h.id
WHERE zn.naročilo_id = $narocilo_id
";

$result = mysqli_query($link, $query);
if (!$result) {
    die("Napaka v poizvedbi: " . mysqli_error($link));
}

$skupaj = 0;
echo "<h2>Tvoja košarica:</h2><ul>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>{$row['ime']} – {$row['kolicina']} x {$row['cena']} € = {$row['skupno']} €</li>";
    $skupaj += $row['skupno'];
}
echo "</ul>";

echo "<p><strong>Skupna cena:</strong> $skupaj €</p>";

echo "<form method='post' action='zakljuci_narocilo.php'>
        <input type='hidden' name='narocilo_id' value='$narocilo_id'>
        <input type='hidden' name='skupaj' value='$skupaj'>
        <button type='submit'>Kupi in plačaj</button>
      </form>";

mysqli_close($link);
?>
