<?php
require_once 'baza.php';

// Brisanje uporabnika
if (isset($_GET['izbrisi'])) {
    $id = $_GET['izbrisi'];
    mysqli_query($link, "DELETE FROM uporabniki WHERE id_u = $id");
    header("Location: upravljanje_upo.php");
    exit;
}

// Urejanje uporabnika (prikažemo v obrazcu)
$uredi = null;
if (isset($_GET['uredi'])) {
    $id = $_GET['uredi'];
    $uredi = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM uporabniki WHERE id_u = $id"));
}

// Shrani spremembe
if (isset($_POST['shrani'])) {
    $id = $_POST['id_u'];
    $ime = $_POST['ime'];
    $priimek = $_POST['priimek'];
    $naslov = $_POST['naslov'];
    $email = $_POST['email'];
    $geslo = $_POST['geslo'];
    $telefon = $_POST['telefonska_stevilka'];
    $kraj_id = $_POST['kraj_id'];
    $vloga = $_POST['vloga'];

    mysqli_query($link, "
        UPDATE uporabniki SET 
            ime = '$ime',
            priimek = '$priimek',
            naslov = '$naslov',
            email = '$email',
            geslo = '$geslo',
            telefonska_stevilka = '$telefon',
            kraj_id = '$kraj_id',
            vloga = '$vloga'
        WHERE id_u = $id
    ");

    header("Location: upravljanje_upo.php");
    exit;
}

// Izpis vseh uporabnikov s kraji
$rezultat = mysqli_query($link, "
    SELECT u.*, k.kraj 
    FROM uporabniki u
    JOIN kraji k ON u.kraj_id = k.id_k
");

// Kraji za <select>
$kraji = mysqli_query($link, "SELECT * FROM kraji");
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Upravljanje uporabnikov</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>
    <h2>Seznam uporabnikov</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Ime</th><th>Priimek</th><th>Naslov</th><th>Email</th><th>Geslo</th>
            <th>Telefonska številka</th><th>Kraj</th><th>Vloga</th><th>Možnosti</th>
        </tr>

        <?php while ($vr = mysqli_fetch_assoc($rezultat)) : ?>
        <tr>
            <td><?= $vr['ime'] ?></td>
            <td><?= $vr['priimek'] ?></td>
            <td><?= $vr['naslov'] ?></td>
            <td><?= $vr['email'] ?></td>
            <td><?= $vr['geslo'] ?></td>
            <td><?= $vr['telefonska_stevilka'] ?></td>
            <td><?= $vr['kraj'] ?></td>
            <td><?= $vr['vloga'] ?></td>
            <td>
                <a href="?uredi=<?= $vr['id_u'] ?>">Uredi</a> |
                <a href="?izbrisi=<?= $vr['id_u'] ?>">Izbriši</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

<?php if ($uredi): ?>
    <hr>
    <h3>Uredi uporabnika</h3>
    <form method="post">
        <input type="hidden" name="id_u" value="<?= $uredi['id_u'] ?>">

        <input type="text" name="ime" value="<?= $uredi['ime'] ?>" placeholder="Ime"><br><br>
        <input type="text" name="priimek" value="<?= $uredi['priimek'] ?>" placeholder="Priimek"><br><br>
        <input type="text" name="naslov" value="<?= $uredi['naslov'] ?>" placeholder="Naslov"><br><br>
        <input type="email" name="email" value="<?= $uredi['email'] ?>" placeholder="Email"><br><br>
        <input type="text" name="geslo" value="<?= $uredi['geslo'] ?>" placeholder="Geslo"><br><br>
        <input type="text" name="telefonska_stevilka" value="<?= $uredi['telefonska_stevilka'] ?>" placeholder="Telefonska številka"><br><br>

        <select name="kraj_id">
            <?php while ($k = mysqli_fetch_assoc($kraji)) : ?>
                <option value="<?= $k['id_k'] ?>" <?= $k['id_k'] == $uredi['kraj_id'] ? 'selected' : '' ?>>
                    <?= $k['kraj'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <input type="text" name="vloga" value="<?= $uredi['vloga'] ?>" placeholder="Vloga (npr. uporabnik, admin)"><br><br>

        <button type="submit" name="shrani">Shrani spremembe</button>
    </form>
<?php endif; ?>

<p><a href="index.php">Domov</a></p>
</body>
</html>
