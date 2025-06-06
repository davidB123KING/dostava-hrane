<?php
session_start();
require_once 'baza.php';

if (isset($_POST['hrana_id']) && isset($_SESSION['narocilo_id'])) {
    $hrana_id = $_POST['hrana_id'];
    $narocilo_id = $_SESSION['narocilo_id'];

    // Pridobi ceno hrane iz tabele hrana
    $query_hrana = mysqli_query($link, "SELECT cena FROM hrana WHERE id = $hrana_id");
    $row = mysqli_fetch_assoc($query_hrana);
    $cena = $row['cena'];

    // Privzeta količina = 1
    $query = "INSERT INTO `zaključna-naročila` (naročilo_id, hrana_id, količina, cena)
              VALUES ($narocilo_id, $hrana_id, 1, $cena)";
    mysqli_query($link, $query);
}

header("Location: kosarica.php");
exit;
?>
