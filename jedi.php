<?php
require 'baza.php';

$kategorija_id = $_GET['kategorija'];

$result = mysqli_query($link, "SELECT ime FROM kategorije WHERE id = '$kategorija_id'");
$row = mysqli_fetch_assoc($result);
$ime_kategorije = $row['ime'];

echo "<h2>Jedi za kategorijo: " . $ime_kategorije . "</h2>";

$jedi = mysqli_query($link, "SELECT * FROM hrana WHERE kategorija_id = '$kategorija_id'");

echo "<ul>";
while ($jed = mysqli_fetch_assoc($jedi)) {
    echo "<li><strong>" . $jed['ime'] . "</strong> - " . $jed['opis'] . "</li>";
}
echo "</ul>";

mysqli_close($link);
?>
