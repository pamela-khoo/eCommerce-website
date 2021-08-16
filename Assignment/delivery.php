<html>
<head>
	<title>Delivery &amp; More</title>
</head>
<body>
<?php 
    session_start(); // Start the session.
    include "header.php"
?>

<section class="banner4"></section>
<br/><br/><br/>

<section>
  <div class="col-centered">  
	<button class="accordion"><i class="fas fa-shopping-cart"></i> Checkout</button>
    <div class="content">
    	<p>To view our product menu and complete your purchase, you have to first create and register for an account. To do so, click on the <em>user icon</em> or <em>product page</em> 
    	and fill in your details and proceed to log in. After browsing, you can add the products you want to the cart from the <em>products page</em>. 
    	The shopping cart keeps all your orders safe until you are ready to checkout. Happy shopping!</p>
    	<br/>
    </div>
    <button class="accordion"><i class="fas fa-truck"></i> Delivery</button>
    <div class="content">
        <p>As a safeguard during this period, we have decided to implement contactless delivery and social distancing for all deliverys. 
        Hence, if you are residing in a condominium or apartment, please make the necessary arrangements to pick up deliveries from the lobby or guardhouse. Thank you for your kind understanding.</p>
        <br/>
    </div>
    <button class="accordion"><i class="fas fa-clipboard-check"></i> Product Availability</button>
    <div class="content">
        <p>All items displayed on our online website reflects the current availability of our stores. If there is no ready stock for a 
        specific product, you may pre-order the product by sending us an email or contacting the store nearest to you.</p>
        <br/>
    </div>
    <button class="accordion"><i class="fas fa-credit-card"></i> Payment Methods</button>
    <div class="content">
        <p>Currently, we only accept cash on delivery.</p>
        <br/>
    </div>
    <button class="accordion"><i class="fas fa-comments"></i> Frequently Asked Questions</button>
    <div class="content">
        <p><b>How long do your pastries stay fresh?</b>
        <br/>Because we believe in the freshness of every ingredient, no preservatives are added to our pastries. As a result, they are best enjoyed fresh immediately upon receipt. It is advisable to store in chiller for longer consumption.</p>
        <br/>
        <p><b>Are your products certified halal?</b>
        <br/>We are not officially certified halal. However, we do not use any pork products in our bakery and all gelatin used is halal.</p>
        <br/>
        <p><b>Do you write on cakes?</b>
        <br/>Yes, we do write messages on cakes with advance notice. For all additional requests, please email us at support@breadandbutter.com after checkout and attach your order number.</p>
        <br/>
        <p><b>Can I cancel my order?</b>
        <br/>Due to the perishable nature of our products, we do not offer exchanges or refunds.</p>
        <br/>
        <p><b>Who do I contact for further enquiries?</b>
        <br/>For all issues, please email us at <em>support@breadandbutter.com</em> or drop us a message on our social media pages. We take our product safety and quality very seriously and will return your inquiry within 1-3 working days.</p>
        <br/>
    </div>
  </div>
</section>

<br/><br/><br/>
<?php include "footer.php"?>

<script>
//Collapsible containers
var coll = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
	  this.classList.toggle("activetoggle");
      var content = this.nextElementSibling;
      if (content.style.display === "block") {
          content.style.display = "none";
      } else {
          content.style.display = "block";
      }
  });
}
</script>
</body>
</html>
