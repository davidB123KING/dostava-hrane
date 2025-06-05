<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Jedi po kategoriji</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>

<?php
require_once 'baza.php';

$kategorija_id = $_GET['kategorija'] ?? null;

if ($kategorija_id) {
    $jedi = mysqli_query($link, "SELECT * FROM hrana WHERE kategorija_id = $kategorija_id");

    echo "<h2>Jedi v izbrani kategoriji</h2><ul>";
    while ($jed = mysqli_fetch_assoc($jedi)) {
        echo "<li><strong>{$jed['ime']}</strong> - {$jed['opis']}</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Ni izbrane kategorije.</p>";
}

mysqli_close($link);
?>

</body>
</html>
