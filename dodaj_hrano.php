<?php
include_once 'seja.php';
require_once 'baza.php';

// Pridobi kategorije iz baze
$sql = "SELECT id, ime FROM kategorije ORDER BY ime ASC";
$rezultat = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj hrano</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>

<div class="vse">
    <h2>Dodaj novo hrano</h2>

    <form action="hrana_v_bazo.php" method="post">
        Ime hrane:<br>
        <input type="text" name="ime" required><br><br>
        Opis hrane:<br>
        <textarea name="opis" rows="4" cols="50" required></textarea><br><br>
        Cena (EUR):<br>
        <input type="number" name="cena" required><br><br>
        Kategorija:<br>
        <select name="kategorija_id" required>
            <option value="">Izberi kategorijo</option>
            <?php
            while ($kat = mysqli_fetch_assoc($rezultat)) {
                echo '<option value="'.$kat['id'].'">'.$kat['ime'].'</option>';
            }
            ?>
        </select><br><br>

        <button type="submit">Shrani</button>
    </form>
</div>

</body>
</html>
