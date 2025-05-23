<div id="glava">
	<?php
	include_once 'seja.php';

	if (isset($_SESSION['idu'])) {
		echo "Prijavljeni ste kot ".$_SESSION['name']." ".$_SESSION['surname'];
		echo ' <a href="odjava.php">Odjava</a>';
	} else {
		echo '<a  href="prijava.php">Prijava</a>
         <a  href="registracija.php">Registracija</a>';
	}
	?>
</div>
