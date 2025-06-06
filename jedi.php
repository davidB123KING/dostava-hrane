<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Jedi po kategoriji</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>

<?php
session_start();
require_once 'baza.php';

$kategorija_id = $_GET['kategorija'] ?? null;

// Ustvari ID naročila za sejo, če še ni
if (!isset($_SESSION['trenutno_narocilo_id'])) {
    $_SESSION['trenutno_narocilo_id'] = uniqid();
}

if ($kategorija_id) {
    $jedi = mysqli_query($link, "SELECT * FROM hrana WHERE kategorija_id = $kategorija_id");

    echo "<h2>Jedi v izbrani kategoriji</h2><ul>";
    while ($jed = mysqli_fetch_assoc($jedi)) {
        echo "<li>
                <strong>{$jed['ime']}</strong> - {$jed['opis']} - {$jed['cena']} €
                <form method='post' action='dodaj_v_kosarico.php' style='display:inline; margin-left: 10px;'>
                    <input type='hidden' name='hrana_id' value='{$jed['id']}'>
                    <button type='submit'>Dodaj v košarico</button>
                </form>
              </li>";
    }
    echo "</ul>";
} else {
    echo "<p>Ni izbrane kategorije.</p>";
}

mysqli_close($link);
?>

<a href="kosarica.php">Poglej košarico</a>

</body>
</html>
