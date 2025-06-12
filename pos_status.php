<?php
include_once 'seja.php';
require_once 'baza.php';

if (isset($_POST['naročilo_id']) && isset($_POST['nov_status'])) {
    $narocilo_id = $_POST['naročilo_id'];
    $nov_status = $_POST['nov_status'];

    mysqli_query($link, "UPDATE naročila SET status = '$nov_status' WHERE id = $narocilo_id");

    header("Location: dostavljalec.php");
}
?>