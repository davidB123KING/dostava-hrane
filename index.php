<?php
include_once 'seja.php';
require_once 'baza.php';
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" href="oblika.css">
</head>
<body>

<div class="meni">
    <a href="index.php">Domov</a>
    <a href="meni.php">Meni</a>
    <a href="kosarica.php">Košarica</a>
    <span id="glava"><?php include 'glava.php'; ?></span>
</div>

<div class="vse">
        <div id="notranji">

    <a href="meni.php" class="restavracija" >
        <img src="jp.png" alt="1">
        <h2>James Place</h2>
        <p>Pridi in pojej kar si želiš.</p>
    </a>

    <a href="meni.php" class="restavracija" >
        <img src="velun.jfif" alt="2">
        <h2>Velun</h2>
        <p>Ko hočeš pico prideš sem</p>
    </a>

    <a href="meni.php" class="restavracija" >
        <img src="kitajska.jfif" alt="3">
        <h2>Kitajska restvracija</h2>
        <p>Pridi po azijske dobrote</p>
    </a>
</div>
</div>
<footer>
  <a href="povezave.php">
    <img src="footer.png" alt="fohjtra">
  </a>
</footer>

</body>
</html>
