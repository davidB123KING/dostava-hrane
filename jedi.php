<?php
require_once 'baza.php';

if (isset($_GET['kategorija'])) {
    $kategorija_id = $_GET['kategorija'];

    $kat = mysqli_query($link, "SELECT ime FROM kategorije WHERE id = $kategorija_id");
    $kategorija = mysqli_fetch_assoc($kat);
    echo "<h2>Jedi v kategoriji: {$kategorija['ime']}</h2>";

    $hrana = mysqli_query($link, "SELECT * FROM hrana WHERE kategorija_id = $kategorija_id");

    while ($jed = mysqli_fetch_assoc($hrana)) {
        $slika = $jed['slika'];
        $slika64 = base64_encode($slika);

        echo "<form action='dodaj_v_kosarico.php' method='post'>";
        echo "<input type='hidden' name='hrana_id' value='{$jed['id']}'>";

        echo "<img src='data:image/jpeg;base64,$slika64' style='width:200px;height:auto'>";
        echo "</button>";

        echo "<p>{$jed['ime']}</p>";
        echo "<p>{$jed['opis']}</p>";
        echo "<p>Cena: {$jed['cena']} €</p>";

        echo "<p>Količina: <input type='number' name='kolicina' value='1' min='1'></p>";

        echo "<input type='submit' value='Dodaj v košarico'>";
        echo "</form>";
        echo "<hr>";
    }

} else {
    echo "Kategorija ni izbrana.";
}
echo "<p><a href='meni.php'>Nazaj na meni</a></p>";
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