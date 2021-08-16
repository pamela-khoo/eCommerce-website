<html>
<head>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

<!-- Header -->
<header>
    <img src="img/image.png" class="logo">
    <nav>
		<ul>
  			<li> <a href="home.php">home</a></li>
  			<li><a href="about.php">about us</a></li>
  			<li><a href="product.php">products</a></li>
  			<li><a href="delivery.php">delivery &amp; more</a></li>
		</ul>
	</nav>
	<div class="sidenav">
	<?php 
	   // If user not logged in link to log in page
    	if (!isset($_SESSION['userID'])) {
    	    echo '<a href="loginUser.php"><i class="fas fa-user fa-2x"></i></a>';
        } else { 
            // If already logged in, show logout button  
            echo "<a onClick=\"javascript: return confirm('Are you sure you want to log out, {$_SESSION["fname"]}?');\" href='logout.php'><i class=\"fas fa-sign-out-alt fa-2x\"></i></a>"; 
        }
    ?>
		<a href="javascript:void(0)" onclick="cart_open()">
			<i class="fas fa-shopping-cart fa-2x"></i>
		</a>
	</div>
</header>

<!-- Cart Sidebar -->
<div class="cart-overlay" id="overlay" onclick="cart_close()"></div>

<nav id="sidebar" class="cart-sidebar cart-block">
  <div class="cart-item"> SHOPPING CART <a href="javascript:void()" onclick="cart_close()" class="cart-close"> X </a> </div>
  <div class="divider"></div>
	
<!-- Shopping Cart -->
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table class="cart-table">
	<tbody>
		<tr>
			<td colspan="5" align=right><a id="emptycart" href="product.php?action=empty">Empty Cart <i class="fa fa-trash"></i></a></td>
		</tr>
		<?php 
		  foreach ($_SESSION["cart_item"] as $item) {
		?>
			<tr>
				<td rowspan="2" class="cart-style"><img src="<?php echo $item["image"]; ?>"></td>
				<td><strong><?php echo $item["name"]; ?></strong></td>
				<td><a href="product.php?action=remove&code=<?php echo $item["code"]; ?>" id="removeitem">Remove</a></td>
			</tr>
			<tr class="cart-style">
				<td>MYR <?php echo $item["price"]; ?></td>
				<td>Qty: <?php echo $item["quantity"]; ?></td>
			</tr>
			<?php 
			 $item_total += ($item["price"] * $item["quantity"]);
		  } ?>
		<tr>
			<td colspan="3" align=right><br><strong>Subtotal:</strong> MYR <?php echo number_format($item_total, 2); ?></td>
		</tr>
		<tr>
			<td colspan="3" align=center><br><br><button type="button" id="checkout" onclick="checkout()"><span>CHECKOUT</span></button> 
			</td>
		</tr>
	</tbody>
</table>

<?php
} else {
    echo '<h4 align="center" style="margin:50px auto;">Your cart is empty</h4>';
}
?>
</nav>

<script>
//Sticky navbar
window.addEventListener("scroll", function() {
	  var header = document.querySelector("header");
	  header.classList.toggle("sticky", window.scrollY > 0);
})

// Open and close sidebar
function cart_open() {
  document.getElementById("sidebar").style.display = "block";
  document.getElementById("overlay").style.display = "block";
  
  document.body.style.position = 'fixed';
  document.body.style.top = `-${window.scrollY}px`;
  //document.querySelector("body").style.overflow = 'hidden';
}

function cart_close() {
  document.getElementById("sidebar").style.display = "none";
  document.getElementById("overlay").style.display = "none";

  const scrollY = document.body.style.top;
  document.body.style.position = '';
  document.body.style.top = '';
  window.scrollTo(0, parseInt(scrollY || '0') * -1);
  //document.querySelector("body").style.overflow = 'visible';
}

//Checkout function
function checkout() {
	alert("Order Sucess! Thank you for shopping with us!");
	location.href = "product.php?action=empty";
}
</script>
</body>
</html>