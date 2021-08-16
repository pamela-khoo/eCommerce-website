<link rel="stylesheet" href="css/form.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<title>Edit Product Record</title>

<?php 
// This page is for editing a product record.

// Check for a valid product ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From viewProduct.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID.
	echo '<script>alert("This page has been accessed in error.\n Please try again.");</script>';
	echo '<script>window.location.href = "viewProduct.php";</script>';
	exit();
}

require('dbcontroller1.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
	// Code:
	if (empty($_POST['code'])) {
	    $errors[] = '- Please enter product code.';
	} else {
	    $code = mysqli_real_escape_string($dbc, trim($_POST['code']));
	}
	
	// Name:
	if (empty($_POST['name'])) {
	    $errors[] = '- Please enter product name.';
	} else {
	    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
	}
	
	// Description:
	if (empty($_POST['description'])) {
	    $desc = NULL; 
	} else {
	    $desc = mysqli_real_escape_string($dbc, trim($_POST['description']));
	}
	
	// Image:
	if (empty($_POST['image'])) {
	    $img = NULL;
	} else {
	    $img = mysqli_real_escape_string($dbc, trim($_POST['image']));
	}
	
	// Price:
	if (empty($_POST['price'])) {
	    $errors[] = '- Please enter product price.';
	} else {
	    $price = mysqli_real_escape_string($dbc, trim($_POST['price']));
	}
	
	// Category:
	if (empty($_POST['category'])) {
	    $errors[] = '- Please enter product category.';
	} else {
	    $cat = mysqli_real_escape_string($dbc, trim($_POST['category']));
	}
	
	if (empty($errors)) { // If everything's OK.

    	// Make the query:
    	$q = "UPDATE product SET code = '$code', name = '$name', description = '$desc', image = '$img', price ='$price', category ='$cat' WHERE prodID = $id LIMIT 1";
    	$r = @mysqli_query($dbc, $q);
    	
    	if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
    
    		// Print a message:
    	    echo '<script>alert("Product '.$code.' has been successfully edited.");</script>';
    	    echo '<script>window.location.href = "viewProduct.php";</script>';
    		
    	} else { // If it did not run OK.
    	    echo '<script>alert("You could not be registered due to a system error.\n We apologize for any inconvenience caused.");</script>';
    	    echo '<script>history.back();</script>';
    	    // Debugging message echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; 
    	}	
    	
	} else { // Report the errors.

	    echo '<script>alert("'.implode("\\n", $errors).'");</script>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the product information:
$q = "SELECT code, name, description, image, price, category FROM product WHERE prodID =$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid product ID, show the form.

	// Get the product information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
?>
  <html>  
   <body>   
    <div class="form">
    	<button class="icon" title="Cancel" onclick="document.location='viewProduct.php'">
			<i class="fas fa-times"></i>
		</button>
		<form action="editProduct.php" method="post">
            <fieldset>
            <h2>Edit Product Information</h2>
            <br>
            <?php 
            echo '<label>Product Code: *</label>
                    <input type="text" name="code" size="15" maxlength="15" value="' . $row[0] . '"/>
                  <label>Product Name: *</label>
                    <input type="text" name="name" size="15" maxlength="30" value="' . $row[1] . '"/>
                  <label>Description: </label>
                    <textarea name="description" rows="5" maxlength="255">' . $row[2] . '</textarea>
                  <label>Image URL: *</label>
                    <input type="text" name="image" size="15" maxlength="30" value="' . $row[3] . '"/>
                  <label>Price: *</label>
                    <input type="number" name="price" size="20" maxlength="20" value="' . $row[4] . '"  step="0.01" min="0"/>
                    
                    <input type="hidden" name="id" value="' . $id . '" />
               ' ?> 
                  <label>Category: </label>
      				<select size="1" name="category">
                    <?php
                    $wcr=array(
                        "1" => 'Bread',
                        "2" => 'Pastry',
                        "3" => 'Dessert',
                        "4" => 'Baking Kit'
                    );
                    
                    foreach($wcr as $key => $value):
                    echo '<option value="'.$key.'" '.(($row[5]==$key)?'selected="selected"':"").'>'.$value.'</option>'; 
                    endforeach;
                    ?>
                    </select>     				   
			</fieldset>
            <div style="text-align: center">
                <input type="submit" name="Edit" value="Save">
                <input type="reset" value="Reset">
            </div>
            <br>
        </form>
      </div>
    </body>
</html>

<?php 
} else { // Not a valid product ID.
    echo '<script>alert("This page has been accessed in error.\n Please try again.");</script>';
    echo '<script>window.location.href = "viewProduct.php";</script>';
}
mysqli_close($dbc);
?>

