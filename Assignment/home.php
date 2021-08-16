<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Home Page</title>
</head>
<body>

<?php 
    // The user is redirected here from loginUser.php.
    session_start();
    include ("header.php");
    require ('dbcontroller1.php'); 
    
    // Get product information:    
    $q = "SELECT COUNT(*) FROM product";
    $r = @mysqli_query ($dbc, $q);
    $row = @mysqli_fetch_array ($r, MYSQLI_NUM);
    
    $q = "SELECT image, name, price FROM product ORDER BY date DESC LIMIT 3";
    $r = @mysqli_query ($dbc, $q); // Run the query.
?>

<section class="banner"></section>
	
<!-- Content -->
<div class="wrap">
  <div class="row">
  	<h1>Recommmended Products</h1>
  </div>
    
  <div class="row">
  <?php 
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      echo '
		<div class="col-1-3">
    	  <div class="show show-third">
            <img src=" '. $row['image']. '"> 
			<div class="mask">
                <h2>' . $row['name'] . '</h2>
                <h3>MYR ' . $row['price'] . '</h3>
                <br>
                <a href="product.php" class="more">More info</a>
            </div>
          </div>
        </div>'; 
        }
  ?>
  </div> 
  <br>	
  <div class="row">
      <div class="column-2">
        <img src="img/img1.jpg">
      </div>
      <div class="column-2">
        <h2>The start of something great</h2>
        <br/>
        <p> 
        	The concept behind Bread &amp; Butter was conceived, built and run by a group of baked goods enthusiasts that wanted to elevate something as simple as a loaf of bread 
        	into decadent comfort food. Initally, we were only a wholesale supplier of artisan bread and pastries to caf&eacute;s and small-scale restaurants, but soon grew
        	and expanded into the well-loved bakery we are today.
        </p>
        <br/>
        <p>
        	Here at Bread &amp; Butter, we ensure only the highest quality baked goods reach our customers. All individual bakery products are made with precision
        	and utmost attention to detail to establish a whole new experience and elevate flavours and textures to a whole other level...
        </p>
        <br/>
        <br/>
		<p id="more">
			<a href="about.php">READ MORE</a>
		</p>
      </div>
  </div>
  <br>
  <div class="row">
    <div class="column-1">
    	<div class="divider"></div>
    	<br><br>
      	<h4>If you have any questions just send us an email and we will get back to you.</h4>
      	<br>
    	<h4>Email: support@breadandbutter.com</h4>
    	<p id="more">
    		<a href="about.php">See more contact details</a>
    	</p>
    </div>
  </div>
</div>
  
<?php include "footer.php"?>
</body>
</html>