<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css"/>
    <title>About Us</title>
</head>
<body>

<?php 
    session_start(); // Start the session.
    include "header.php"
?>

<section class="banner4"></section>

<br/><br/><br/>

<div class="row">
  <div class="column-2">
    <img src="https://images.pexels.com/photos/2245293/pexels-photo-2245293.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500">
  </div>
  <div class="column-2">
    <h2>Our Story</h2>
    <br/>
    <p>
    	The company originally started out as a wholesale supplier of artisan bread and pastries to caf&eacute;s and small-scale restaurants. 
    	It was conceived, built and run by a group of baked goods enthusiasts that wanted to elevate something as simple as a loaf of bread 
    	into decadent comfort food. After receiving a lot of positive feedback from customers, the owners decided to start their own bakery 
    	in the 2000s, which led to the birth of Bread and Butter Co. 
    </p>
    <br/>
    <p>	
    	The company's main motto is to turn the ordinary into something extraordinary every day. Everything is baked by hand and in	small batches 
    	so that the bakers can focus on each mix. The bakery uses organic ingredients and gluten-free flours, with recipes that the bakers have 
    	spent years perfecting. The loaves are freshly baked daily as well, without the use of any MSG, preservatives or enhancers.
    </p>
  </div>
</div>

<h1>Our Core Values</h1>
<div class="row">
  <div class="column-3" style="background-color:#fff;">
    <h2>Craftmanship</h2>
    <img src="https://images.pexels.com/photos/1701333/pexels-photo-1701333.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"/>
    <p>By focusing on creating perfect harmony between different textures, flavours and ingredients, 
    the classic recipes with added twists from our chefs perfectly combines classic simplicity with complex, innovative flavours.
    </p>
  </div>
  <div class="column-3" style="background-color:#fff;">
    <h2>Quality and Freshness</h2>
    <img src="https://images.pexels.com/photos/2067632/pexels-photo-2067632.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"/>
    <p>By sourcing premium natural ingredients from overseas, our baked goods are prepared lovingly from start to finish with only the best products available to us.
    "We wanted to bring back the traditional pastry shop experience &mdash; and do it exceptionally well."</p>
  </div>
  <div class="column-3" style="background-color:#fff;">
    <h2>Joyful Experience</h2>
    <img src="https://images.pexels.com/photos/3768146/pexels-photo-3768146.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"/>
    <p>We strive not only to deliver good food, but wide smiles to our patrons' faces. Whether it be in form of breakfast, lunch or dessert, 
    we want to be the flavor that brings joy to your daily life and helps you get through the day.</p>
  </div>
</div>

<div id="map">
	<h1 style="padding:20px">Location</h1>
	<div class="slideshow-container">
	<div class="demo1 puff-in-hor">
  		<div class="map1">
  			<div class="gmap_canvas">
  				<iframe width="1000" height="400" id="I1" src="https://maps.google.com/maps?q=plaza33&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" name="I1"></iframe>		
  			</div>
		</div>
		<div class="caption">
		<div class="caption-center">
			<div class = "caption-title">
          		<p>1, Jalan Kemajuan, Seksyen 13, 46200 Petaling Jaya, Selangor</p>
			</div>
          	<div>
          		<p>Contact: +6 (03) 2667789</p>          		
          		<p>Email: <a href="mailto:support@breadandbutter.com">support@breadandbutter.com</a></p>
        	</div>   
    	</div>
		</div>
	</div>
	<div class="demo1 puff-in-hor">
  		<div class="map2">
  			<div class="gmap_canvas">
  				<iframe width="1000" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=Medan%20Connaught&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
  			</div>
  		</div>
  		<div class="caption">
		<div class="caption-center">
			<div class = "caption-title">
          		<p>Jalan 3/144a, Medan Connaught, 56000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</p>
			</div>
          	<div>
          		<p>Contact: +6 (03) 3234456</p>
          		<p>Email: <a href="mailto:support@breadandbutter.com">support@breadandbutter.com</a></p>
        	</div>   
		</div>
  		</div>
	</div>
	<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	<a class="next" onclick="plusSlides(1)">&#10095;</a>
	</div>
	<br/>
	<div style="text-align:center">
  		<span class="map-dot" onclick="currentSlide(1)"></span> 
  		<span class="map-dot" onclick="currentSlide(2)"></span> 
	</div>
</div>
<?php include "footer.php"?>

<script>
//Carousel to cycle through map locations
var slideIndex = 2;
showSlides(slideIndex);

function currentSlide(n) {
	  showSlides(slideIndex = n);
	}
	
function plusSlides(n) {
  showSlides(slideIndex += n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("demo1");
  var dots = document.getElementsByClassName("map-dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
</body>
</html>