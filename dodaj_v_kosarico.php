<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = new mysqli("localhost", "root", "", "dostava-hrane");

    $id = $_POST['id'];
    $ime = $_POST['ime'];
    $opis = $_POST['opis'];
    $cena = $_POST['cena'];
    $kategorija_id = $_POST['kategorija_id'];

    $sql = "INSERT INTO naročila (id, ime, opis, cena, kategorija_id)
            VALUES ('$id', '$ime', '$opis', '$cena', '$kategorija_id')";

    if ($link->query($sql)) {
        echo "Dodano v košarico!<br>";
        echo "<a href='jedi.php'>Nazaj na jedi</a>";
    } else {
        echo "Napaka: " . $link->error;
    }
}
?>
