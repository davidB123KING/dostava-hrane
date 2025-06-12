<?php
include_once 'seja.php';
require_once 'baza.php';

// Brisanje (če je poslan GET parameter izbris_id)
if (isset($_GET['izbris_id'])) {
    $id = $_GET['izbris_id'];
    $sql = "DELETE FROM hrana WHERE id = '$id'";
    $result = mysqli_query($link, $sql);

    if ($result) {
        header("refresh:3;url=uredi_brisi_hrano.php");
        echo "uspešno si izbrisal hrano";
    } else {
        header("refresh:3;url=uredi_brisi_hrano.php");
        echo "napaka";
    }
}

// Urejanje - prikaži obrazec za urejanje, če je poslan id_za_urejanje
$uredi = null;
if (isset($_GET['id_za_urejanje'])) {
    $id = $_GET['id_za_urejanje'];
    $res = mysqli_query($link, "SELECT * FROM hrana WHERE id = '$id'");
    $uredi = mysqli_fetch_assoc($res);
}

// Shrani spremembe (preko GET, kot želiš - brez preverjanj)
if (isset($_GET['shrani'])) {
    $id = $_GET['id'];
    $ime = $_GET['ime'];
    $opis = $_GET['opis'];
    $cena = $_GET['cena'];
    $kategorija_id = $_GET['kategorija_id'];

    $sql = "UPDATE hrana SET 
            ime = '$ime', 
            opis = '$opis', 
            cena = '$cena', 
            kategorija_id = '$kategorija_id' 
            WHERE id = '$id'";
    $result = mysqli_query($link, $sql);

    if ($result) {
        header("refresh:3;url=uredi_brisi_hrano.php");
        echo "Posodobitev je bila uspešna. Preusmerjam nazaj čez 3 sekunde...";
    } else {
        header("refresh:3;url=uredi_brisi_hrano.php?id_za_urejanje=$id");
        echo "Napaka pri posodobitvi. Preusmerjam nazaj čez 3 sekunde...";
    }
    exit;
}

// Pridobi podatke o hrani in kategorijah za prikaz
$hrana = mysqli_query($link, "
    SELECT h.id, h.ime, h.opis, h.cena, h.kategorija_id, k.ime AS ime_kategorije
    FROM hrana h JOIN kategorije k ON h.kategorija_id = k.id
");
$kategorije = mysqli_query($link, "SELECT * FROM kategorije");
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Urejanje in brisanje hrane</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>
<h2>Seznam hrane</h2>
<table>
    <tr>
        <th>Ime</th>
        <th>Opis</th>
        <th>Cena</th>
        <th>Kategorija</th>
        <th>Uredi</th>
        <th>Izbriši</th>
    </tr>
    <?php while ($vr = mysqli_fetch_assoc($hrana)) { ?>
        <tr>
            <td><?= $vr['ime'] ?></td>
            <td><?= $vr['opis'] ?></td>
            <td><?= $vr['cena'] ?> €</td>
            <td><?= $vr['ime_kategorije'] ?></td>
            <td><a href="uredi_brisi_hrano.php ?id_za_urejanje=<?= $vr['id'] ?>">Uredi</a></td>
            <td><a href="uredi_brisi_hrano.php ?izbris_id=<?= $vr['id'] ?>">Izbriši</a></td>
        </tr>
    <?php } ?>
</table>

<?php if ($uredi) { ?>
    <hr>
    <h3>Uredi hrano</h3>
    <form method="get" action="uredi_brisi_hrano.php">
        <input type="hidden" name="id" value="<?= $uredi['id'] ?>">
        Ime:<br>
        <input type="text" name="ime" value="<?= $uredi['ime'] ?>" required><br><br>
        Opis:<br>
        <textarea name="opis" rows="4" required><?= $uredi['opis'] ?></textarea><br><br>
        Cena:<br>
        <input type="number" step="0.01" name="cena" value="<?= $uredi['cena'] ?>" required><br><br>
        Kategorija:<br>
        <select name="kategorija_id" required>
            <?php while ($kat = mysqli_fetch_assoc($kategorije)) {
                $sel = ($kat['id'] == $uredi['kategorija_id']) ? 'selected' : '';
                echo "<option value='{$kat['id']}' $sel>{$kat['ime']}</option>";
            } ?>
        </select><br><br>
        <button type="submit" name="shrani">Shrani</button>
    </form>
<?php } ?>

<div>
    <p><a href="admin.php">Nazaj</a></p>
</div>
</body>
</html>