<?php

//tblbusiness
    $querylastpass = "SELECT YEAR(last_pass) as lastpass, status, payment, balance,business_id,status_message FROM `tblbusiness`";
    $result = $conn->query($querylastpass);
    $contain = array();
    while($row = $result->fetch_assoc()){
	$contain[] = $row; 
    }
    
    // date monitoring, renewal conditions 
    foreach($contain as $container){
    $no = 0;

    //renewed/unrenewed checker
    if($container['lastpass'] != date('Y') && date('d/m') == "20/02" && $container['status'] == "passed" &&  $container['payment'] == "paid" ){
        $updatestatus = "UPDATE tblbusiness SET status = 'missing', business_files = ' ',balance = 0, payment = 'unpaid' where business_id = ".$container['business_id'];
        $result = $conn->query($updatestatus);
    } 

    //files/payments checker
    if($container['lastpass'] == date('Y') && $container['status'] == "passed" && $container['payment'] == "paid" ){
        // echo ("All files are approved wait next year to renew your papers!!!!");
        // echo "</br>";

        $updatestatus = "UPDATE tblbusiness SET status_message = 'All files are approved wait next year to renew your papers.' where business_id = ".$container['business_id'];
        $result = $conn->query($updatestatus);
    
    //pending files checker    
    }else if($container['lastpass'] == date('Y') && $container['status'] == "pending"||$container['payment'] == "pending" ){
        // echo ("All files have pass and still checking");
        // echo "</br>";

        $updatestatus = "UPDATE tblbusiness SET status_message = 'All files has been passes wait for further information.' where business_id = ".$container['business_id'];
        $result = $conn->query($updatestatus);
    
    }else if($container['lastpass'] != date('Y') && $container['status'] == "passed" &&  $container['payment'] == "paid"){
        // echo ("you can now renew your papers!!!");
        // echo "</br>";

        $updatestatus = "UPDATE tblbusiness SET status_message = 'You can now renew your papers.' where business_id = ".$container['business_id'];
        $result = $conn->query($updatestatus);
    
    }else if($container['lastpass'] == date('Y') && $container['status'] == "missing"){
    // echo    ("get the days diff from jan 20");
    // echo "</br>";

        $updatestatus = "UPDATE tblbusiness SET status_message = 'Papers already expired (10 days).' where business_id = ".$container['business_id'];
        $result = $conn->query($updatestatus);

    }

    $no++;
}
     
?>