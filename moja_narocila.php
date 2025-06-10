<?php
session_start();
require_once 'baza.php';

// Preveri, če je uporabnik prijavljen
if (!isset($_SESSION['idu'])) {
    header("Location: prijava.php");
    exit;
}

$uporabnik_id = $_SESSION['idu'];

echo "<h2>Moja naročila</h2>";

$query = "
    SELECT n.id AS naročilo_id, n.datum, n.status
    FROM naročila n
    WHERE n.uporabnik_id = $uporabnik_id
    ORDER BY n.datum DESC
";

$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) === 0) {
    echo "<p>Nimaš še nobenega naročila.</p>";
    exit;
}

while ($narocilo = mysqli_fetch_assoc($result)) {
    $narocilo_id = $narocilo['naročilo_id'];
    echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
    echo "<strong>Naročilo št.: {$narocilo['naročilo_id']}</strong><br>";
    echo "Datum: {$narocilo['datum']}<br>";
    echo "Status: " . htmlspecialchars($narocilo['status']) . "<br>";

    // Pridobi jedi za naročilo
    $query_jedi = "
        SELECT h.ime, zn.količina, h.cena
        FROM zaključna_naročila zn
        JOIN hrana h ON zn.hrana_id = h.id
        WHERE zn.naročilo_id = $narocilo_id
    ";
    $result_jedi = mysqli_query($link, $query_jedi);

    $skupaj = 0;
    echo "<ul>";
    while ($jeda = mysqli_fetch_assoc($result_jedi)) {
        $ime = htmlspecialchars($jeda['ime']);
        $kolicina = (int)$jeda['količina'];
        $cena = (float)$jeda['cena'];
        $vsota = $kolicina * $cena;
        $skupaj += $vsota;
        echo "<li>$ime - $kolicina x $cena € = $vsota €</li>";
    }
    echo "</ul>";
    echo "<strong>Skupaj: $skupaj €</strong>";
    echo "</div>";
}
?>
