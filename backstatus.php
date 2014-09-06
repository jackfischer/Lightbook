<?php
require_once('models/config.php');
require('dbconnect.php');

$user_id = $loggedInUser->user_id;
$content = $_POST["content"];

$STH = $DBH->prepare("insert into stories (content, user_id) values (:content, :user_id)");

$STH->execute(array(':user_id' => $user_id, ':content' => $content));


?>

