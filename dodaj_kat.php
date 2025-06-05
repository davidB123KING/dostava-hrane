<?php
include_once 'seja.php';
require_once 'baza.php';

if (isset($_POST['dodaj'])) {
    $ime = mysqli_real_escape_string($link, $_POST['ime']);
    $opis = mysqli_real_escape_string($link, $_POST['opis']);

    $sql = "INSERT INTO kategorije (ime, opis) VALUES ('$ime', '$opis')";
    if (mysqli_query($link, $sql)) {
        header("Location: admin.php"); // po dodajanju nazaj na admin
        exit;
    } else {
        echo "Napaka pri dodajanju kategorije: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj kategorijo</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>
    <h2>Dodaj novo kategorijo</h2>
    <form method="post">
        <div>
            Ime kategorije:<br>
            <input type="text" name="ime" required>
        </div><br>
        <div>
            Opis:<br>
            <textarea name="opis" rows="4" required></textarea>
        </div><br>
        <button type="submit" name="dodaj">Dodaj</button>
    </form>

    <p><a href="admin.php">Nazaj na admin nadzorno ploščo</a></p>
</body>
</html>
