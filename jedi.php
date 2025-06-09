<?php
$link = mysqli_connect("localhost", "root", "", "dostava-hrane");

if (isset($_GET['kategorija'])) {
    $kategorija_id = $_GET['kategorija'];

    // Prikažemo ime kategorije
    $kat = mysqli_query($link, "SELECT ime FROM kategorije WHERE id = $kategorija_id");
    $kategorija = mysqli_fetch_assoc($kat);
    echo "<h2>Jedi v kategoriji: {$kategorija['ime']}</h2>";

    // Prikažemo jedi
    $hrana = mysqli_query($link, "SELECT * FROM hrana WHERE kategorija_id = $kategorija_id");

    while ($jed = mysqli_fetch_assoc($hrana)) {
        echo "<div style='margin-bottom: 15px;'>";
        echo "<h3>{$jed['ime']}</h3>";
        echo "<p>{$jed['opis']}</p>";
        echo "<p>Cena: {$jed['cena']} €</p>";
        echo "<form action='dodaj_v_kosarico.php' method='post'>";
        echo "<input type='hidden' name='hrana_id' value='{$jed['id']}'>";
        echo "<input type='number' name='kolicina' value='1' min='1'>";
        echo "<input type='submit' value='Dodaj v košarico'>";
        echo "</form>";
        echo "</div><hr>";
    }
} else {
    echo "Kategorija ni izbrana.";
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