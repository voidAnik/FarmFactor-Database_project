<!DOCTYPE html>
<html lang="en">
<head>
<title>Farmfactor</title>
<link rel="icon" href="logo2.png">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 14px;
  border: none;
  outline: none;
  background-color: #00cc00;
  color: #003300;
  cursor: pointer;
  padding: 15px;
  border-radius: 2px;
}

#myBtn:hover {
  background-color: #ffff33;
}


/* Style the header */
/*.header {
  padding: 30px;
  text-align: center;
  background: #1abc9c;
  color: white;
  font-style: 
}
*/
/* Increase the font size of the h1 element */
.header h1 {
  font-size: 40px;
}

/* Style the top navigation bar */
.navbar {
  overflow: hidden;
  background-color: #1a3300;
}

/* Style the navigation bar links */
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

/* Right-aligned link */
.navbar a.right {
  float: right;
}

/* Change color on hover */
.navbar a:hover {
  background-color: #ffff00;
  color: black;
}

/* Column container */
.row {  
  display: flex;
  flex-wrap: wrap;
  padding: 30px;
  text-align: center;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {   
  flex: 70%;
  text-align: center;
  background-color: white;
  padding: 20px;
  width: 70%;
  height: 70%;
}

#animate {
  width: 100%;
  height: 200px;
  padding: 30px;
  text-align: center;

  color: white;
  
  background: #408000;
  -webkit-animation: animateB 5s infinite; 
  animation: animateB 5s ease-in-out infinite;


}

/* Chrome, Safari, Opera */
@-webkit-keyframes animateBanimateB {
  from {background-color: #408000;}
  to {background-color: #59b300;}
}


/* Standard syntax */
@keyframes animateB {
  from {background-color: #408000;}
  to {background-color: #59b300;}
}


</style>
</head>
<body>

  <button onclick="topFunction()" id="myBtn" title="Go to top">Take me to the top</button>

<div id="animate">
            <div class="header">
      <h1>Farm Factor</h1>
      <p>We are on a great mission to connect emerging farmers with their hardwork, to people all over the world!</p>
       </div>
       </div>



<div class="navbar">
  
  <li style="float: right;"><a href="login.php">Join Us!</a></li>
  <li><a href="#contact"><i class="fa fa-fw fa-envelope"></i>Contact(farmfactor@gmail.com)</a></li>
</div>
 

<div class="row">
  <div class="side">
    <h2><em>About Us</em></h2>
    
    
    <p>Farm Factor is the best place online to discover all things local, small-batch, fresh, and just better. We have a purpose to facilitate the discovery of natural and specialty products, emerging brands, and today’s culture of quality over quantity.</p>
    
    <p>We're on a great mission to build a massive community of mindful people and bring them digital content that has real value.</p>

    <p>Our online farmers’ market delivers seafood, meats, produce, dairy and other products to Dhaka, Chittagong, Rajshahi and Sylhet. By working directly with small family farmers in their communities they are able to source the freshest produce and give farmers a larger share of the retail prices. So instead of having to worry about profitability and the produce’s ability to survive shipment, farmers can now focus on sustainable quality produce.</p>

    <p><strong>Farm Factor works closely with our farmers to address all of their needs. By selling directly through Farmfactor, farmers are able to earn significantly more than they could selling to traditional distributors.</strong></p>

    <br>
    <p><i> "Why us?" </i></p>
    <br>
    <p>↣ Shop our curated selection of the most delicious, locally-sourced groceries. ↢</p>
    <br>
    <p>↣ Your food is harvested at its peak, sometimes just hours before delivery, maximizing freshness and flavor. ↢</p>
    <br>
    <p>↣ Get your order delivered right to your door without the hassles of crowds, traffic, and long lines. ↢</p>

    <img src="logo4.png" width="520" height="370" alt="farmfactor"
<
    
  </div>
</div>
  <div class="main">
    <h2><em>Terms & Conditions</em></h2>
    <h5><b>For Buyers</b></h5>

    <p>➱ As a buyer, once you register for a bid and therefore win a bid, you can not cancel the order. </p>
    <p>➱ The order has to be cancelled within the first three days of the order placement. </p>
    <p>➱ Cancelling before will earn the buyer a penalty. They have to pay a 2000tk. </p>
    <p>➱ Failure to pay the penalty will cause a permanent ban from the website. </p>

    <p><b> ⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯⋯</b> </p>

    <h5><b>For Farmers</b></h5>

    <p>➱ As a farmer, he must meet all of the buyer's requirements </p>
    <p>➱ Deliveries must be done within the specified time </p>
    <p>➱ Failure to deliver the product within the time, or the misplace of products will earn him a penalty </p>
    <p>➱ Failure to pay the penalty will cause a permanent ban from the website. </p>

<br>

  </div>
</div>

<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

</body>
</html>
