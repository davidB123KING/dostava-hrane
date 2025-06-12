<?php
include_once 'seja.php';
require_once 'baza.php';

$query= "SELECT id, ime
              FROM kategorije";
$rezultat = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dodaj hrano</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>

<h2>Dodaj hrano</h2>

<form action="hrana_v_bazo.php" method="post" enctype="multipart/form-data"> <!-- tu sem rabil dat enctype da se mi slika shrani v bazo brez errorja -->
    Ime:<br>
    <input type="text" name="ime" required><br>
    Opis:<br>
    <textarea name="opis" rows="4" required></textarea><br>
    Cena (EUR):<br>
    <input type="number" name="cena" step="0.01" required><br>

    Kategorija:<br>
    <select name="kategorija_id" required>
        <option value="">Izberi</option>
    </br>

        <?php
        while ($vrstica = mysqli_fetch_assoc($rezultat)) {
            echo "<option value='" . $vrstica['id'] . "'>" . $vrstica['ime'] . "</option>";
        }
        ?>
    </select><br><br>
    Slika: <input type="file" name="slika"><br>
    <br>

    <input type="submit" value="Shrani">
</form>

</body>
</html>