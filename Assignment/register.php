<?php 
// This script performs an INSERT query to add a record to the users table.

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('dbcontroller1.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Validation for: 	
	// Email address:
	if (!empty($_POST['email'])) {
	    $q = "SELECT * FROM user where email ='".$_POST['email']."'";
	    $r = @mysqli_query ($dbc, $q);
	    $rows = mysqli_num_rows($r);
	    if($rows >= 1){
	        $errors[] = '- Your email address already exists in the database.';
	    }else{
	        //if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	        if (preg_match("/^[\w\-\.]+@([\w]+\.)+[\w]{2,4}$/", $_POST['email'])) {
	            $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	        } else {
	            $errors[] = '- Your email address does not match the required format.';
	        }
	    }
	} else {
	    $errors[] = '- Please enter your email address.';
	}	
	
	// First name:
	if (empty($_POST['fname'])) {
	    $errors[] = '- Please enter your first name.';
	} else {
	    $fn = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	}
	
	// Last name:
	if (empty($_POST['lname'])) {
	    $errors[] = '- Please enter your last name.';
	} else {
	    $ln = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	}	
	
	// Password:
	if (!empty($_POST['pass1'])) {
	    if ($_POST['pass1'] != $_POST['pass2']) {
	        $errors[] = '- Your password does not match the confirmed password.';
	        
	    } else if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z]).{3,}$/", $_POST['pass1'])){
	        $errors[] = '- Your password must contain at least 3 characters with a combination of letters and numbers.';
	        
	    } else {
	        $p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
	    }
	} else {
	    $errors[] = '- Please enter your password.';
	}	
	
	// Address:
	if (empty($_POST['address'])) {
	    $a = NULL;
	} else {
	    $a = mysqli_real_escape_string($dbc, trim($_POST['address']));
	}
	
	// Phone number:
	   if (!empty($_POST['phoneNo'])) {
	       if (preg_match("/^01[0-9]\-\d{7,8}$/", $_POST['phoneNo'])) {
	           $pn = mysqli_real_escape_string($dbc, trim($_POST['phoneNo']));
	       } else {
	           $errors[] = '- Your phone number does not match the required format.';
	       }
	   } else {
	       $pn = NULL;
	   }
	   
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
        $q = "INSERT INTO user (fname, lname, email, pass, address, phoneNo, registerDate) VALUES ('$fn','$ln','$e',SHA1('$p'),'$a','$pn',NOW() )";
		$r = @mysqli_query ($dbc, $q); // Run the query.
		$back = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL); //Go to previous page link
		
		if ($r) { // If it ran OK.
		
			// Print success message:
			echo '<script>alert("Thank you!\n You have registered successfully.");</script>';
			echo '<script>window.location.href = "'. $back .'";</script>';
		
		} else { // If it did not run OK.
			
			// Public message:
		    echo '<script>alert("You could not be registered due to a system error.\n We apologize for any inconvenience caused.");</script>';
		    echo '<script>window.location.href = "'. $back .'";</script>';
		    
			// Debugging message:
			//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
		
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		exit();
		
	} else { // Report the errors.
	    // Alert box error messages
	    echo '<script>alert("'.implode("\\n", $errors).'");</script>';
	}
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>

  <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Member Sign Up</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <link rel="stylesheet" href="css/form.css"/>
    </head>
    
    <body>
        <div class="form">
          <button class="icon" title="Cancel" onclick="document.location='viewUser.php'">
			<i class="fas fa-times"></i>
		  </button>
          <form method="post" action="register.php">
            <header class="head-form">
                <h2>Member Sign Up</h2>
      			<p>Be a member to shop online with us and to be the first to find out about our latest promotions and other fantastic offers!</p>
      			<br>
        		<p><label>Please fill up all fields marked with *</label></p>
            </header>
            
            <fieldset>
        		<input type="text" name="email" id="email" placeholder="Email address *" size="40" maxlength="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> 
				<input type="password" name="pass1" size="30" maxlength="30" placeholder="Password *" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  />
				<input type="password" name="pass2" size="30" maxlength="30" placeholder="Re-enter Password *" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  />
				<input type="text" name="fname" size="40" maxlength="30" placeholder="First Name *" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" />
				<input type="text" name="lname" size="40" maxlength="30" placeholder="Last Name *" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" />
				<label> Residential Address: </label>
				<textarea name="address" rows="5" maxlength="255"><?php if (isset($_POST['address'])) echo $_POST['address']; ?></textarea>   
				<input type="text" name="phoneNo" size="30" placeholder="Phone No: (eg.012-3456789)" value="<?php if (isset($_POST['phoneNo'])) echo $_POST['phoneNo']; ?>">
			</fieldset>
			
			<div style="text-align:center">
                <input type="submit" name="submit" value="Sign up!">
                <input type="reset" value="Reset">
            </div>
          </form>
		</div>
    </body>
  </html>