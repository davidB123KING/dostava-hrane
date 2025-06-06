<?php
session_start();
require_once 'baza.php';

if (isset($_POST['narocilo_id'], $_POST['skupaj'])) {
    $narocilo_id = $_POST['narocilo_id'];
    $skupaj = $_POST['skupaj'];

    // Vstavi v zaključna_naročila
    $stmt = mysqli_prepare($link, "INSERT INTO zakljucna_narocila (narocilo_id, skupna_cena, datum) VALUES (?, ?, NOW())");
    mysqli_stmt_bind_param($stmt, "sd", $narocilo_id, $skupaj);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Po zaključku lahko zbrišeš začasna naročila, če želiš:
    mysqli_query($link, "DELETE FROM narocila WHERE narocilo_id = '$narocilo_id'");

    // Ponastavi sejo
    unset($_SESSION['trenutno_narocilo_id']);

    echo "<p>Hvala za nakup! Skupna cena je $skupaj €.</p>";
    echo "<a href='meni.php'>Nazaj na meni</a>";
} else {
    echo "<p>Napaka pri zaključku naročila.</p>";
}
?>
