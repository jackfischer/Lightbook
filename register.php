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
		Below is a very simple example of how to process a new user.
		 Some simple validation (ideally more is needed).
		
		The first goal is to check for empty / null data, to reduce workload here we let the user class perform it's own internal checks, just in case they are missed.
	*/

//Forms posted
if(!empty($_POST))
{
		$errors = array();
		$email = trim($_POST["email"]);
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		$confirm_pass = trim($_POST["passwordc"]);
	
		//Perform some validation
		//Feel free to edit / change as required
		
		if(minMaxRange(1,25,$username))
		{
			$errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
		}
		if(minMaxRange(3,50,$password) && minMaxRange(8,50,$confirm_pass))
		{
			$errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
		}
		else if($password != $confirm_pass)
		{
			$errors[] = lang("ACCOUNT_PASS_MISMATCH");
		}
		if(!isValidemail($email))
		{
			$errors[] = lang("ACCOUNT_INVALID_EMAIL");
		}
		//End data validation
		if(count($errors) == 0)
		{	
				//Construct a user object
				$user = new User($username,$password,$email);
				
				//Checking this flag tells us whether there were any errors such as possible data duplication occured
				if(!$user->status)
				{
					if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
					if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
				}
				else
				{
					//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
					if(!$user->userPieAddUser())
					{
						if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
						if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
					}
				}
		}
	   if(count($errors) == 0) 
	   {
		        if($emailActivation)
		        {
		             $message = lang("ACCOUNT_REGISTRATION_COMPLETE_TYPE2");
		        } else {
		             $message = lang("ACCOUNT_REGISTRATION_COMPLETE_TYPE1");
		        }
	   }
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration | <?php echo $websiteName; ?> </title>
<?php require_once("head_inc.php"); ?>
</head>
<body>
        <div id="success">
        
           <p><?php echo $message ?></p>
           
        </div>
            <div id="regbox">
                <form name="newUser" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                
                <p>
                    <label>Username:</label>
                    <input type="text" name="username" />
                </p>
                
                <p>
                    <label>Password:</label>
                    <input type="password" name="password" />
                </p>
                
                <p>
                    <label>Confirm Password:</label>
                    <input type="password" name="passwordc" />
                </p>
                
                <p>
                    <label>Email:</label>
                    <input type="text" name="email" />
                </p>
    
      </div>

<input type="submit" class="btn btn-primary" name="new" id="newfeedform" value="Register" />
                
                </form>

</body>
</html>
