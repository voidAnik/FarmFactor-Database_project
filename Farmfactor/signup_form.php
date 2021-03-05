<!DOCTYPE html>
<?php
$Role="";
if (isset($_REQUEST['Role']))
{
	$Role=$_REQUEST['Role'];
}
?>
<html>

<head>
	<title>User Signup</title>
	<link rel="icon" href="logo2.png">
	<link rel="stylesheet" type="text/css" href="style.css" >
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="nav.css">
	

<style>
	ul {
		  background-color: rgba(0,0,0,0.9);

		}
.center {
  text-align: center;
  border: 3px solid orange;
  color: white;
}
#box{

	color: white;
}
</style>
</head>
<body>
	<ul>
		<!-- <li><img src="logo4.png" alt="" width="70"></li> -->
		<li><a class="active" href="homepage.php"><i class="fa fa-fw fa-home"></i>Home </a></li>
	  
	  <li><a href="#contact"><i class="fa fa-fw fa-envelope"></i>Contact(farmfactor@gmail.com)</a></li>
	  <li style="float: right;"><a href="#about"><i class="fa fa-fw fa-about"></i>About</a></li>
	</ul>
	
	<?php
	if($Role=='Farmer'){
	?>
	<div class="container">
		<div class="Box">
			<div class="row">
				<div class="col-md-9 login-bottom">
				<h2>Sign up as Farmer</h2>
				<form action="registeruser.php" method="post">
					<div class="form group">
						<label>Username:</label>
						<input type="text" name="username" class="form-control" required>
					</div>

					<div class="form group">
						<label>Password:</label>
						<input type="Password" name="password" class="form-control" required>
					</div>

					<div class="form group">
						<label>Full Name:</label>
						<input type="text" name="name" class="form-control" required>
					</div>

					<div class="form group">
						<label>Address:</label>
						<input type="text" name="address" class="form-control" required>
					</div>

					<div class="form group">
						<label>Phone Number:</label>
						<input type="tel" name="number" class="form-control" required>
					</div>

					<div class="form group">
						<label>Farm location:</label>
						<input type="text" name="farm_loc" class="form-control" required>
					</div>

					<div class="form group">
						<label>Bank account number:</label>
						<input type="text" name="bank_acc" class="form-control" required>
					</div>
					<input type="hidden" name="Role" value="farmer">
					<div class="form group">
					<input type="submit" name="signup" value="SUBMIT" class="btn btn-primary">
					<input type="reset" class="btn btn-primary">
				</div>
				</form>
				</div>

			</div>
		</div>
	</div>
	<?php
	}
	else if($Role=='Buyer')
	{
	?>
		<div class="container">
		<div class="Box">
			<div class="row">
				<div class="col-md-9 login-bottom">
				<h2>Sign up as a Buyer</h2>
				<form action="registeruser.php" method="post">
					<div class="form group">
						<label>Username:</label>
						<input type="text" name="username" class="form-control" required>
					</div>

					<div class="form group">
						<label>Password:</label>
						<input type="Password" name="password" class="form-control" required>
					</div>

					<div class="form group">
						<label>Full Name:</label>
						<input type="text" name="name" class="form-control" required>
					</div>

					<div class="form group">
						<label>Address:</label>
						<input type="text" name="address" class="form-control" required>
					</div>

					<div class="form group">
						<label>Phone Number:</label>
						<input type="tel" name="number" class="form-control" required>
					</div>

					<div class="form group">
						<label>Company location:</label>
						<input type="text" name="com_loc" class="form-control" required>
					</div>

					<div class="form group">
						<label>Company name:</label>
						<input type="text" name="com_name" class="form-control" required>
					</div>

					<div class="form group">
						<label>Bank account number:</label>
						<input type="text" name="bank_acc" class="form-control" required>
					</div>
					<input type="hidden" name="Role" value="buyer">
					<input type="submit" name="signup" value="SUBMIT" class="btn btn-primary">
					<input type="reset" class="btn btn-primary">
				</form>

}
				</div>

			</div>

		</div>
	</div>
	<?php	
	}
	else
	{
	?>
		<script>
		window.alert("Select a user type first!");
		window.location.assign("login.php")
		</script>
	<?php
	}
	?>

</body>
</html>
