<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "dostava-hrane");

// Preverimo, ali je uporabnik prijavljen in ima odprto naročilo
if (!isset($_SESSION['idu']) || !isset($_SESSION['naročilo_id'])) {
    die("Napaka: uporabnik ni prijavljen ali ni odprtega naročila.");
}

$narocilo_id = $_SESSION['naročilo_id'];

// Spremeni status naročila v "zakljuceno"
mysqli_query($link, "UPDATE naročila SET status = 'zakljuceno' WHERE id = $narocilo_id");

// Po želji počistimo sejo, da lahko začne novo naročilo
unset($_SESSION['naročilo_id']);

// Lahko izpišeš potrditev ali preusmeriš
echo "Naročilo uspešno zaključeno.";
// header("Location: meni.php"); // odkomentiraj, če želiš preusmeritev
exit;
?>