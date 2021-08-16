<?php 
// Retrieve all the records from the users table.

session_start(); // Start the session.

//If no session value is present, redirect the user:
if (!isset($_SESSION['adminID'])) {
    
    // Need the functions:
    require ('login_functions.php');
    redirect_user('loginUser.php');
}

// Connect to the db.
require ('dbcontroller1.php'); 

// Number of records to show per page:
$display = 5;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} 

// Count the number of records:
$q = "SELECT COUNT(userID) AS c FROM user";
$r = @mysqli_query ($dbc, $q);
$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
$records = $row[0];

// Calculate the number of pages...
if ($records > $display) { // More than 1 page.
    $pages = ceil ($records/$display);
} else {
    $pages = 1;
}

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
    case 'fn':
        $order_by = 'fname ASC';
        break;
        
    case 'ln':
        $order_by = 'lname ASC';
        break;
        
    case 'rd':
        $order_by = 'registerDate ASC';
        break;
        
    default:
        $order_by = 'registerDate ASC';
        $sort = 'rd';
        break;
}
	
// Define the query:
$q = "SELECT lname, fname, DATE_FORMAT(registerDate, '%M %d, %Y') AS dr, userID FROM user ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.
?>
<!-- Display data -->
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="css/admin.css"/>
    <title> View Users </title>
</head>
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
          		<?php echo "<a onClick=\"javascript: return confirm('Are you sure you want to log out, {$_SESSION["username"]}?');\" 
                      href=\"logout.php\"><i class=\"fas fa-sign-out-alt\"></i></a> 
          		";?>
          	</div>
  			<h1> Manage Members </h1><br>
  			<?php echo ' <table>
                            <tr>
                              <td> All Members ('.$records.')</td>
                              <td class="add-btn"> <a href="register.php"> Add New Member </a></td>
                            </tr>
                            <tr>
                              <td colspan=2>
                                  <table>
                                    <tr>
                                       <th><a href="viewUser.php?sort=fn">First Name <i class="fas fa-sort-amount-up"></i></a></th>
                                       <th><a href="viewUser.php?sort=ln">Last Name <i class="fas fa-sort-amount-up"></i></a></th>
                                       <th><a href="viewUser.php?sort=rd">Date Registered <i class="fas fa-sort-amount-up"></i></a></th>
                	                   <th colspan="2" style="text-align:center;">Options</th>
                                    </tr>
                                    ';
            // Fetch and print all the records
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            		echo '<tr>
            		<td>' . $row['fname'] . '</td>
            		<td>' . $row['lname'] . '</td>
            		<td>' . $row['dr'] . '</td>
            		<td style="text-align:right;"><a href="editUser.php?id=' . $row['userID'] . '">Edit</a></td>
            		<td style="text-align:center;"><a href="deleteUser.php?id=' . $row['userID'] . '">Delete</a></td>
            	</tr>
            	';
            } // End of WHILE loop.
            
            echo '</table> </td></tr></table>';
            ?>
  		</div>
  		<?php 
  		// Make the links to other pages, if necessary.
        if ($pages > 1) {
        	
        	echo '<br /><p>';
        	$current_page = ($start/$display) + 1;
        	
        	// If it's not the first page, make a Previous button:
        	if ($current_page != 1) {
        	    echo '<div class="prev-btn">';
        		echo '<a href="viewUser.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Prev</a> ';
        		echo '</div>';
        	}
        	echo '<div class="con-btn">';
        	// Make all the numbered pages:
        	for ($i = 1; $i <= $pages; $i++) {
        		if ($i != $current_page) {
        		    echo '<span class="pg-btn">';
        			echo '<a href="viewUser.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
        			echo '</span>';
        		} else {
        		    echo '<span class="cur-btn">';
        			echo $i . ' ';
        			echo '</span>';
        		}
        	} // End of FOR loop.
        	echo '</div>';
        	// If it's not the last page, make a Next button:
        	if ($current_page != $pages) {
        	    echo '<div class="next-btn">';
        		echo '<a href="viewUser.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
        		echo '</div>';
        	}
        	echo '</p>'; // Close the paragraph.
        } // End of links section.
        ?>
	</div>    
</body>
</html>

<?php 
mysqli_free_result ($r); //Free memory associated with the result
mysqli_close($dbc); //Close database connection
?>