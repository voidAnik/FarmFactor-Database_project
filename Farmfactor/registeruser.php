<?php
if(isset($_POST['Role']))
{ 
	$Role=$_POST['Role'];
}
    include 'database_conn.php';

        //Data insertion from user
        if(isset($_POST['signup']) && $Role == 'farmer')
        {
        	//echo "IN2";

            $username = $_POST['username'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $pnumber = $_POST['number'];
            $farm_loc = $_POST['farm_loc'];
            $bank_acc = $_POST['bank_acc'];
            
         /*echo $username.' '.$password.' '.$name.' '.$address.' '.$pnumber.' '.$farm_loc.' '.$bank_acc;*/
            $checkquery = "select * from farmer where f_username='$username'";
            $returnvalue=$conn->query($checkquery);
            $rowcount=$returnvalue->rowCount();
            if($rowcount==1)
            {
                ?>
                    <script>
                        //window.location.assign("signup_form.php");
                        window.alert("Username Already exist try a new one!");
                    </script>
                <?php
            }
            else
            {
            
            $insert = $conn->prepare("INSERT INTO farmer(`f_username`, `f_user_pass`, `farmer_name`, `f_address`, `f_phone_number`, `farm_location`,`f_account_no`) values('$username','$password','$name','$address','$pnumber','$farm_loc','$bank_acc')");
            try{
                $insert->execute();
                 ?>
                <script>
	                window.alert("Signed up Successfully");
	                window.location.assign("login.php");
            	</script>
            	<?php
                }
                catch(PDOException $ex)
                {
                ?>
                <script>
                    window.alert("Database insertion error");
                </script>
            	<?php
            	}
            }
        }
        if(isset($_POST['signup']) && $Role == 'buyer')
        {

            $username = $_POST['username'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $pnumber = $_POST['number'];
            $com_loc = $_POST['com_loc'];
            $com_name = $_POST['com_name'];
            $bank_acc = $_POST['bank_acc'];
            
         /*echo $username.' '.$password.' '.$name.' '.$address.' '.$pnumber.' '.$com_loc.' '.$bank_acc;*/
         $checkquery = "select * from buyer where b_username='$username'";
            $returnvalue=$conn->query($checkquery);
            $rowcount=$returnvalue->rowCount();
            if($rowcount==1)
            {
                ?>
                    <script>
                        //window.location.assign("signup_form.php");
                        window.alert("Username Already exist try a new one!");
                    </script>
                <?php
            }
            else
            {
                
                $insert = $conn->prepare("INSERT INTO `buyer`(`b_username`, `b_user_pass`, `buyer_name`, `b_address`, `b_phone_number`, `company_location`, `company_name`, `b_account_no`) values('$username','$password','$name','$address','$pnumber','$com_loc','$com_name','$bank_acc')");
                try
                {
                    $insert->execute();
                    ?>
                    <script>
    	                window.alert("Signed up Successfully");
    	                window.location.assign("login.php");
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
        }    
?>