<div id="glava">
	<?php
	include_once 'seja.php';

	if (isset($_SESSION['idu'])) {
        echo'<div class="desno">';
		echo "Prijavljeni ste kot ".$_SESSION['name']." ".$_SESSION['surname'];
		echo ' <a href="odjava.php">Odjava</a>';
        echo '</div>';
	} else {
		echo '<a class="desno" href="prijava.php">Prijava</a>
         <a class="desno" href="registracija.php">Registracija</a>';
	}
	?>
</div>
