<?php

require_once("models/config.php");

if(!isUserLoggedIn())
{ 
 include('register.php'); 
 echo "<br><br><br>Or login:<br>";
 include('login.php');
	
} else { 

 header("Location: newsfeed.php"); 	 

} ?>
