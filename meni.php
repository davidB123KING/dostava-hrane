<?php
// Povezava z bazo
$conn = mysqli_connect("localhost", "root", "", "dostava-hrane");
if (!$conn) {
    die("Povezava ni uspela: " . mysqli_connect_error());
}

// Preverimo, ali je izbrana kategorija
$kategorija_id = isset($_GET['kategorija']) ? $_GET['kategorija'] : null;

// Prikaži kategorije
$kategorije = mysqli_query($conn, "SELECT * FROM kategorije");

echo "<h2>Kategorije hrane</h2>";
echo "<ul>";
while ($kategorija = mysqli_fetch_assoc($kategorije)) {
    echo "<li><a href='meni.php?kategorija=" . $kategorija['id'] . "'>" . $kategorija['ime'] . "</a></li>";
}
echo "</ul>";

// Če je izbrana kategorija, prikažemo jedi
if ($kategorija_id) {
    echo "<h3>Jedi:</h3>";
    $jedi = mysqli_query($conn, "SELECT * FROM hrana WHERE kategorija_id = $kategorija_id");

    echo "<ul>";
    while ($jed = mysqli_fetch_assoc($jedi)) {
        echo "<li><strong>" . $jed['ime'] . "</strong> - " . $jed['opis'] . "</li>";
    }
    echo "</ul>";
}

mysqli_close($conn);
?>
