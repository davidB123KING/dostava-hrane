<?php
$link = mysqli_connect("localhost", "root", "", "dostava-hrane");

$kategorije = mysqli_query($link, "SELECT * FROM kategorije");

echo "<h2>Kategorije:</h2>";
while ($kat = mysqli_fetch_assoc($kategorije)) {
    echo "<a href='jedi.php?kategorija={$kat['id']}'>{$kat['ime']}</a><br>";
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
