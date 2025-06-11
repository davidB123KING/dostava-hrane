<?php
require_once 'baza.php';
include_once 'seja.php';

if(isset($_POST['subm'])){
	$p=$_POST['email'];
	$g=$_POST['geslo'];
	/*$g2=sha1($g);*/
	/*echo $p." in ".$g;*/
	$query="SELECT * FROM uporabniki WHERE email='$p' AND geslo='$g' ;"; /*g2*/
	$result=mysqli_query($link ,$query);
	if(mysqli_num_rows($result)===1){
		$row=mysqli_fetch_array($result);
		/*echo $row['ime'] ." in ". $row['priimek'];*/
		$_SESSION['name']=$row['ime'];
		$_SESSION['surname']=$row['priimek'];
		$_SESSION['vloga']= $row['vloga'];
		$_SESSION['idu']=$row['id_u'];
		$_SESSION['log']=TRUE;

		if ($row['vloga'] === 'admin') {
        header("refresh:1;url= admin.php");
    } 
	if ($row['vloga'] === 'dostavljalec') {
		header("refresh:1;url= dostavljalec.php");
	}
	
	else {
        header("refresh:1;url= index.php");
    }
	}
}

?>

<!DOCTYPE html>
<html lang="sl">
<head>
<title>prijavaPHP</title>
<link rel="stylesheet" href="oblika.css">
</head>
<body>
	<div class="vse">
<h1>PRIJAVA UPORABNIKA</h1>
	<form method="post" action="#">
		<p>Vnesi <b>e-mail</b><input type="email" name="email" placeholder="vnesi e-mail" required></p>
		<p>Vnesi <b>geslo</b><input type="password" name="geslo" placeholder="vnesi geslo"required></p>
		<p><input type="submit" name="subm" value="prijava"></p>
	</form>
	<p>
		<a href="index.php">Domov</a>
	</p>
	</div>
</body>
</html>