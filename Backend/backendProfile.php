<?php

require_once('../models/config.php');
require('dbconnect.php');

$user_id = $loggedInUser->user_id;

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
