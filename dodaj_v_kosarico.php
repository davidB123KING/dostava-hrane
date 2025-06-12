<?php
include_once 'seja.php';
require_once 'baza.php';

if (!isset($_SESSION['idu'])) {
    header("Location: prijava.php");
}

$uporabnik_id = $_SESSION['idu'];
$hrana_id = $_POST['hrana_id'];
$kolicina = $_POST['kolicina'];

if (!isset($_SESSION['naročilo_id'])) {
    $datum = date("Y-m-d H:i:s");
    mysqli_query($link, "INSERT INTO naročila (datum, status, uporabnik_id) VALUES ('$datum', 'v teku', $uporabnik_id)");
    $_SESSION['naročilo_id'] = mysqli_insert_id($link);
}

$narocilo_id = $_SESSION['naročilo_id'];

mysqli_query($link, "
    INSERT INTO zaključna_naročila (količina, naročilo_id, hrana_id)
    VALUES ('$kolicina', '$narocilo_id', '$hrana_id')
");

header("Location: kosarica.php"); /*tukaj meje url/header spet zajebaval*/
exit;
?>