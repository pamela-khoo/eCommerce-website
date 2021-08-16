<?php
// The user is redirected here from loginAdmin.php.

session_start(); // Start the session.

//If no session value is present, redirect the user:
 if (!isset($_SESSION['adminID'])) {

	// Need the functions:
	require ('login_functions.php');
	echo '<script>alert("Please log in to access this page!");</script>';
	echo '<script>window.location.href = "loginAdmin.php";</script>';
}
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<link rel="stylesheet" href="css/admin.css"/>
	<title> Dashboard </title>
</head>

<?php 
require ('dbcontroller1.php'); 

// Count the number of records for:
// User:
$q = "SELECT COUNT(userID) FROM user";
$r = @mysqli_query ($dbc, $q);
$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
$record = $row[0];

$q = "SELECT CONCAT(CONCAT(fname,' '),lname) AS name, DATE_FORMAT(registerDate, '%d %b %Y') AS date, userID FROM user ORDER BY registerDate DESC LIMIT 4";
$r = @mysqli_query ($dbc, $q); // Run the query.

// Product:
$qP = "SELECT COUNT(prodID) FROM product";
$rP = @mysqli_query ($dbc, $qP);
$rowP = @mysqli_fetch_array ($rP, MYSQLI_NUM);
$recordP = $rowP[0];

$qP = "SELECT name, description, image FROM product ORDER BY date DESC LIMIT 2";
$rP = @mysqli_query ($dbc, $qP); // Run the query.

// Admin:
$qA = "SELECT COUNT(adminID) FROM admin";
$rA = @mysqli_query ($dbc, $qA);
$rowA = @mysqli_fetch_array ($rA, MYSQLI_NUM);
$recordA = $rowA[0];
?>

<body>
<div class="con">
  <div class="sidenav">
  	<div class="sidenav-logo">
  		<a href="dashboard.php"><img src="img/image.png" style="width:185px; height:80px"></a>
  	</div>
  	<div class="sidenav-opt">
      	<a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      	<a href="viewProduct.php"> <i class="fas fa-tags"></i> Products</a>
      	<a href="viewUser.php"> <i class="fas fa-users"></i> Members</a>
  	</div>
  </div>
  <div class="content">
  	<div class="header">
  		<?php echo "<span>Welcome, {$_SESSION['username']}!</span>
                    <a onClick=\"javascript: return confirm('Are you sure you want to log out, {$_SESSION["username"]}?');\" href=\"logout.php\">
                    <i class=\"fas fa-sign-out-alt\"></i></a> 
  		";?>
  	</div>
  	<h1> Dashboard </h1>
  	<div class="col-30">
		<div class="icon-bg icon-1">
			<i class="fas fa-tags fa-2x"></i>
		</div>
		<div class="desc">
			All Products <br> <font size="+2"><strong> <?php echo "$recordP";?> </strong></font>
		</div>
	</div>
	<div class="col-30">
		<div class="icon-bg icon-2">
			<i class="fas fa-users fa-2x"></i>
		</div>
		<div class="desc">
			Total Admins <br> <font size="+2"><strong> <?php echo "$recordA";?> </strong></font>
		</div>
	</div>
	<div class="col-30">
		<div class="icon-bg icon-3">
			<i class="fas fa-users fa-2x"></i>
		</div>
		<div class="desc">
			Total Members <br> <font size="+2"><strong> <?php echo "$record";?> </strong></font>
		</div>
	</div>
	<div class="col-40">
		<div class="desc">
			<strong>New Members</strong>
			<span style="float:right;"><a href="viewUser.php"> View all users >>></a></span>
			<?php while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			echo '
			<div class="user">
				<span><img src="img/default.png"></span>
				      <p> ' . $row['name'] . ' </p>
				      <p style="color:#9696bb;"> ' . $row['date'] . ' </p>
			</div>
			'; 
			}
			?>
		</div>
	</div>
	<div class="col-60">
		<div class="desc">
			<strong>Recently Added Products</strong>
			<span style="float:right;"><a href="viewProduct.php"> View all products >>></a></span>
			<ul class="product">
				<?php while ($rowP = mysqli_fetch_array($rP, MYSQLI_ASSOC)) {
        			echo '
        			<li>
                        <div class="product-img"> <img src=" '. $rowP['image']. '" style="height:80px; width:80px;"> </div>
					    <div class="product-desc">
            				<p> ' . $rowP['name'] . ' </p>
    						<p style="color:#9696bb;"> ' . $rowP['description'] . ' </p>
    						<br><br>
    					</div>
        			</li>
        			'; 
        			}
        		?>				
			</ul>
		</div>
	</div>
  </div>
</div>
</body>
</html> 
