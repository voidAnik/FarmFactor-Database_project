<?php
session_start();
$tr="";
$username=$_SESSION['user'];
if(isset($_POST['transaction_id']))
$tr=$_POST['transaction_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bidding Room</title>
	<link rel="icon" href="logo2.png">
	 <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	 <link rel="stylesheet" type="text/css" href="style.css" > 
	<link rel="stylesheet" type="text/css" href="nav.css">


	<style type="text/css">
		ul {
			  background-color: rgba(0,0,0,.6);
			}
		body{
				background-image:url('bg.jpg');
				background-repeat: no-repeat;
				background-size: cover;
				background-attachment: fixed;
				background-position: center center;

			}
		td img{
				width:100px;
				height:100px;
			}
			td{
				text-align: left;
			}
			#nbtn{
				position: absolute;
				top: 3%;
				left:90%;
			}
			.container{
			  position: fixed;
			  left: 0;
			  right: 0;
			  width: 100%;
			  height: 100%;
			  background: rgba(0,0,0,.4);
			  overflow: auto;
			}
			tr:nth-child(even) {
			  background-color: #f2f2f2;
			}
	</style>
</head>
<body>
	<?php
	include 'database_conn.php';
	?>
	<script>
	$(document).ready(function(){
	  $('[data-toggle="popover"]').popover({
	  	html: true,
	  	content: function(){
	  		return $('#showme').html();
	  	}
	  }); 
	});
	</script>

	<div id="showme" style="display:none;max-height: 80%; overflow-y: scroll;">
		
		<?php
			$query="select * from notifications where fkb_username='$username'";
			$returnvalue=$conn->query($query);
			$rowcount=$returnvalue->rowCount();
			$table=$returnvalue->fetchAll();
			$i=1;
			foreach($table as $row){
				?>
				
				<div>
					<?php echo $i.') '."time:".''.$row[2]?>
					<div style="display:inline-block;width:30%;"><?php echo $row[1]?></div>
					<hr/>
				</div>
					<?php
					$i+=1;
				}
			?>
		
	</div>
	<ul>
	  <li><a class="active" href="bview_product_on_sale.php"><i class="fa fa-fw fa-home"></i> Back </a></li>
	  <li><a href="#contact"><i class="fa fa-fw fa-envelope"></i>Contact(farmfactor@gmail.com)</a></li>
	  
	  <li><a href="#" class="notification" data-toggle="popover" data-placement="bottom"><i class="fa fa-fw fa-bell"></i>
	  <span>Inbox</span>
	  <span class="badge"><?php echo $rowcount ?></span>
		</a></li>
		<li style="float: right; background-color: rgb(255,0,0);"><a href="login.php">logout</a></li>
	</ul> 
	<?php
	$userquery = "SELECT * 
					FROM cart
					WHERE fkb_username='$username'";
			$returnvalue = $conn->query($userquery);
			$table = $returnvalue->fetchAll();
	?>
			<table  class="table table-hover table-light" id="on_sale_table" style="width: 100%">
			<thead>
				<tr>
					<thead class="thead-dark"
					<th colspan="12"><h2>Your products won in bidding:</h2></th>
				</tr>
				<tr>
					<tr class="header">
					<th>Product</th>
					<th>Amount</th>
					<th>Total price</th>
					<th>Is paid</th>
				</tr>
			</thead>
		
			<tbody>
			<?php
			///$table is a two dimensional array, first loop will return each row of the table
			$tPrice=0;
			for($i=0; $i<count($table); $i++)
			{
				$row=$table[$i];
				?>
				
				<tr>
					<td><?php echo $row[0] ?></td>
					<td><?php echo $row[1] ?></td>
					<td><?php echo $row[2] ?></td>
					<td><?php echo $row[5] ?></td>
				</tr>
				<?php
				$update=$conn->prepare("UPDATE cart 
										SET is_paid=1
										WHERE cart_id=$row[6]");
				$update->execute();
				if($row[5]==0)
				$tPrice+=$row[2];
			}
				?>
		</tbody>
		</table>
		<div style="background-color:#999999;">
		<form method="post" action="cart.php">
			<p>Total Price for all unpaid products:<?php echo $tPrice; ?></p>
			<input type="number" name="transaction_id" placeholder="Input your transaction id">
		<input type="submit" name="pay" value="Make payment">
	</form>
	</div>
	<?php
		if(isset($_POST['pay']))
		{
			
			$insert = $conn->prepare("INSERT INTO `payment`(`transaction_id`, `buyerb_username`, `amount`) VALUES ($tr,'$username','$tPrice')");
                try
                {
                    $insert->execute();
                    ?>
                    <script>
    	                window.alert("Payment Successfull");
                	</script>
                	<?php
                }
                catch(PDOException $ex)
                {
                    ?>
                    <script>
                        window.alert("You gave an wrong input! Try again!");
                    </script>
                	<?php
                }
		}
	?>
</body>