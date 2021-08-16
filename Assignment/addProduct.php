<?php 
// This script performs an INSERT query to add a record to the product table.

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('dbcontroller1.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Validation for:
	// Code:
	if (empty($_POST['code'])) {
	    $errors[] = '- Please enter product code.';
	} else {
	    $q = "SELECT * FROM product where code ='".$_POST['code']."'";
	    $r = @mysqli_query ($dbc, $q);
	    $rows = mysqli_num_rows($r);
	    if($rows >= 1){
	        $errors[] = '- Please enter a unique product code.';
	    }else{
	       $code = mysqli_real_escape_string($dbc, trim($_POST['code']));
	    }
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
	    if (preg_match("/^([\w\W]+\.)+[a-zA-Z]{2,4}$/", $_POST['image'])) {
	        $img = mysqli_real_escape_string($dbc, trim($_POST['image']));
	    } else {
	        $errors[] = '- Image URL does not match the required format.';
	    }
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
	    if (is_numeric($_POST['category'])) {
	        $cat = mysqli_real_escape_string($dbc, trim($_POST['category']));
	    } else {
	        $errors[] = '- Product category must be an integer value';
	    }
	}
	   
	if (empty($errors)) { // If everything's OK.
	
		// Register the product in the database...
		
		// Make the query:
        $q = "INSERT INTO product (code, name, description, image, price, category, date) VALUES ('$code','$name','$desc','$img','$price','$cat',NOW() )";
		$r = @mysqli_query ($dbc, $q); // Run the query.
		$back = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
		
		if ($r) { // If it ran OK.
		
			// Print success message:
			echo '<script>alert("Product registered successfully.");</script>';
			echo '<script>window.location.href = "'. $back .'";</script>';
		
		} else { // If it did not run OK.
			
			// Public message:
		    echo '<script>alert("Product not be registered due to a system error.\n We apologize for any inconvenience caused.");</script>';
		    echo '<script>window.location.href = "'. $back .'";</script>';
		    
			// Debugging message:
			echo '<script>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</script>';
		
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
        <title>Add New Product</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <link rel="stylesheet" href="css/form.css"/>
    </head>
    
    <body>
        <div class="form">
          <button class="icon" title="Cancel" onclick="document.location='viewProduct.php'">
			<i class="fas fa-times"></i>
		  </button>
          <form method="post" action="addProduct.php">
            <fieldset>
                <h2>Add New Product</h2>
                <br>          
        		<input type="text" name="code" placeholder="Product Code *" size="40" maxlength="50" value="<?php if (isset($_POST['code'])) echo $_POST['code']; ?>"  /> 
				<input type="text" name="name" size="30" maxlength="30" placeholder="Product Name *" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"  />
				<textarea name="description" maxlength="255" rows="5" placeholder="Description"><?php if (isset($_POST['description'])) echo $_POST['description']; ?></textarea>
				<input type="text" name="image" size="40" maxlength="30" placeholder="Image URL (eg. image.jpg)" value="<?php if (isset($_POST['image'])) echo $_POST['image']; ?>" />
				<input type="number" name="price" size="40" maxlength="30" placeholder="Price *" step="0.01" min="0" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>" />

				<label>Category: </label>
  				<select size="1" name="category">
                <?php
                $cat=array(
                    "1" => 'Bread',
                    "2" => 'Pastry',
                    "3" => 'Dessert',
                    "4" => 'Baking Kit'
                );
                
                foreach($cat as $key => $value):
                echo '<option value="'.$key.'">'.$value.'</option>'; 
                endforeach;
                ?>
                </select>     
			</fieldset>
			
			<div style="text-align:center">
                <input type="submit" name="submit" value="Save">
                <input type="reset" value="Reset">
            </div>
          </form>
		</div>
    </body>
  </html>