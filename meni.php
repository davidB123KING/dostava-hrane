<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Kategorije hrane</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>

<?php
require_once 'baza.php';

$kategorije = mysqli_query($link, "SELECT * FROM kategorije");

echo "<h2>Kategorije hrane</h2><ul>";
while ($kat = mysqli_fetch_assoc($kategorije)) {
    echo "<li><a href='jedi.php?kategorija={$kat['id']}'>{$kat['ime']}</a></li>";
}
echo "</ul>";

mysqli_close($link);
?>

</body>
</html>
