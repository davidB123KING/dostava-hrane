<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "dostava-hrane");

// Brez preverjanja vloge in prijave - za začetnike :)

// Če je poslan POST za spremembo statusa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['naročilo_id']) && isset($_POST['status'])) {
    $id = $_POST['naročilo_id'];
    $status = $_POST['status'];

    // Preprosta update poizvedba (brez zaščite!)
    mysqli_query($link, "UPDATE naročila SET status = '$status' WHERE id = $id");
    echo "Status naročila številka $id je bil posodobljen na: $status<br>";
}

// Pridobi vsa naročila s statusom v pripravi, se pripravlja ali na poti
$result = mysqli_query($link, "SELECT n.id, n.datum, n.status, u.ime, u.priimek, u.telefonska_stevilka
                               FROM naročila n JOIN uporabniki u ON n.uporabnik_id = u.id_u
                               WHERE n.status IN ('v pripravi', 'se pripravlja', 'na poti')
                               ORDER BY n.datum DESC");

echo "<h2>Naročila za dostavo</h2>";

if (mysqli_num_rows($result) == 0) {
    echo "Trenutno ni naročil za dostavo.";
    exit;
}

while ($narocilo = mysqli_fetch_assoc($result)) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
    echo "Naročilo št.: " . $narocilo['id'] . "<br>";
    echo "Datum: " . $narocilo['datum'] . "<br>";
    echo "Status: " . $narocilo['status'] . "<br>";
    echo "Naročnik: " . $narocilo['ime'] . " " . $narocilo['priimek'] . "<br>";
    echo "Telefon: " . $narocilo['telefonska_stevilka'] . "<br>";

    $id_narocila = $narocilo['id'];
    $jedi = mysqli_query($link, "SELECT h.ime, zn.količina FROM zaključna_naročila zn JOIN hrana h ON zn.hrana_id = h.id WHERE zn.naročilo_id = $id_narocila");

    echo "<ul>";
    while ($jeda = mysqli_fetch_assoc($jedi)) {
        echo "<li>" . $jeda['ime'] . " - " . $jeda['količina'] . " kosov</li>";
    }
    echo "</ul>";

    echo "
    <form method='post'>
        <input type='hidden' name='naročilo_id' value='$id_narocila'>
        <label>Spremeni status:</label>
        <select name='status'>
            <option value='se pripravlja'" . ($narocilo['status']=='se pripravlja' ? ' selected' : '') . ">Se pripravlja</option>
            <option value='na poti'" . ($narocilo['status']=='na poti' ? ' selected' : '') . ">Na poti</option>
            <option value='dostavljeno'" . ($narocilo['status']=='dostavljeno' ? ' selected' : '') . ">Dostavljeno</option>
        </select>
        <button type='submit'>Posodobi</button>
    </form>
    ";

    echo "</div>";
}
?>