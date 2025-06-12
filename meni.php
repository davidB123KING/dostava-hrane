<?php
include_once 'seja.php';
require_once 'baza.php';

$kategorije = mysqli_query($link, "SELECT * FROM kategorije");

echo "<h2>Kategorije:</h2>";
while ($kat = mysqli_fetch_assoc($kategorije)) {
    echo "<div class='sredina-link'>";
    echo "<a href='jedi.php?kategorija={$kat['id']}'>{$kat['ime']}</a><br>";
    echo "</div>";
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
