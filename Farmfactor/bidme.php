<?php
session_start();
$username=$_SESSION['user'];
$quantity="";
if(isset($_GET['ad']))
{
    $_SESSION['ad'] = $_GET['ad']; 
    $_SESSION['rank'] = $_GET['rank'];
    $_SESSION['weight'] = $_GET['weight'];
}

$ad=$_SESSION['ad'];
$rank=$_SESSION['rank'];
$quantity=$_SESSION['weight'];
?>
<html>

    <head>
       
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="icon" href="logo2.png">
        <link rel="stylesheet" type="text/css" href="nav.css">
        <style>
        p{
          text-align: center;
          font-size: 40px;
          margin-top: 5px;
        }

            body {font-family: Arial, Helvetica, sans-serif;}
            * {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border-color: black;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
#bidding{
    position: auto; 
    width: 100%; 
    height: 300px; 
    overflow: auto;
    
    overflow: auto;

    .scroll{
            height: 170px;
            overflow: auto;
          }

   
}

        

        </style>

    </head>

    <body>
        <p id="demo"></p>
        

  <ul>
    
    <li style="float: right; background-color: rgb(255,0,0);"><a href="buyer_registers.php">Quit</a></li>
   
    
    
  </ul>

        <button class="open-button" id="open" onclick="openForm()">BID</button>
         <div class="chat-popup" id="myForm">
          <form action="bidme.php" class="form-container" method="post">
            <h1>BIDDING:</h1>

            <label for="msg"><b>Price</b></label>
            <input type="text" name="ppunit" id="ppunit" placeholder="Enter your bidding Price per unit">
            <button type="submit" name="submitbtn" value="bid" class="btn">Send</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
          </form>
        </div>
    <div class="Bid">

        <table class="table table-striped" id="Bidding" >
<!--            showing the table headers       -->

            <thead class="thead-dark" >
              <div class="scroll">
                <tr>
                    <td>Bid Id</td>
                    <td>Ad number</td>
                    <td>Rank</td>
                    <td>Bid Price/Unit</td>
                    <td>Quantity</td>
                    <td>Bid Time</td>
                    <td>Bid User Id</td>
                    <td>Is Confirmed</td>
                </tr>
            </thead>

            <tbody id="replaceme">
                <?php

                   include 'database_conn.php';
                
                    $query="select * from bidding_room where fkad_id=$ad AND rank_id='$rank' ORDER BY bid_time DESC";
                
                    $returntable=$conn->query($query);
                    $table=$returntable->fetchAll();
                
                    foreach($table as $row){

                    ?>
                    
                    <tr>
                        <td><?php echo $row[0]?></td>
                        <td><?php echo $row[7]?></td>
                        <td><?php echo $row[1]?></td>
                        <td><?php echo $row[2]?></td>
                        <td><?php echo $row[3]?></td>
                        <td><?php echo $row[4]?></td>
                        <td><?php echo $row[6]?></td>
                        <td><?php echo $row[5]?></td>
                    </tr>
                  </div>
                    <?php
                    }
                ?>
            </tbody>

        </table>
    </div>
    
   

        
        <script>
            ///refreshing the ajax gui after every 500ms
            setInterval(ajaxcall, 500);
            
            function ajaxcall(){
                var req=new XMLHttpRequest();
                
                req.onreadystatechange=function (){
                    if(req.readyState==4){
                        if(req.status==200){
                            var tbodycomp=document.getElementById('replaceme');
                            ///deleting the previous gui
                            tbodycomp.innerHTML="";
                            ///updating current gui
                            tbodycomp.innerHTML=req.responseText;
                        }
                    }
                }
                
                req.open("GET","bidme_hidden.php");
                req.send();
            }
        
        </script>
        <?php
        if(isset($_POST['ppunit']))
        {
            $price=$_POST['ppunit'];
        }
        if(isset($_POST['submitbtn']) && isset($_POST['ppunit']) && $price>0){
            unset($_POST['submitbtn']);
            
            unset($_POST['ppunit']);
            

            $query="INSERT INTO `bidding_room`(`rank_id`, `bid_price`, `quantity`, `bid_time`, `is_complete`, `fkb_username`, `fkad_id`) VALUES ('$rank','$price','$quantity',NOW(),0,'$username','$ad')";
            $price=0;
            $conn->query($query);
        }
        ?>
       
           
        <!-- <form action="bidme.php" method="post">
            <input type="text" style="width:70%;" name="ppunit" value=-1 id="ppunit" placeholder="Enter your bidding Price per unit">
            <input type="submit" value="Bid" name="submitbtn">
        </form>
    </div> -->
    <?php
                
                    $query="select sale_start_date,sale_start_time from product_on_sale where ad_id=$ad";
                
                    $returntable=$conn->query($query);
                    $table=$returntable->fetchAll();
                    $row=$table[0];
                   ?>
                   <input type="hidden" name="btn" id="sub">
                   <?php
                   if(isset($_SESSION['value']))
                   {
                   	echo "HELLLO";
                   }
                   ?>
    </body>

</html>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<script>
	
    momentOfTime = new Date('<?php echo $row[0]."T".$row[1]; ?>'); // just for example, can be any other time
    if(momentOfTime > new Date().getTime())
    {
    	document.getElementById("demo").innerHTML = "NOT STARTED YET! Check for the sale start time for this product..";
    	document.getElementById("open").disabled = true;
    }
    else
    {
    myTimeSpan = 60*60*1000; // 5 minutes in milliseconds
    momentOfTime.setTime(momentOfTime.getTime() + myTimeSpan);



// Update the count down every 1 second
var x = setInterval(function() {
  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = momentOfTime - now;
    
  // Time calculations for days, hours, minutes and seconds
 /* var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));*/
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML ="ENDS IN: " + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
    document.getElementById("open").disabled = true;
    location.assign("winner.php");
  }
}, 1000);
}

</script>