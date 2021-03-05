<?php
    session_start();
    $ad=$_SESSION['ad'];
    include 'database_conn.php';
    $query="select fkb_username from bidding_room 
    		where bid_price =
    		(
    			SELECT MAX(bid_price)
    			FROM bidding_room
    		)";
         			$returntable=$conn->query($query);
                    $table=$returntable->fetchAll();
                    $row=$table[0];
     $query="select * from bidding_cart 
    		where fkad_id = $ad AND fkb_username = '$row[0]'";
         			$returntable=$conn->query($query);
                    $table=$returntable->fetchAll();
                    $row=$table[0];

    $query="select * from cart where fkb_username='$row[5]' AND fkbid_cart_serial_no= $row[0]";
    $returnvalue=$conn->query($query);
    $rowcount=$returnvalue->rowCount();
    if($rowcount==0)
    {
     $insert= $conn->prepare("INSERT INTO `cart`(`product_name`, `product_amount`, `product_total_price`, `fkb_username`, `fkbid_cart_serial_no`) VALUES ('$row[1]',$row[3],$row[3]*$row[4],'$row[5]',$row[0])");
     $insert1 = $conn->prepare("INSERT INTO `notifications`(`text`, `notify_date_time`, `fkb_username`) VALUES ('You win the bidding for Ad number=$ad check your cart!',NOW(),'$row[5]')"); 
      try
                {
                    $insert->execute();
                    $insert1->execute();
                    ?>
                    <script>
                       
                        location.assign("bidme_rep.php");                        
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
    <script type="text/javascript">
        location.assign("bidme_rep.php");
    </script>