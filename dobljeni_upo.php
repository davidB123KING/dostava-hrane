<?php
require_once 'baza.php';
$i=$_POST ['ime'];
$p=$_POST['priimek'];
$n=$_POST['naslov'];
$e=$_POST['email'];
$g=$_POST['geslo'];
$t=$_POST['telefonska_stevilka'];
$k=$_POST['kraj_id'];
$v=$_POST['vloga'];


/*$g2=sha1($g);*/

/*echo "$i in $p in $m in $g in $k";*/
$query="INSERT INTO uporabniki VALUES (NULL ,'$i' ,'$p','$n', '$e' ,'$g' ,'$t','$k','$v' );";/*g=g2*/

if($result=mysqli_query($link ,$query)){
	header("refresh:3;url=prijava.php");
	echo'Vnos je bil uspešen';
}
else{
	header("Location:registracija.php");
}
