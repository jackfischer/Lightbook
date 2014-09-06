<?php
require_once('models/config.php');
require('dbconnect.php');

$user_id = $loggedInUser->user_id;

$STH = $DBH->prepare("select s.content, s.timestamp, u.username from (select content, timestamp, user_id from stories where user_id like :user_id) s inner join userpie_users u on s.user_id=u.user_id");

$STH->execute(array(':user_id' => $user_id));

$STH->setFetchMode(PDO::FETCH_ASSOC);

foreach ($STH->fetchAll() as $story) {
	echo "<div class=\"panel panel-default\">";
	echo "<div class=\"panel-heading\">";
	echo "<img src=\"//placehold.it/150x150\" class=\"img-circle pull-left\">";
	echo "<div class=\"leftcolumn\">" . $story['username'] . "</div><div class=\"rightcolumn\"><i class=\"fa fa-list\"></i></div>";
	echo "</div><br><br>";
	echo "<div class=\"panel-body\">";
	echo "<p>" . $story['content'] . "</p>";
	echo "<hr><form><div class=\"input-group\"><div class=\"input-group-btn\"><button class=\"btn btn-default\"><i class=\"fa fa-thumbs-up\"></i> Like</button><button class=\"btn btn-default\"><i class=\"fa fa-share-square-o\"></i> Repost</button>";
	echo "</div><input type=\"text\" class=\"form-control\" placeholder=\"Add a comment..\"></div></form></div></div>";


	echo $story['timestamp'] . "<br>";


}

?>

