<?php
require_once'baza.php';
$sql="SELECT * FROM kraji;";
$result= mysqli_query($link ,$sql);
?>

<!DOCTYPE html>
<html lang="sl">
<head>
<title>registracija</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="oblika.css">
</head>
<body>
    <div class="vse">
        
	<h1>Vstavljanje uporabnika</h1>
	
	<form method="post"action="dobljeni_upo.php">
		<p>Ime:<input type="text"name="ime"placeholder="vnesi ime"required></p>
		<p>Priimek:<input type="text"name="priimek"placeholder="vnesi priimek"required></p>
        <p>Naslov:<input type="text"name="naslov"placeholder="vnesi naslov"required></p>
		<p>Mail:<input type="email"name="email"placeholder="vnesi mail"required></p>
		<p>Geslo:<input type="password"name="geslo"placeholder="vnesi geslo"></p>
        <p>Telefon:<input type="tel"name="telefonska-stevilka"placeholder="vnesi telefon"required></p>
        <p>Izberi vlogo<select name="vloga" required>
        <option value="uporabnik">uporabnik</option>
        <option value="dostavljalec">kurir</option>
        <option value="admin">restavracija</option>
        </select></p>
		<p>Kraj:<select name="kraj_id" required>
		<?php
		while($row=mysqli_fetch_array($result)){
			echo '<option value="'.$row['id_k'].'">'.$row['kraj'].'</option>';
		}
		?>
		
			</select></p>
		<input type="submit" value="vpis" name="subm">
	</form>
	<p>
	<a href="index.php">Domov</a>
	</p>
    </div>
</body>
</html>