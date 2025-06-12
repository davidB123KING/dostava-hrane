<?php
include_once 'seja.php';
require_once 'baza.php';

if (isset($_POST['dodaj'])) {
    $ime = $_POST['ime'];
    $opis = $_POST['opis'];

    $poizvedba = "INSERT INTO kategorije VALUES (NULL, '$ime', '$opis')";

    if (mysqli_query($link, $poizvedba)) {
        header("refresh:2;url=admin.php");
        echo "Kategorija dodana.";
    } else {
        echo "Napaka pri vnosu.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dodaj kategorijo</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>
    <h2>Dodaj kategorijo</h2>
    <form method="post">
        Ime kategorije:<br>
        <input type="text" name="ime" required><br><br>

        Opis:<br>
        <textarea name="opis" rows="4" required></textarea><br><br>

        <input type="submit" name="dodaj" value="Dodaj">
    </form>

    <br>
    <p><a href="admin.php">Nazaj</a></p>
</body>
</html>