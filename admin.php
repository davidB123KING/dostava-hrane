<?php
session_start();

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
</head>
<body>
    <h1>Admin nadzorna plošča</h1>
    <p>Prijavljen kot: <strong><?php echo $_SESSION['ime']; ?></strong></p>

    <ul>
        <li><a href="admin/dodaj_hrano.php">➕ Dodaj hrano</a></li>
        <li><a href="admin/uredi_hrano.php">✏️ Uredi/izbriši hrano</a></li>
        <li><a href="admin/uporabniki.php">👥 Upravljanje uporabnikov</a></li>
        <!-- Dodaj dodatne funkcije po želji -->
    </ul>

    <p><a href="odjava.php">🚪 Odjava</a></p>
</body>
</html>

