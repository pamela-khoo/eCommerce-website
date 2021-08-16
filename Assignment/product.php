<?php
session_start(); 

// If not logged in, redirect user
if (!isset($_SESSION['userID'])) {
    echo '<script>alert("Please log in to access this page!");</script>';
    echo '<script>window.location.href = "loginUser.php";</script>';
}

require_once("dbcontroller1.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
    // Add to cart 
	case "add":
	    if(!empty($_POST["quantity"])) {
	        $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
	        $itemArray = array($productByCode[0]["code"]=>array('code'=>$productByCode[0]["code"], 'name'=>$productByCode[0]["name"], 'image'=>$productByCode[0]["image"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
	        
	        if(!empty($_SESSION["cart_item"])) {
	            if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
	                foreach($_SESSION["cart_item"] as $k => $v) {
	                    if($productByCode[0]["code"] == $k) {
	                        if(empty($_SESSION["cart_item"][$k]["quantity"])) {
	                            $_SESSION["cart_item"][$k]["quantity"] = 0;
	                        }
	                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
	                    }
	                }
	            } else {
	                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
	            }
	        } else {
	            $_SESSION["cart_item"] = $itemArray;
	        }
	    }
	    break;
	// Remove from cart 
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	//Empty cart 
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css"/>
    <title>Menu</title>
</head>
<body>

<?php include "header.php"?>

<section class="banner2"></section>

<br/><br/><br/>

<!-- Dot Navigation -->
<div class="dot-nav">
    <ul id="dots">
      <li><a class="dot active" href="#dot1">Bread</a></li>
      <li><a class="dot" href="#dot2">Pastry</a></li>
      <li><a class="dot" href="#dot3">Dessert</a></li>
      <li><a class="dot" href="#dot4">DIY Baking Kits</a></li>
    </ul>
</div>

<!-- Product Grid -->
<div class="wrap">
  <div id="dot1"></div>
  <div class="row">
  	<h1>Bread</h1>
  </div>
  <div class="row">
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM product WHERE category = 1 ORDER BY prodID ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		 <div class="col-1-3">
		 <div class="show">
			<form method="POST" action="product.php?action=add&code=<?php echo $value["code"]; ?>">
				<div class="product-img"><img class="product-img-size" src="<?php echo $product_array[$key]["image"]; ?>"></div>
				<div class="product-name"><h3><?php echo $product_array[$key]["name"]; ?></h3></div>
				<div class="product-desc"><?php echo $product_array[$key]["description"]; ?></div>
				<div class="product-section">
				<div class="product-price"><?php echo "MYR ".$product_array[$key]["price"]; ?></div>
				<div class="product-quantity"><input type="number" name="quantity" min="1" max="10" value="1"/></div>
				</div>
				<div class="submit-btn"><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
		</div>
	<?php
		}
	}
	?>
  </div>
  
  <div id="dot2"></div>
    <div class="row">
    	<h1>Pastry</h1>
    </div>
    <div class="row">
    <?php
    $product_array = $db_handle->runQuery("SELECT * FROM product WHERE category = 2 ORDER BY prodID ASC");
    if (!empty($product_array)) { 
    	foreach($product_array as $key=>$value){
    ?>
    	 <div class="col-1-3">
    	 <div class="show">
    		<form method="POST" action="product.php?action=add&code=<?php echo $value["code"]; ?>">
    		<div class="product-img"><img class="product-img-size" src="<?php echo $product_array[$key]["image"]; ?>"></div>
    		<div class="product-name"><h3><?php echo $product_array[$key]["name"]; ?></h3></div>
    		<div class="product-desc"><?php echo $product_array[$key]["description"]; ?></div>
    		<div class="product-section">
    		<div class="product-price"><?php echo "MYR ".$product_array[$key]["price"]; ?></div>
    		<div class="product-quantity"><input type="number" name="quantity" min="1" max="10" value="1"/></div>
    		</div>
    		<div class="submit-btn"><input type="submit" value="Add to cart" class="btnAddAction" /></div>
    		
    		</form>
    	  </div>
    	  </div>
    <?php
    	}
    }
    ?>
  </div>

  <div id="dot3"></div>
	<div class="row">
  		<h1>Dessert</h1>
	</div>
	<div class="row">
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM product WHERE category = 3 ORDER BY prodID ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		 <div class="col-1-3">
		 <div class="show">
			<form method="POST" action="product.php?action=add&code=<?php echo $value["code"]; ?>">
			<div class="product-img"><img class="product-img-size" src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-name"><h3><?php echo $product_array[$key]["name"]; ?></h3></div>
			<div class="product-desc"><?php echo $product_array[$key]["description"]; ?></div>
			<div class="product-section">
			<div class="product-price"><?php echo "MYR ".$product_array[$key]["price"]; ?></div>
			<div class="product-quantity"><input type="number" name="quantity" min="1" max="10" value="1"/></div>
			</div>
			<div class="submit-btn"><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		  </div>
		  </div>
	<?php
		}
	}
	?>
  </div>

  <div id="dot4"></div>
	<div class="row">
  		<h1>DIY Baking Kits</h1>
	</div>
	<div class="row">
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM product WHERE category = 4 ORDER BY prodID ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		 <div class="col-1-3">
		 <div class="show">
			<form method="POST" action="product.php?action=add&code=<?php echo $value["code"]; ?>">
			<div class="product-img"><img class="product-img-size" src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-name"><h3><?php echo $product_array[$key]["name"]; ?></h3></div>
			<div class="product-desc"><?php echo $product_array[$key]["description"]; ?></div>
			<div class="product-section">
			<div class="product-price"><?php echo "MYR ".$product_array[$key]["price"]; ?></div>
			<div class="product-quantity"><input type="number" name="quantity" min="1" max="10" value="1"/></div>
			</div>
			<div class="submit-btn"><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		  </div>
		  </div>
	<?php
		}
	}
	?>
  </div>
</div>
<?php include "footer.php"?>

<script>
//Dot Navigation
var header = document.getElementById("dots");
var x = header.getElementsByClassName("dot");
for (var i = 0; i < x.length; i++) {
  x[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>
</body>
</html>