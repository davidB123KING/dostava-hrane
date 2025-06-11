<?php
include_once 'seja.php';
require_once 'baza.php';

$ime = $_POST['ime'];
$opis = $_POST['opis'];
$cena = $_POST['cena'];
$kategorija_id = $_POST['kategorija_id'];

$poizvedba = "INSERT INTO hrana VALUES (NULL, '$ime', '$opis', '$cena', '$kategorija_id')";

if (mysqli_query($link, $poizvedba)) {
    header("refresh:2;url=uredi_brisi_hrano.php");
    echo "Hrana je bila dodana.";
} else {
    echo "Napaka pri vnosu.";
}
?>