<?php
include_once 'seja.php';
require_once 'baza.php';

$ime = $_POST['ime'];
$opis = $_POST['opis'];
$cena = $_POST['cena'];
$kategorija_id = $_POST['kategorija_id'];

$slika = file_get_contents($_FILES['slika']['tmp_name']);
$slika = mysqli_real_escape_string($link, $slika);

$query = "INSERT INTO hrana VALUES (NULL, '$ime', '$opis', '$cena', '$kategorija_id', '$slika')";

mysqli_query($link, $query);

header("refresh:2;url=uredi_brisi_hrano.php");
echo "Hrana je bila dodana.";
?>