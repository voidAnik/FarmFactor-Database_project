<?php
	$username=$f_name="";
	session_start();
	$username = $_SESSION['user'];
	$f_name = $_SESSION['f_name'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Giving advertisement</title>
	<link rel="icon" href="logo2.png">
	<link rel="stylesheet" type="text/css" href="style.css" >
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


	<link rel="stylesheet" href="nav.css">
	<style>
		ul {
		  background-color: rgba(0,0,0,0.6);
		}

.center {
  text-align: center;
  border: 3px solid orange;
}
#nbtn{
				position: absolute;
				top: 1%;
				left:79%;
			}

</style>
</head>
<body>
	<?php
	include 'database_conn.php';


    if(isset($_POST['add_ad']))
    {
    	    $name = $_POST['p_name'];
            $weight = $_POST['weight'];
            $unit = $_POST['unit'];
            $price = $_POST['price'];
            $end_date = $_POST['end_date'];
            $end_time = $_POST['end_time'];

            //print_r($_FILES['sample_img']);
            $uploaded_img=$_FILES['sample_img']['tmp_name'];
            $uploadpath='Database/sample_images/'.$_FILES['sample_img']['name'];

            //echo $uploaded_img.' '.$uploadpath;
            move_uploaded_file($uploaded_img,$uploadpath);

             $insert = $conn->prepare("INSERT INTO `product_on_sale`(`product_name`, `farmer_name` , `weight`, `wanted_price/unit`, `sample_image`, `ad_date`, `ad_time`, `ending_date`, `ending_time`, `unit`, `sale_start_date`, `sale_start_time`, `fkf_username`) 
             	VALUES ( '$name','$f_name','$weight','$price','$uploadpath', CURDATE(),CURTIME(),'$end_date','$end_time','$unit', DATE(DATE_ADD(NOW(),INTERVAL 2 DAY)),TIME(DATE_ADD(NOW(),INTERVAL 2 DAY)),'$username')");
            try{
                $insert->execute();
                 ?>
                <script>
	                window.alert("Added to Ad list Successfully");
	                window.location.assign("fview_product_on_sale.php");
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
			$query="select * from notifications where fkf_username='$username'";
			$returnvalue=$conn->query($query);
			$rowcount=$returnvalue->rowCount();
			$table=$returnvalue->fetchAll();
			$i=1;
			foreach($table as $row){
				?>
				
				<div>
					<?php echo $i.')'."time:".''.$row[2]?>
					<div style="display:inline-block;width:30%;"><?php echo $row[1]?></div>
					<hr/>
				</div>
					<?php
					$i+=1;
				}
			?>
		
	</div>

	<ul>
		
		
	  <li><a class="active" href="fview_product_on_sale.php"><i class="fa fa-reply"></i> Back </a></li>
	  <li><a href="#contact"><i class="fa fa-fw fa-envelope"></i>Contact(farmfactor@gmail.com)</a></li>
	   

	  <li><a href="#" class="notification" data-toggle="popover" data-placement="bottom"><i class="fa fa-fw fa-bell"></i>
	  <span>Inbox</span>
	  <span class="badge"><?php echo $rowcount ?></span>
		</a></li>
		
	  <li style="float: right; background-color: rgb(255,0,0);"><a href="login.php">logout</a></li>
	 
	</ul>

	<div class="container">
		<div class="Box">
			<div class="row">
				<div class="col-md-9 login-bottom">
				<h2>Give details of your product</h2>
				<form action="advertisement_form.php" enctype="multipart/form-data" method="post">
					<div class="form group">
						<label>Product Name:</label>
						<input type="text" name="p_name" class="form-control" required>
					</div>

					<div class="form group">
						<label>How much want to sell:</label>
						<input type="number" name="weight" class="form-control" required>
					</div>

					<div class="form group">
						<label>Select unit:</label>
						<select name="unit" class="form-control" required>
					    <option value="Kg">Kilogram</option>
					    <option value="gram">Gram</option>
					    <option value="Ltr">Litre</option>
					    <option value="Mound">Mound</option>
					    </select>
					</div>

					<div class="form group">
						<label>Your price:</label>
						<input type="number" name="price" class="form-control" required>
					</div>

					<div class="form group">
						<label>Required limit date:</label>
						<input type="date" name="end_date" class="form-control" required>
					</div>

					<div class="form group">
						<label>Required limit time:</label>
						<input type="time" name="end_time" class="form-control" required>
					</div>
					<div>
						<label>Upload your sample image:(optional)</label>
						<input type="file" name="sample_img" class="form-control">
					</div>

					<!-- <input type="hidden" name="role" value="farmer"> -->
					<input type="submit" name="add_ad" value="Add to advertisement page" class="btn btn-primary">
				</form>

				</div>


			</div>
		</div>
	</div>
</body>
</html>
