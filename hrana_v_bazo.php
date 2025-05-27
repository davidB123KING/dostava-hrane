<?php
include_once 'seja.php';
require_once 'baza.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime = $_POST['ime'];
    $opis = $_POST['opis'];
    $cena = $_POST['cena'];
    $kategorija_id = $_POST['kategorija_id'];

    $sql = "INSERT INTO hrana (ime, opis, cena, kategorija_id) 
            VALUES ('$ime', '$opis', '$cena', '$kategorija_id')";

    if (mysqli_query($link, $sql)) {
        // uspešno shranjeno
        header("Location: uredi_brisi_hrano.php"); // naredi to stran, če želiš prikaz
        exit;
    } else {
        echo "Napaka pri shranjevanju: " . mysqli_error($link);
    }
} else {
    echo "Nepravilen dostop.";
}
