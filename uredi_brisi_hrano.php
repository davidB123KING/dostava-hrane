<?php
include_once 'seja.php';
require_once 'baza.php';

// Brisanje
if (isset($_GET['izbrisi'])) {
    $id = $_GET['izbrisi'];
    mysqli_query($link, "DELETE FROM hrana WHERE id = $id");
    header("Location: uredi_brisi_hrano.php");
    exit;
}

// Urejanje
$uredi = null;
if (isset($_GET['uredi'])) {
    $id = $_GET['uredi'];
    $uredi = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM hrana WHERE id = $id"));
}

// Shrani spremembe
if (isset($_POST['shrani'])) {
    $id = $_POST['id'];
    mysqli_query($link, "UPDATE hrana SET 
        ime = '{$_POST['ime']}',
        opis = '{$_POST['opis']}',
        cena = '{$_POST['cena']}',
        kategorija_id = '{$_POST['kategorija_id']}'
        WHERE id = $id");
    header("Location: uredi_brisi_hrano.php");
    exit;
}

// Prikaz hrane
$hrana = mysqli_query($link, "
    SELECT h.id, h.ime AS ime_hrane, h.opis, h.cena, k.ime AS ime_kategorije, h.kategorija_id
    FROM hrana h JOIN kategorije k ON h.kategorija_id = k.id
");
//ime hrane in kategorije sem uporabil 2x zato se mije isto prikazovalo. Zato sem uporabil AS dasem ju preimenoval


// Kategorije
$kategorije = mysqli_query($link, "SELECT * FROM kategorije");
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Hrana</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>
<div class="vse">
    <h2>Seznam hrane</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Ime</th><th>Opis</th><th>Cena</th><th>Kategorija</th><th>Uredi</th>
        </tr>
        <?php while ($vr = mysqli_fetch_assoc($hrana)) : ?>
        <tr>
            <td><?= $vr['ime_hrane'] ?></td>
            <td><?= $vr['opis'] ?></td>
            <td><?= $vr['cena'] ?> €</td>
            <td><?= $vr['ime_kategorije'] ?></td>
            <td>
                <a href="?uredi=<?= $vr['id'] ?>">Uredi</a> | 
                <a href="?izbrisi=<?= $vr['id'] ?>">Izbriši</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

<?php if ($uredi) : ?>
    <hr>
    <h3>Uredi hrano</h3>
    <form method="post">
        <input type="hidden" name="id" value="<?= $uredi['id'] ?>">

        <input type="text" name="ime" value="<?= $uredi['ime'] ?>" placeholder="Ime" required><br><br>
        <textarea name="opis" rows="4" placeholder="Opis" required><?= $uredi['opis'] ?></textarea><br><br>
        <input type="number" name="cena" step="0.01" value="<?= $uredi['cena'] ?>" placeholder="Cena" required><br><br>

        <select name="kategorija_id">
            <?php while ($kat = mysqli_fetch_assoc($kategorije)) : ?>
                <option value="<?= $kat['id'] ?>" <?= $kat['id'] == $uredi['kategorija_id'] ? 'selected' : '' ?>>
                    <?= $kat['ime'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit" name="shrani">Shrani</button>
    </form>
<?php endif; ?>
</div>
            <div>
                <p>
                    <a href ="admin.php">Nazaj na admin nadzorno ploščo</a>
                </p>  
            </div>
</body>
</html>
