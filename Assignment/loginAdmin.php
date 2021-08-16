<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Need helper file:
    require ('login_functions.php');
    
    // Need the database connection:
    require ('dbcontroller1.php');
    
    // Check the login:
    list ($check, $data) = admin_login($dbc, $_POST['username'], $_POST['pass']);
    
    if ($check) { // OK!
        
        // Set the session data:
        session_start();
        $_SESSION['adminID'] = $data['adminID'];
        $_SESSION['username'] = $data['username'];
        
        // Redirect:
        redirect_user('dashboard.php');
        
    } else { // Unsuccessful!
        
        // Assign $data to $errors:
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
	<title>Admin Login</title>
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
		<form action="loginAdmin.php" method="POST">
			<header>
				<h2>Admin Login</h2>
				<p>Please enter your username and password</p>
			</header>
			<table>
				<tr>
					<td>Username</td>
					<td><input id="txt-input" type="text" class="form-input" name="username" placeholder="Username"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input id="pwd" type="password" class="form-input" name="pass" placeholder="Password"></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center"><input class="btn btn-success" type="submit" value="Login"></td>
				</tr>
			</table>
			<div class="link">
				<a href="loginUser.php">User Login</a>
				&nbsp;|&nbsp;
				<a href="http://localhost/phpmyadmin/" target="_blank">Forgot password?</a>
			</div>		
		</form>
	</div>
</body>
</html>