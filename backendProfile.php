<?php

require('models/settings.php');
require_once('models/config.php');


$user_id = $loggedInUser->user_id;
echo $user_id;

try {
	$DBH = new PDO("mysql:host=localhost;dbname=lightbook", $db_user, $db_pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
	echo $e->getMessage(); 
}


$STH = $DBH->prepare("select s.content, s.timestamp, u.username from (select content, timestamp, user_id from stories where user_id like :user_id) s inner join userpie_users u on s.user_id=u.user_id");

$STH->execute(array(':user_id' => $user_id));

$STH->setFetchMode(PDO::FETCH_ASSOC);

foreach ($STH->fetchAll() as $story) {
	echo $story['username'] . "<br>";
	echo $story['content'] . "<br>";
	echo $story['timestamp'] . "<br>";
	echo "<br>";
}

?>
