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

<?php
include_once 'seja.php';
require_once 'baza.php';

if (!isset($_SESSION['idu'])) {
    header("Location: prijava.php");
    exit; // spet meje header mal zajebavu , nekje je delal nekje pa ne
}

if (!isset($_SESSION['naročilo_id'])) {
    echo "Nimate odprtega naročila.";
    exit;
}

$narocilo_id = (int)$_SESSION['naročilo_id'];

mysqli_query($link, "UPDATE naročila SET status = 'v pripravi' WHERE id = $narocilo_id");

unset($_SESSION['naročilo_id']);

echo "<div class='sredina-link'>";
echo "Naročilo uspešno oddano. Status: v pripravi.<br>";
echo "<a href='moja_narocila.php'>Poglej svoja naročila</a>";
echo "</div>";
exit;
?>
