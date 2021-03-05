<?php
session_start();
$username=$_SESSION['user'];
$ad_sl="";
 $ad_sl=$_GET['serial'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bidding Room</title>
	<link rel="icon" href="logo2.png">
	 <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	 <link rel="stylesheet" type="text/css" href="style.css" > 
	<link rel="stylesheet" type="text/css" href="nav.css">


	<style type="text/css">
		ul {
			  background-color: rgba(0,0,0,.6);
			}
		body{
				/*background-image:url('bg.jpg');*/
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

			* {
			  box-sizing: border-box;
			}

			/* Create three equal columns that floats next to each other */
			.column {
			  float: left;

			  width: 33.33%;
			  border: black;
			}

			/* Clear floats after the columns */
			.row:after {
			
			  content: "";
			  display: table;
			  clear: both;
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
			
			foreach($table as $row){
				?>
				
				<div>
					<?php echo $row[2]?> 
					<div style="display:inline-block;width:30%;"><?php echo $row[1]?></div>
					<hr/>
				</div>
					<?php
				}
			?>
		
	</div>
	<ul>
	  <li><a class="active" href="bview_product_on_sale.php"><i class="fa fa-reply"></i> Back </a></li>
	  <li><a href="#contact"><i class="fa fa-fw fa-envelope"></i>Contact(farmfactor@gmail.com)</a></li>
	  
	  
	  <li><a href="#" class="notification" data-toggle="popover" data-placement="bottom"><i class="fa fa-fw fa-bell"></i>
	  <span>Inbox</span>
	  <span class="badge"><?php echo $rowcount ?></span>
		</a></li>
		<li style="float: right; background-color: rgb(,150,0);"><a href="buyer_registers.php">Registered product</a></li>
		<li style="float: right; background-color: rgb(150,0,0);"><a href="login.php">logout</a></li>
	</ul> 
	<?php
			$userquery = "SELECT * FROM product_on_sale WHERE ad_id=$ad_sl";
			$returnvalue = $conn->query($userquery);
			$table = $returnvalue->fetchAll();	
			$row=$table[0];
					
			if(isset($_POST['rank_a']))
			{
				$userquery1 = "SELECT *
								FROM bidding_cart
								WHERE fkad_id=$ad_sl AND fkb_username='$username'";
				$returnvalue1 = $conn->query($userquery1);
				$rowcount=$returnvalue1->rowCount();
				if($rowcount==1)
				{
					?>
					<script>
	                window.alert("You already registered for this!");
            		</script>
            		<?php
				}
				else{
				$amount="";
				$amount=$_POST['weight'];
				//Inserting registered info to bidding cart
				$insert = $conn->prepare("INSERT INTO `bidding_cart`(`bid_product_name`, `bidding_rank`, `bid_product_amount`, `bid_product_price`, `fkb_username`, `fkad_id`) VALUES ('$row[1]','A','$amount','$row[4]','$username','$ad_sl')");
				$insert2 = $conn->prepare("INSERT INTO `notifications`(`text`, `notify_date_time`, `fkf_username`) VALUES ('This buyer $username registered for your product with amount $amount in rank A',NOW(),'$row[13]')");
				try{
                $insert->execute();
                $insert2->execute();
                 ?>
                <script>
	                window.alert("You registered to RANK A successfully");
            	</script>
            	<?php
            }
            catch(PDOException $ex)
            {
            ?>
            <script>
                window.alert("You gave an error input! Try again!");
            </script>
        	<?php
        	}

			}
		}
			if(isset($_POST['rank_b']))
			{
				$userquery1 = "SELECT *
								FROM bidding_cart
								WHERE fkad_id=$ad_sl AND fkb_username='$username'";
				$returnvalue1 = $conn->query($userquery1);
				$rowcount=$returnvalue1->rowCount();
				if($rowcount==1)
				{
					?>
					<script>
	                window.alert("You already registered for this!");
            		</script>
            		<?php
				}
				else{
				$amount="";
				$amount=$_POST['weight'];
				$insert = $conn->prepare("INSERT INTO `bidding_cart`(`bid_product_name`, `bidding_rank`, `bid_product_amount`, `bid_product_price`, `fkb_username`, `fkad_id`) VALUES ('$row[1]','B','$amount','$row[4]','$username','$ad_sl')");
				$insert2 = $conn->prepare("INSERT INTO `notifications`(`text`, `notify_date_time`, `fkf_username`) VALUES ('This buyer $username registered for your product with amount $amount in rank B',NOW(),'$row[13]')");
				try{
                $insert->execute();
                $insert2->execute();
                 ?>
                <script>
	                window.alert("You registered to RANK B successfully");
            	</script>
            	<?php
            }
            catch(PDOException $ex)
            {
            ?>
            <script>
                window.alert("You gave an error input! Try again!");
            </script>
        	<?php
        	}


			}
		}
			if(isset($_POST['rank_c']))
			{
				$userquery1 = "SELECT *
								FROM bidding_cart
								WHERE fkad_id=$ad_sl AND fkb_username='$username'";
				$returnvalue1 = $conn->query($userquery1);
				$rowcount=$returnvalue1->rowCount();
				if($rowcount==1)
				{
					?>
					<script>
	                window.alert("You already registered for this!");
            		</script>
            		<?php
				}
				else{
				$amount="";
				$amount=$_POST['weight'];
				$insert = $conn->prepare("INSERT INTO `bidding_cart`(`bid_product_name`, `bidding_rank`, `bid_product_amount`, `bid_product_price`, `fkb_username`, `fkad_id`) VALUES ('$row[1]','C','$amount','$row[4]','$username','$ad_sl')");
				$insert2 = $conn->prepare("INSERT INTO `notifications`(`text`, `notify_date_time`, `fkf_username`) VALUES ('This buyer $username registered for your product with amount $amount in rank C',NOW(),'$row[13]')");
				try{
                $insert->execute();
                $insert2->execute();
                 ?>
                <script>
	                window.alert("You registered to RANK C successfully");
            	</script>
            	<?php
            }
            catch(PDOException $ex)
            {
            ?>
            <script>
                window.alert("You gave an error input! Try again!");
            </script>
        	<?php
        	}
			}
		}
		
			
			?>
			<div class="container">
			<table  class="table table-striped table-dark" id="on_sale_table" style="width: 100%">
			<thead>
				<tr>
					<th colspan="12"><h2>Your selected products details:</h2></th>
				</tr>
				<tr>
					<th>AD SERIAL</th>
					<th>Product</th>
					<th>Weight</th>
					<th>price/Unit</th>
					<th>Sample</th>
					<th>Sale End</th>
					<th>Bid Start Date</th>
					<th>Bid Start Time</th>
					<th>Farmer Name</th>
				</tr>
			</thead>
		
			<tbody>
				
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
		</tbody>
		</table>
		<div class="row" style="border: rgb(255,0,0)">
  		<div class="column" style="background-color:#b3b3b3;">
		<table>
			<thead>
				<tr>
					<th><h2>   RANK A BID:  </h2></th>
				</tr>
				<tr>
					<th>Date</th>
					<th>Start time</th>
					<th>weight limit</th>
				</tr>
			</thead>
			<tbody>
			    <tr>
			    	<td><?php echo $row[11]?></td>
			    	<td><?php echo $row[12]?></td>
			    	<td><?php echo floor(($row[03]/3)*2),$row[10]," - ",$row[03],$row[10]?></td>
			    </tr>
			</tbody>
		</table>
		<form method="post">
			<div class="form group">
						<label>How much you want to buy:</label>
						<select name="weight" class="form-control" required>
							<?php
							for($i=floor(($row[03]/3)*2); $i<=$row[03]; $i++){
								?>
							<option value=<?php echo $i ?>><?php echo $i,$row[10] ?></option>
							<?php
						}
					    ?>
					    </select>
				</div>
		<input type="submit" name="rank_a" value="Register">
		</form>
	</div>
	<div class="column" style="background-color:#999999;">
		<table>
			<thead>
				<tr>
					<th><h2>   RANK B BID:   </h2></th>
				</tr>
				<tr>
					<th>Date</th>
					<th>Start time</th>
					<th>weight limit</th>
				</tr>
			</thead>
			<tbody>
			    <tr>
			    	<td><?php echo $row[11]?></td>
			    	<td><?php echo $row[12]?></td>
			    	<td><?php echo floor(($row[03]/3)),$row[10]," - ",floor(($row[03]/3)*2),$row[10]?></td>
			    </tr>
			</tbody>
		</table>
		<form method="post">
			<div class="form group">
						<label>How much you want to buy:</label>
						<select name="weight" class="form-control" required>
							<?php
							for($i=floor($row[03]/3); $i<=floor(($row[03]/3)*2); $i++){
								?>
							<option value=<?php echo $i ?>><?php echo $i,$row[10] ?></option>
							<?php
						}
					    ?>
					    </select>
				</div>
		<input type="submit" name="rank_b" value="Register">
	</form>	
	</div>
	<div class="column" style="background-color:#b3b3b3;">	
	<table>
			<thead>
				<tr>
					<th><h2>   RANK C BID:  </h2></th>
				</tr>
				<tr>
					<th>Date</th>
					<th>Start time</th>
					<th>weight limit</th>
				</tr>
			</thead>
			<tbody>
			    <tr>
			    	<td><?php echo $row[11]?></td>
			    	<td><?php echo $row[12]?></td>
			    	<td><?php echo 1,$row[10]," - ",floor(($row[03]/3)),$row[10]?></td>
			    </tr>
			</tbody>
		</table>
		<form method="post">
			<div class="form group">
						<label>How much you want to buy:</label>
						<select name="weight" class="form-control" required>
							<?php
							for($i=1; $i<=floor(($row[03]/3)); $i++){
								?>
							<option value=<?php echo $i ?>><?php echo $i,$row[10] ?></option>
							<?php
						}
					    ?>
					    </select>
				</div>
		<input type="submit" name="rank_c" value="Register">
	</form>
</div>
</div>
</body>
</html>