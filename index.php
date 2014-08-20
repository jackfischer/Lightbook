<?php

require_once("models/config.php");

if(!isUserLoggedIn())
{ 
 include('register.php'); 
 echo "<br><br><br>Or login:";
 include('login.php');
	
} else { 

 header("Location: profile.php"); 	 

} ?>
