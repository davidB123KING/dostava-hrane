<?php
include_once 'seja.php';

// Preveri, ali je uporabnik admin
if (!isset($_SESSION['vloga']) || $_SESSION['vloga'] !== 'admin') {
    header("Location: index.php");
    exit;

}
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
    <h1>Admin nadzorna plošča</h1>
    <p>Prijavljen kot: <strong><?php echo $_SESSION['name']; ?></strong></p>
    <div class="meni">
        <a href="dodaj_hrano.php"> Dodaj hrano</a>
        <a href="seznam_hrane.php"> Uredi/izbriši hrano</a>
        <a href="uporabniki.php"> Upravljanje uporabnikov</a>
        <a href="odjava.php">🚪 Odjava</a>

</div>
</div>
</body>
</html>

