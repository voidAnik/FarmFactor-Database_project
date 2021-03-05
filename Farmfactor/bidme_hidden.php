<?php
    session_start();
    $ad=$_SESSION['ad'];
    $username=$_SESSION['user'];
    $rank=$_SESSION['rank'];

        include 'database_conn.php';
                
        $query="select * from bidding_room where fkad_id=$ad AND rank_id='$rank' ORDER BY bid_time DESC";
                
        $returntable=$conn->query($query);
        $table=$returntable->fetchAll();

    $codestr="";

    foreach($table as $row){
    $codestr=$codestr."<tr><td>$row[0]</td><td>$row[7]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[6]</td><td>$row[5]</td></tr>";
    
    }
              
    echo $codestr;
?>