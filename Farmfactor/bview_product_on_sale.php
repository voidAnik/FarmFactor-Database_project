 <?php
 	session_start();
 	$username=$_SESSION['user'];
 ?>

 <!DOCTYPE html>
 <html>
 <!-- Navigation bar -->



 	 <title>View for Buyer</title>
 	 <link rel="icon" href="logo2.png">

 	<link rel="stylesheet" type="text/css" href="style.css" >
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="nav.css">
	
<link rel="stylesheet" href="nav.css">
 <style>
 	ul {
		  background-color: rgba(0,0,0,0.6);
		}

.center {
  text-align: center;
  border: 3px solid orange;
}


 		<link rel="icon" href="logo2.png">
		 #myInput[type=text] {
		  -webkit-transition: width 0.4s ease-in-out;
		  transition: width 0.4s ease-in-out;
		}
		#myInput[type=text]{
			margin-left: .5%;
			height: 7%;
			width: 30%;
			border: 1px solid orange;
			padding: 12px 20px 12px 40px;
		}
		#myInput[type=text]:focus {
		  width: 100%;
		}

		#myTable {
		  border-collapse: collapse; /* Collapse borders */
		  width: 100%; /* Full-width */
		  border: 1px solid #ddd; /* Add a grey border */
		  font-size: 18px; /* Increase font-size */
		  overflow-x: auto;
		}

		#myTable th, #myTable td {
		  text-align: left; /* Left-align text */
		  padding: 12px; /* Add padding */
		}

		#myTable tr {
		  /* Add a bottom border to all table rows */
		  border-bottom: 1px solid blue;
		}

		#myTable tr.header, #myTable tr:hover {
		  /* Add a grey background color to the table header and on hover */
		  background-color: #FF5733;
		}
		.onsale{
				height: 500px;
				overflow: auto;
			}
		td img{
				width:100px;
				height:100px;
			}
			td{
				text-align: center;
			}
			.active {
			  background-color: #4CAF50;
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
	  <li><a class="active" href="homepage.php"><i class="fa fa-reply"></i> Back </a></li>
	  <li><a href="#contact"><i class="fa fa-fw fa-envelope"></i>Contact(farmfactor@gmail.com)</a></li>
	 
	  

	  <li><a href="#" class="notification" data-toggle="popover" data-placement="bottom"><i class="fa fa-fw fa-bell"></i>
	  <span>Inbox</span>
	  <span class="badge"><?php echo $rowcount ?></span>
		</a></li>

		<li style="float: right; background-color: rgb(150,0,0);"><a href="login.php">logout</a></li>
		<li style="float: right; background-color: rgb(0,150,0);"><a href="buyer_registers.php">Registered product</a></li>
		<li style="float: right; background-color: #1a1a1a;"><a href="cart.php"><i class="fa fa-cart-arrow-down"></i>cart</a></li>
	</ul> 


			<?php
				$userquery = "SELECT * FROM product_on_sale";
				$returnvalue = $conn->query($userquery);
				$table = $returnvalue->fetchAll();
			?>
			<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for products and click for details">
			<div class="onsale">
			<table class="table table-hover table-light" id="myTable">
			<thead>
				<!-- <tr>
					<th colspan="12"><h2>Products on sale based on your search[Click product to see details]</h2></th>
				</tr> -->
				<tr class="header">
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
			<?php
			///$table is a two dimensional array, first loop will return each row of the table
			for($i=0; $i<count($table); $i++)
			{
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

 	<script>
 		function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[`1`];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
highlight_row();
function highlight_row() {
    var table = document.getElementById('myTable');
    var cells = table.getElementsByTagName('td');

    for (var i = 0; i < cells.length; i++) {
        // Take each cell
        var cell = cells[i];
        // do something on onclick event for cell
        cell.onclick = function () {
            // Get the row id where the cell exists
            var rowId = this.parentNode.rowIndex;

            var rowsNotSelected = table.getElementsByTagName('tr');
            for (var row = 0; row < rowsNotSelected.length; row++) {
                rowsNotSelected[row].style.backgroundColor = "";
                rowsNotSelected[row].classList.remove('selected');
            }
            var rowSelected = table.getElementsByTagName('tr')[rowId];
            rowSelected.style.backgroundColor = "white";
            rowSelected.className += " selected";

            location.assign("bidding_pg.php?serial="+rowSelected.cells[0].innerHTML);
        }
    }


}
</script>
 </body>
 </html>
