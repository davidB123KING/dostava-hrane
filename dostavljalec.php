<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "dostava-hrane");

// Preveri vlogo
if (!isset($_SESSION['vloga']) || $_SESSION['vloga'] !== 'dostavljalec') {
    die("Dostop zavrnjen.");
}

$dostavljalec_id = $_SESSION['idu'];

// Pridobi vsa naročila, ki so zaključena ali v pripravi ali na poti (ali katerikoli status, ki ga želiš)
$query = "
    SELECT n.id, n.datum, n.status, u.ime, u.priimek, u.telefonska_stevilka
    FROM naročila n
    JOIN uporabniki u ON n.uporabnik_id = u.id_u
    WHERE n.status IN ('v teku', 'na poti') 
    ORDER BY n.datum DESC
";

$result = mysqli_query($link, $query);

echo "<h2>Naročila za dostavo</h2>";

if (mysqli_num_rows($result) === 0) {
    echo "<p>Trenutno ni naročil za dostavo.</p>";
    exit;
}

while ($narocilo = mysqli_fetch_assoc($result)) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
    echo "<strong>Naročilo št.: " . $narocilo['id'] . "</strong><br>";
    echo "Datum: " . $narocilo['datum'] . "<br>";
    echo "Status: " . htmlspecialchars($narocilo['status']) . "<br>";
    echo "Naročnik: " . htmlspecialchars($narocilo['ime']) . " " . htmlspecialchars($narocilo['priimek']) . "<br>";
    echo "Telefon: " . htmlspecialchars($narocilo['telefonska_stevilka']) . "<br>";

    // Pridobi jedi za to naročilo
    $id_narocila = $narocilo['id'];
    $query_jedi = "
        SELECT h.ime, h.cena, zn.količina
        FROM zaključna_naročila zn
        JOIN hrana h ON zn.hrana_id = h.id
        WHERE zn.naročilo_id = $id_narocila
    ";
    $result_jedi = mysqli_query($link, $query_jedi);

    echo "<ul>";
    while ($jeda = mysqli_fetch_assoc($result_jedi)) {
        echo "<li>" . htmlspecialchars($jeda['ime']) . " - " . (int)$jeda['količina'] . " kosov</li>";
    }
    echo "</ul>";

}
?>