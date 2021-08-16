<link rel="stylesheet" href="css/form.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<title>Edit User Record</title>

<?php 
// This page is for editing a user record.

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From viewUser.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID.
	echo '<script>alert("This page has been accessed in error.\n Please try again.");</script>';
	echo '<script>window.location.href = "viewUser.php";</script>';
	exit();
}

require('dbcontroller1.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
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
	
	// Email address:
	if (!empty($_POST['email'])) {
	   if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	     $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	   } else {
	     $errors[] = '- Your email address does not match the required format.';
	   }
	} else {
	    $errors[] = '- Please enter your email address.';
	}
	
	// Address:
	if (empty($_POST['address'])) {
	    $a = NULL;
	} else {
	    $a = mysqli_real_escape_string($dbc, trim($_POST['address']));
	}
	
	// Phone number:
	if (empty($_POST['phoneNo'])) {
	    $pn = NULL;
	} else {
	    if (preg_match("/^01[0-9]\-\d{7,8}$/", $_POST['phoneNo'])) {
	        $pn = mysqli_real_escape_string($dbc, trim($_POST['phoneNo']));
	    } else {
	        $errors[] = '- Your phone number does not match the required format.';
	    }
	}
	
	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		$q = "SELECT userID FROM user WHERE email = '$e' AND userID != $id";
		$r = @mysqli_query($dbc, $q);
		
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE user SET fname = '$fn', lname = '$ln', email = '$e', phoneNo ='$pn', address ='$a' WHERE userID = $id LIMIT 1";
			$r = @mysqli_query($dbc, $q);
			
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
			    echo '<script>alert("User profile of '.$fn.' '.$ln.' has been successfully edited.");</script>';
			    echo '<script>window.location.href = "viewUser.php";</script>';
				
			} else { // If it did not run OK.
			    echo '<script>alert("You could not be registered due to a system error.\n We apologize for any inconvenience caused.");</script>';
			    echo '<script>history.back();</script>';
			    // Debugging message echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; 
			}
				
		} else { // Already registered.
			echo '<script>alert("The email address has already been registered in the database.");</script>';
		}	
		
	} else { // Report the errors.

	    echo '<script>alert("'.implode("\\n", $errors).'");</script>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$q = "SELECT fname, lname, email, phoneNo, address FROM user WHERE userID =$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
?>
  <html>
  <body>   
    <div class="form">
    	<button class="icon" title="Cancel" onclick="document.location='viewUser.php'">
			<i class="fas fa-times"></i>
		</button>
		<form action="editUser.php" method="post">
            <fieldset>
            <h2>Edit User Information</h2>
            <br>
        <?php echo '
            <label>First Name: *</label>
			    <input type="text" name="fname" size="15" maxlength="15" value="' . $row[0] . '"/>
            <label>Last Name: *</label>
                <input type="text" name="lname" size="15" maxlength="30" value="' . $row[1] . '"/>
            <label>Email: *</label>
                <input type="text" name="email" size="20" maxlength="60" value="' . $row[2] . '" placeholder="Eg. example@email.com"/>
            <label>Contact No: </label>
                <input type="text" name="phoneNo" size="20" maxlength="20" value="' . $row[3] . '" placeholder="Eg. 012-3456789"/>
            <label>Address: </label> 
             	<textarea name="address" rows="5" maxlength="255">' . $row[4] . '</textarea>
                
                <input type="hidden" name="id" value="' . $id . '" />
        '; ?>             				   
			</fieldset>
            <div style="text-align: center">
                <input type="submit" name="Edit" value="Save">
                <input type="reset" value="Reset">
            </div>
            <br>
            <p>* required fields </p>
        </form>
      </div>
    </body>
  </html>

<?php 
} else { // Not a valid user ID.
    echo '<script>alert("This page has been accessed in error.\n Please try again.");</script>';
    echo '<script>window.location.href = "viewUser.php";</script>';
}
mysqli_close($dbc);
?>

