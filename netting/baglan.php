<?php 

try {
	$db=new PDO("mysql:host=localhost;dbname=akucu",'akucu','3c1af72.Yusuf');



} 
catch(PDOExpception $e){


	echo $e->getMessage();
}
$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
 ?>