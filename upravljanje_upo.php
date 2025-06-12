<?php
require_once 'baza.php';

// Brisanje uporabnika
if (isset($_GET['izbrisi'])) {
    $id = $_GET['izbrisi'];
    mysqli_query($link, "DELETE FROM uporabniki WHERE id_u = $id");
    header("Location: upravljanje_upo.php");
    exit;
}

// Posodobi uporabnika
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
    $sql = "UPDATE uporabniki SET 
        ime='$ime', 
        priimek='$priimek', 
        naslov='$naslov', 
        email='$email', 
        geslo='$geslo', 
        telefonska_stevilka='$telefon', 
        kraj_id='$kraj_id', 
        vloga='$vloga' 
        WHERE id_u=$id";

    if (mysqli_query($link, $sql)) {
        echo "Uspešno<br>";
    } else {
        echo "Napaka<br>";
    }
}

// Pridobi uporabnika za urejanje, če je podan GET parameter 'uredi'
$uredi = null;
if (isset($_GET['uredi'])) {
    $id = $_GET['uredi'];
    $rez = mysqli_query($link, "SELECT * FROM uporabniki WHERE id_u = $id");
    $uredi = mysqli_fetch_assoc($rez);
}

// Pridobi vse uporabnike za izpis
$uporabniki = mysqli_query($link, "
    SELECT u.*, k.kraj FROM uporabniki u
    LEFT JOIN kraji k ON u.kraj_id = k.id_k
");

// Pridobi vse kraje za <select> v obrazcu urejanja
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
<table>
    <tr>
        <th>Ime</th><th>Priimek</th><th>Email</th><th>Kraj</th><th>Vloga</th><th>Možnosti</th>
    </tr>
    <?php while ($u = mysqli_fetch_assoc($uporabniki)): ?>
    <tr>
        <td><?= $u['ime'] ?></td>
        <td><?= $u['priimek'] ?></td>
        <td><?= $u['email'] ?></td>
        <td><?= $u['kraj'] ?></td>
        <td><?= $u['vloga'] ?></td>
        <td>
            <a href="upravljanje_upo.php?uredi=<?= $u['id_u'] ?>">Uredi</a> | 
            <a href="upravljanje_upo.php?izbrisi=<?= $u['id_u'] ?>">Izbriši</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<p><a href="admin.php">Nazaj</a></p>

<?php if ($uredi): ?>
<hr>
<h2>Uredi uporabnika</h2>
<form method="post" action="upravljanje_upo.php">
    <input type="hidden" name="id_u" value="<?= $uredi['id_u'] ?>">
    <input type="text" name="ime" value="<?= $uredi['ime'] ?>" placeholder="Ime"><br><br>
    <input type="text" name="priimek" value="<?= $uredi['priimek'] ?>" placeholder="Priimek"><br><br>
    <input type="email" name="email" value="<?= $uredi['email'] ?>" placeholder="Email"><br><br>
    <input type="text" name="naslov" value="<?= $uredi['naslov'] ?>" placeholder="Naslov"><br><br>
    <input type="text" name="geslo" value="<?= $uredi['geslo'] ?>" placeholder="Geslo"><br><br>
    <input type="text" name="telefonska_stevilka" value="<?= $uredi['telefonska_stevilka'] ?>" placeholder="Telefon"><br><br>

    <select name="kraj_id">
    <?php
    // Nova poizvedba samo za ta select
    $kraji = mysqli_query($link, "SELECT * FROM kraji");
    while ($k = mysqli_fetch_assoc($kraji)) {
        $sel = ($k['id_k'] == $uredi['kraj_id']) ? "selected" : "";
        echo "<option value='{$k['id_k']}' $sel>{$k['kraj']}</option>";
    }
    ?>
</select><br><br>


    <input type="text" name="vloga" value="<?= $uredi['vloga'] ?>" placeholder="Vloga"><br><br>

    <button type="submit" name="shrani">Shrani</button>
</form>
<?php endif; ?>

</body>
</html>