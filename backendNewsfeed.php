<?php

require('models/settings.php');
require_once('models/config.php');

try {
	$DBH = new PDO("mysql:host=localhost;dbname=lightbook", $db_user, $db_pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
	echo $e->getMessage(); 
}


$STH = $DBH->query("select s.content, s.timestamp, u.username from stories s inner join userpie_users u on s.user_id=u.user_id");

$STH->setFetchMode(PDO::FETCH_ASSOC);

while($story = $STH->fetch()) {
	echo $story['username'] . "<br>";
	echo $story['content'] . "<br>";
	echo $story['timestamp'] . "<br>";
	echo "<br>";
}


?>
