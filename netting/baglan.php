<?php 

try {
	$db=new PDO("mysql:host=localhost;dbname=akucu",'username','password');



} 
catch(PDOExpception $e){


	echo $e->getMessage();
}
$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
 ?>
