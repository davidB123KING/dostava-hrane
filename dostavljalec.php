<?php
include_once 'seja.php';
require_once 'baza.php';

// Če sta poslana naročilo_id in status
if (isset($_POST['naročilo_id']) && isset($_POST['status'])) {
    $id = $_POST['naročilo_id'];
    $status = $_POST['status'];

    mysqli_query($link, "UPDATE naročila SET status = '$status' WHERE id = $id");
    echo "Status naročila številka $id je bil posodobljen na: $status<br>";
}

$result = mysqli_query($link, "SELECT n.id, n.datum, n.status, u.ime, u.priimek, u.telefonska_stevilka
                               FROM naročila n INNER JOIN uporabniki u ON n.uporabnik_id = u.id_u
                               WHERE n.status IN ('v pripravi', 'na poti')
                               ORDER BY n.datum DESC");

echo "<h2>Naročila za dostavo</h2>";

if (mysqli_num_rows($result) == 0) {
    echo "Trenutno ni naročil za dostavo.";
}

while ($narocilo = mysqli_fetch_assoc($result)) {
    echo "Naročilo št:". $narocilo['id'] . "<br>";
    echo "Datum:". $narocilo['datum'] . "<br>";
    echo "Status:". $narocilo['status'] . "<br>";
    echo "Kupec:". $narocilo['ime'] . " " . $narocilo['priimek'] . "<br>";
    echo "Telefonska:". $narocilo['telefonska_stevilka'] . "<br>";

    $id_narocila = $narocilo['id'];
    $jedi = mysqli_query($link, "SELECT h.ime, zn.količina FROM zaključna_naročila zn INNER JOIN hrana h ON zn.hrana_id = h.id WHERE zn.naročilo_id = $id_narocila");

    echo "<ul>";
    while ($jeda = mysqli_fetch_assoc($jedi)) {
        echo "<li>" . $jeda['ime'] . " - " . $jeda['količina'] . " kosov</li>";
    }
    echo "</ul>";

    echo "<form method='post'>";
    echo "<input type='hidden' name='naročilo_id' value='$id_narocila'>";
    echo "<label>Spremeni status:</label>";
    echo "<select name='status'>";
    echo "<option value='se pripravlja'" . ($narocilo['status'] == 'se pripravlja' ? ' selected' : '') . ">Se pripravlja</option>";
    echo "<option value='na poti'" . ($narocilo['status'] == 'na poti' ? ' selected' : '') . ">Na poti</option>";
    echo "<option value='dostavljeno'" . ($narocilo['status'] == 'dostavljeno' ? ' selected' : '') . ">Dostavljeno</option>";
    echo "</select>";
    echo "<input type='submit' value='Posodobi'>";
    echo "</form>";

    echo "<hr>";
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