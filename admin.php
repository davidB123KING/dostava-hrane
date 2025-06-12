<?php
include_once 'seja.php';
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Admin nadzorna plošča</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>
    <div class="vse">
    <h1>Administratorski pogled</h1>
    <p>Prijavljen kot: <b><?php echo $_SESSION['name']; ?></b></p>
    <div class="meni">
        <a href="dodaj_hrano.php"> Dodaj hrano</a>
        <a href="uredi_brisi_hrano.php"> Uredi/izbriši hrano</a>
        <a href="upravljanje_upo.php"> Upravljanje uporabnikov</a>
        <a href="dodaj_kat.php">Dodaj novo kategorijo</a>
        <a href="odjava.php">Odjava</a>

</div>
</div>
</body>
</html>

