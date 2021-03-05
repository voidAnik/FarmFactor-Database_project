

<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Login & Registration</title>

	<link rel="icon" href="logo2.png">
	<link rel="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="style.css" >
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
	
<style>
	ul {
		  background-color: rgba(0,0,0,0.6);
		}
		.center {
		  text-align: center;
		  border: 3px solid orange;
		}
		
		img{
			margin-left: 43%;
		}

</style>
</head>

<body>
	<div>
	<ul>
	<!-- <li><img src="logo4.png" alt="" width="70"></li> -->
	  <li><a class="active" href="homepage.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
	 
	  <li><a href="#contact"><i class="fa fa-fw fa-envelope"></i>Contact(farmfactor@gmail.com)</a></li>
	  <li style="float: right;"><a href="homepage.php"><i class="fa fa-fw fa-about"></i>About</a></li>
	</ul>
</div>
	<div class="container">
		
		<div >
			<span id="login">
				<div >
					<h1 class="UpperLogin">Login</h1>

					<form action="verifylogin.php" method="post">
						<div class="textbox">
							<i class="fas fa-user"></i>
							<label>Username:</label>
							<input type="text" name="Username"  required>
							
						</div>

						<div class="textbox">
							<i class="fas fa-lock"></i>
							<label>Password:</label>
							<input type="Password" name="Password" class="form-control" required>
						</div>

						<div>
					  		<input type="radio" name="Role" value="Farmer"> Farmer<br>
					  		<input type="radio" name="Role" value="Buyer"> Buyer<br>
					 	 </div>

						<button type="submit" class="btn">Log In</button>
					</form>
				</div>
			</span>

			<span id="signup">
				<br>
				<div class="textbox"><h3>Don't have an account? Sign up!</h3></div>

				<h1>Select user type and click sign up</h1>

				<form action="signup_form.php" method="post">
					<div>
						  <input type="radio" name="Role" value="Farmer"> Sign up as a Farmer<br>
						  <input type="radio" name="Role" value="Buyer"> Sign up as an Buyer<br>
						  
				  	</div>

					<button type="submit" class="btn btn-primary">SIGN UP</button>


				</form>
			</span>
		</div>
	</div>		

	<?php
		session_destroy();
	?>
</body>
</html>