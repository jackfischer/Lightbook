<?php
	/*
		UserCake Version: 1.0
		http://usercake.com
		

	*/
	include("models/config.php");
	
	//Prevent the user visiting the logged in page if he/she is not logged in
	if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
?>
<?php
	/* 
		Below is a very simple example of how to process a login request.
		Some simple validation (ideally more is needed).
	*/

//Forms posted
if(!empty($_POST))
{
		$errors = array();
		$email = $_POST["email"];

		//Perform some validation
		//Feel free to edit / change as required
		
		if(trim($email) == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_EMAIL");
		}
		else if(!isValidEmail($email))
		{
			$errors[] = lang("ACCOUNT_INVALID_EMAIL");
		}
		else if($email == $loggedInUser->email)
		{
				$errors[] = lang("NOTHING_TO_UPDATE");
		}
		else if(emailExists($email))
		{
			$errors[] = lang("ACCOUNT_EMAIL_TAKEN");	
		}
		
		//End data validation
		if(count($errors) == 0)
		{
			$loggedInUser->updateEmail($email);
		}
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Contact Details | <?php echo $websiteName; ?> </title>
<?php require_once("head_inc.php"); ?>

</head>
<body>
   
       <?php
                if(!empty($_POST))
                {
                    if(count($errors) > 0)
                    {
                ?>
                <div id="errors">
                <?php errorBlock($errors); ?>
                </div>     
                <?php
                     } else { ?> 
            <div id="success">
            
               <p><?php echo lang("ACCOUNT_DETAILS_UPDATED"); ?></p>
               
            </div>
            <?php } }?>

    
                <form name="changePass" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            
                <p>
                    <label>Email:</label>
                    <input type="text" name="email" value="<?php echo $loggedInUser->email; ?>" />
                </p>
               </div>

<input type="submit" class="btn btn-primary" name="new" id="newfeedform" value="Update" />
                
                </form>
            
</body>
</html>

