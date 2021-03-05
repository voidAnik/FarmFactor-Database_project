<?php
	$username="";
	session_start();
	$username = $_SESSION['user'];

?>
<!DOCTYPE html>
<html>
 
<head>
	<title>User Login & Registration</title>

<!-- template files -->
	<link rel="icon" href="logo2.png">
	<link rel="stylesheet" type="text/css" href="style.css" >
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	
	<!-- bootstrap files -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="nav.css">

	<style>
		ul {
		  background-color: rgba(0,0,0,0.6);
		}
		.center {
		  text-align: center;
		  border: 3px solid orange;
		}
		
					#on_sale_table{
						width: 100%;
						margin-left: .2%;
						margin-right: .2%;
						position: auto;
					}

				
					#user_ad_table{
						margin-left: .2%;
						margin-right: .2%;
						width: 100%;
						position: auto;
					}

					#on_sale_table th, #on_sale_table, #on_sale_table td{
						/*border: 1px solid blue;*/
						border-collapse: collapse;
					}

					#user_ad_table th,#user_ad_table,#user_ad_table td{
						/*border: 1px solid blue;*/
						border-collapse: collapse;
					}

					.onsale{
						height: 370px;
						overflow: auto;
					}
					
					.advertTable{
						height: 370px;
						overflow: auto;
					}

					td img{
						width:100px;
						height:100px;
					}
					td{
						text-align: center;
					}
					tr:nth-child(even) {
					  background-color: #f2f2f2;
					}
					#btn{
						position: absolute;
						top: 1%;
						right:15%;
					}

					#nbtn{
						position: absolute;
						top: 1%;
						left:90%;
					}
					

	</style>
	</head>
	
	<body>

	<?php
	include 'database_conn.php';
	?>

	<!-- script for notifications -->
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

<div id="showme" style="display:none;max-height: 50%; overflow-y: scroll;">
	
	<?php
		$query="select * from notifications where fkf_username='$username'";
		$returnvalue=$conn->query($query);
		$rowcount=$returnvalue->rowCount();
		$table=$returnvalue->fetchAll();
		$i=1;
			foreach($table as $row){
				?>
				
				<div>
					<?php echo $i.')'."time:".''.$row[2]?>
					<div title="notifications:" style="display:inline-block;width:30%;"><?php echo $row[1]?></div>
					<hr/>
				</div>
					<?php
					$i+=1;
				}
		?>
	
</div>

	<ul>
		<li><a href="homepage.php"><i class="fa fa-reply"></i> Back </a></li>
	  
	  <li><a href="#contact"><i class="fa fa-fw fa-envelope"></i>Contact(farmfactor@gmail.com)</a></li>
	  

	  <!-- notification -->
	  <li><a href="#" class="notification" data-toggle="popover" data-placement="bottom"><i class="fa fa-fw fa-bell"></i>
	  <span>Inbox</span>
	  <span class="badge"><?php echo $rowcount ?></span>
		</a></li>

	  <li style="float: right; background-color: rgb(100,0,0);"><a href="login.php">logout</a></li>
	  <li style="float: right; background-color: rgb(0,100,0);"><a href="advertisement_form.php">Click to sale product</a></li>
	  
	</ul>

		<?php
			/// data fetching
			$userquery = "SELECT * FROM product_on_sale";
			$returnvalue = $conn->query($userquery);
			///extracting only the table(2D array) from the return value
			$table = $returnvalue->fetchAll();
			
			///print_r($table);			
		?>

		<div class="onsale">

		<table class="table table-hover table-light" id="on_sale_table" style="width: 100%">
<!--			showing the table headers 		-->
			<thead class="thead-dark" >
				<tr>

					<th colspan="12" style="text-align: center;"><h2>Products On Sale Now</h2></th>
				</tr>

				<tr>
					<th>AD SERIAL</th>
					<th>Product</th>
					<th>Weight</th>
					<th>price/Unit</th>
					<th>Sample</th>
					<th>Time Left</th>
					<th>Bid Start Date</th>
					<th>Bid Start Time</th>
					<th>Farmer Name</th>
				</tr>
			</thead>
		
			<tbody>
			<?php
			///$table is a two dimensional array, first loop will return each row of the table
			for($i=0; $i<count($table); $i++){
				$row=$table[$i];
				?>
				
				<tr>
					<td><?php echo $row[0] ?></td>
					<td><?php echo $row[1] ?></td>
					<td><?php echo $row[3],$row[10] ?></td>
					<td><?php echo $row[4] ?></td>
					<td><img src="<?php echo $row[5] ?>"></td>
					<td><?php echo $row[6] ?></td>
					<td><?php echo $row[11] ?></td>
					<td><?php echo $row[12] ?></td>
					<td><?php echo $row[2] ?></td>
				</tr>
				
				<?php
			}
				
			?>
			</tbody>
		</table>
	</div>


		<?php
			$userquery = "SELECT * FROM product_on_sale Where fkf_username='$username' ";
			$returnvalue = $conn->query($userquery);
			///extracting only the table(2D array) from the return value
			$table = $returnvalue->fetchAll();
			
			///print_r($table);			
		?>
		<br><br><br>

		
		<div class="advertTable">
		<table class="table table-hover table-light"  cellspacing="0" width="100%">
<!--			showing the table headers 		-->
			<thead class="thead-dark">
				<tr>
					<th colspan="12" style="text-align: center;"><h2>Your Advertisement</h2></th>
				</tr>
				<tr>
					<th>AD SERIAL</th>
					<th>Product</th>
					<th>Weight</th>
					<th>price/Unit</th>
					<th>Sample</th>
					<th>Time Left</th>
					<th>Bid Start Date</th>
					<th>Bid Start Time</th>
					<th>Farmer Name</th>
				</tr>
			</thead>
		
			<tbody>
			<?php
			///$table is a two dimensional array, first loop will return each row of the table
			for($i=0; $i<count($table); $i++){
				$row=$table[$i];
				?>
				
				<tr>
					<td><?php echo $row[0] ?></td>
					<td><?php echo $row[1] ?></td>
					<td><?php echo $row[3],$row[10] ?></td>
					<td><?php echo $row[4] ?></td>
					<td><img src="<?php echo $row[5] ?>"></td>
					<td><?php echo $row[6] ?></td>
					<td><?php echo $row[11] ?></td>
					<td><?php echo $row[12] ?></td>
					<td><?php echo $row[2] ?></td>
				</tr>
				
				<?php
			}
				
			?>
			</tbody>
		</table>
		</div>
		
	</body>
</html>