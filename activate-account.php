<?php
	/*
		UserPie Version: 1.0
		http://userpie.com
		

	*/
	require_once("models/config.php");
	
	//Prevent the user visiting the logged in page if he/she is already logged in
	if(isUserLoggedIn()) { header("Location: index.php"); die(); }
?>
<?php
	/* 
		Activate a users account
	*/
$errors = array();

//Get token param
if(isset($_GET["token"]))
{
		
		$token = $_GET["token"];
		if(!isset($token))
		{
			$errors[] = lang("FORGOTPASS_INVALID_TOKEN");
		}
		else if(!validateactivationtoken($token)) //Check for a valid token. Must exist and active must be = 0
		{
			$errors[] = "Token does not exist / Account is already activated";
		}
		else
		{
			//Activate the users account
			if(!setUseractive($token))
			{
				$errors[] = lang("SQL_ERROR");
			}
		}
}
else
{
	$errors[] = lang("FORGOTPASS_INVALID_TOKEN");
}

?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Activation | <?php echo $websiteName; ?> </title>
<?php require_once("head_inc.php"); ?>
</head>
<body>

	<?php
				if(count($errors) > 0)
				{
      errorBlock($errors);
           		 } else { ?> 
       <p>Activation Complete. You may now <a href="login.php">login.</a></p>    		 
           		 
    		    <?php }?>

               
</body>
</html>
