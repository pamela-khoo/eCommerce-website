<?php
// Process user login form submission.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Need helper files:
    require ('login_functions.php');
    
    // Need the database connection:
    require ('dbcontroller1.php');
    
    // Check the login:
    list ($check, $data) = user_login($dbc, $_POST['email'], $_POST['pass']);
    
    if ($check) { // OK!
        
        // Set the session data:
        session_start();
        $_SESSION['userID'] = $data['userID'];
        $_SESSION['fname'] = $data['fname'];
        
        // Redirect:
        redirect_user('home.php');
        
    } else { // Unsuccessful!
        
        // Assign $data to $errors :
        $errors = $data;
    }
    mysqli_close($dbc); // Close the database connection.
}

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
    // Alert box error messages
    echo '<script>alert("'.implode("\\n", $errors).'");</script>';
}

// Display the form:
?>

<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="css/login.css"/>
</head>

<body class="main">
	<div class="home-position">
		<div class="home" onclick="location.href='home.php';">
    		<div class="home_t"></div>
		</div>
	</div>
	<div class="con">
		<form action="loginUser.php" method="POST">
			<header>
				<h2>User Login</h2>
				<p>Please enter your username and password</p>
			</header>
			<table>
				<tr>
					<td>Username</td>
					<td><input id="txt-input" type="text" class="form-input" name="email" placeholder="Email Address"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input id="pwd" type="password" class="form-input" name="pass" placeholder="Password"></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center"><input class="btn btn-success" type="submit" name="submit" value="Login"></td>
				</tr>
			</table>
			<div class="link">
				<a href="loginAdmin.php">Administrator Login</a>
				&nbsp;|&nbsp;
				<a href="register.php">Create new account</a>
			</div>		
		</form>
	</div>
</body>
</html>