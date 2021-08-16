<link rel="stylesheet" href="css/form.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	
<?php 
// This page is for deleting a product record.

// Check for a valid product ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From viewProduct.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
    echo '<script>alert("This page has been accessed in error.\n Please try again.");</script>';
    echo '<script>window.location.href = "viewProduct.php";</script>';
	exit();
}

require('dbcontroller1.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Delete the record.
    if($_POST['Delete'] == 'Confirm Delete') {
        
        // Make the query:
        $q = "DELETE FROM product WHERE prodID = $id LIMIT 1";
        $r = @mysqli_query ($dbc, $q);
        
        // If it ran OK.
        if(mysqli_affected_rows($dbc) == 1) {
            // Print a message:
            echo '<script>alert("The product has been deleted.");</script>';
            echo '<script>window.location.href = "viewProduct.php";</script>';
        
        // If the query did not run OK.
        } else {
            // Public message.
            echo '<script>alert("This page has been accessed in error.\n Please try again.");</script>';
            echo '<script>window.location.href = "viewProduct.php";</script>';
            // Debugging message echo '<p>' .mysqli_error($dbc). '<br/> Query: ' .$q. '<p/>';
        }
    
    // No confirmation of deletion.
    } else {
        echo '<script>alert("The product has NOT been deleted.");</script>';
        echo '<script>window.location.href = "viewProduct.php";</script>';
    }
    
} else { // Show the form.

	// Retrieve the product information:
	$q = "SELECT code, name, price FROM product WHERE prodID = $id";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) { // Valid product ID, show the form.

		// Get the product information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// Display the record being deleted:
		?>
		<div class="form">
        		<button class="icon" title="Cancel" onclick="document.location='viewProduct.php'">
        		  <i class="fas fa-times"></i>
        		</button>
    
        		<form action="deleteProduct.php" method="post">
        		  <fieldset>
        		  <h2>Delete Product Details</h2>
        		  <br>
 
				<header class="head-form"><h3>Code :</h3> <?php echo "$row[0]"; ?> <br>
                    <h3>Name :</h3> <?php echo "$row[1]"; ?> <br>
                    <h3>Price :</h3> MYR <?php echo "$row[2]"; ?> <br></header>

                	<input type="submit" name="Delete" value="Confirm Delete" style="width:50%;margin:50px 0px 0px 120px;"/>
                	<?php echo' <input type="hidden" name="id" value="' . $id . '" /> '; ?>
        		  </fieldset>
                </form>
              </div>

<?php 
	} else { // Not a valid product ID.
	    echo '<script>alert("This page has been accessed in error.\n Please try again.");</script>';
	    echo '<script>window.location.href = "viewProduct.php";</script>';
	}
} // End of the main submission conditional.

mysqli_close($dbc);	
?>