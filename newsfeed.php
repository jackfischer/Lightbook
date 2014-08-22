<?php 
	require_once("models/config.php");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile | <?php echo $websiteName; ?> </title>
<?php require_once("head_inc.php"); ?>
</head>
<body>

You are logged in as: <?php echo $loggedInUser->display_username; ?>

<br>
newsfeed here

</body>
</html>


