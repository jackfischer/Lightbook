<?php

require('models/settings.php');

try {
	$DBH = new PDO("mysql:host=localhost;dbname=lightbook", $db_user, $db_pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
	echo $e->getMessage(); 
}

?>
