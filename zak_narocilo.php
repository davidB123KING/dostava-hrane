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

// Preverimo, ali je uporabnik prijavljen in ima odprto naročilo
if (!isset($_SESSION['idu'])) {
    header("Location: prijava.php");
    exit; // ustavimo izvajanje, ker se preusmerjamo
}

if (!isset($_SESSION['naročilo_id'])) {
    echo "Nimate odprtega naročila.";
    exit;
}

$narocilo_id = (int)$_SESSION['naročilo_id'];

// Spremeni status naročila v "v pripravi"
mysqli_query($link, "UPDATE naročila SET status = 'v pripravi' WHERE id = $narocilo_id");

// Po želji počistimo sejo, da lahko začne novo naročilo
unset($_SESSION['naročilo_id']);

// Izpišemo potrditev in povezavo
echo "Naročilo uspešno oddano. Status: v pripravi.<br>";
echo "<a href='moja_narocila.php'>Poglej svoja naročila</a>";
exit;
?>
