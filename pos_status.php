<?php
session_start();
require_once 'baza.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['naročilo_id'], $_POST['nov_status'])) {
    $narocilo_id = (int)$_POST['naročilo_id'];
    $nov_status = mysqli_real_escape_string($link, $_POST['nov_status']);

    // Posodobi status v bazi
    $query = "UPDATE naročila SET status = '$nov_status' WHERE id = $narocilo_id";
    if (mysqli_query($link, $query)) {
        header("Location: dostavljalec.php"); // preusmeri nazaj
        exit;
    } else {
        echo "Napaka pri posodobitvi statusa: " . mysqli_error($link);
    }
} else {
    echo "Neveljavna zahteva.";
}