<?php

$username=$password=$Role="";
$rowcount="";
if( isset($_POST['Username']) ){
	$username=$_POST['Username'];
}
if( isset($_POST['Password']) ){
	$password=$_POST['Password'];
}
else{}
if(isset($_REQUEST['Role']))
{
	$Role=$_REQUEST['Role'];
} 
else
{
	?>
	<script>
	window.alert("select a user first!");
	window.location.assign("login.php");
	</script>
	<?php
}
include 'database_conn.php';
if($Role=='Farmer')
{
	$userquery= "select * from farmer where f_username='$username' AND f_user_pass='$password' ";
	$returnvalue=$conn->query($userquery);
	$rowcount=$returnvalue->rowCount();
	$table = $returnvalue->fetchAll();

	
}
if($Role=='Buyer')
{
		$userquery= "select * from buyer where b_username='$username' AND b_user_pass='$password' ";
	$returnvalue=$conn->query($userquery);
	$rowcount=$returnvalue->rowCount();
	$table = $returnvalue->fetchAll();
}
	$row=$table[0];
	session_start();
	$_SESSION['user'] = $username;
	$_SESSION['f_name'] = $row[2];
if($rowcount==1 && $Role=='Farmer'){
	?>
	<script>
	window.location.assign("fview_product_on_sale.php");
	</script>
	<?php
}
if($rowcount==1 && $Role=='Buyer'){
	?>
	<script>
	window.location.assign("bview_product_on_sale.php");
	</script>
	<?php
}	
else{
	?>
	<script>
	window.alert("Invalid username or password!");
	window.location.assign("login.php");
	</script>
	<?php
}
?>