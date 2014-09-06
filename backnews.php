<?php

require_once('models/config.php');
require_once('backend/dbconnect.php');


$STH = $DBH->query("select s.content, s.timestamp, u.username from stories s inner join userpie_users u on s.user_id=u.user_id");

$STH->setFetchMode(PDO::FETCH_ASSOC);

while($story = $STH->fetch()) {
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
