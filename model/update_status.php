<?php 
    include '../server/server.php'; 
    require("../PHPMailer/src/PHPMailer.php");
    require("../PHPMailer/src/SMTP.php"); 

$pass_reject = $_POST["status"];
$remarks = $_POST["remarks"];
$id = $_POST["national"];
$username = $_POST["fname"];
$date = date("Y/m/d");

// echo ($id);
// echo ($username);
// echo ($pass_reject);
// echo ($remarks);

include 'data.php';

   
    $a_type = $indivinfo[0]['b_type'];
//"this page" means its only in this page(not/should not be included in the data.php)
if($a_type == 'corporation'||$a_type == 'Corporation'){
    $balance_thispage = $admin[0]['type_corporation_fee'];
}else if($a_type == 'cooperative'||$a_type == 'Cooperative'){
    $balance_thispage = $admin[0]['type_cooperative_fee'];
}else if($a_type == 'partnership'||$a_type == 'Partnership' ){
    $balance_thispage = $admin[0]['type_partnership_fee'];
}else if($a_type == 'single'||$a_type == 'Single'){
    $balance_thispage = $admin[0]['type_single_fee'];
}else{
    $balance_thispage = 0;
}


$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->Subject = $admin[0]['email_title'];		//title of email //editable
$mail->AltBody = "Files has been verified please proceed to payment."; //alternative content //editable
// $mail->SMTPDebug = 3;
$mail->isSMTP();
$mail->From = $admin[0]['business_email'];			//sender's email //admin email //editable
$mail->FromName = $admin[0]['email_name'];			        // email name //editable
$mail->isHtml(true);			                            //allows application of html tag to the email
$mailto = $indivinfo[0]['emailadd'];			//email of the receiver 
$mail->Host	 = "mail.smtp2go.com";
$mail->SMTPAuth = "true";				//security to require password
$mail->Username = 		//username
$mail->Password = 		//password
$mail->SMTPSecure = "tls";				//encription
$mail->Port = "2525";		            //port number
$mail->addAddress($mailto, "Business"); 



if($remarks != null){
    if ($pass_reject == 'passed'){ 
        $query = "UPDATE tblbusiness SET balance = '".$balance_thispage."' ,status = '".$pass_reject."', last_pass = '".$date."', status_message = 'Files has been verified you can now proceed to payment' where business_id = ".$id;    
        $result = $conn->query($query);

        $query2 = "INSERT INTO tblnotif (`id` , `username`, `remarks`,`status`) VALUES ('$id', '$username', '$remarks','$pass_reject')";
        
        if($conn->query($query2)){

           $mail->Body =   "<div style = 'text-align:center;'>"
                            ."<img src = 'cid:logo'></img></br>"
                            ."<p>".$admin[0]['system_name']."</p></br>"
                            ."<p>Files has been verified you can now proceed to payment - ".$remarks."</p></br>"
                            ."<a href = '#'> Visit ".$admin[0]['system_name']."</a></div>";
            if($mail->send()){
                // echo "Email Sent";
                // header("Location: ../business_files.php?status=pending");
                echo "<script>window.location.href='../business_files.php?status=pending'</script>";
            }else{
                echo "Error in Sending Email". $mail->ErrorInfo;
            }
        }
       
    }else{
        
        $query = "UPDATE tblbusiness SET status = '".$pass_reject."', status_message = 'Files were rejected please pass again' where business_id = ".$id;
        $result = $conn->query($query);

        $query2 = "INSERT INTO tblnotif (`id` , `username`, `remarks`,`status`) VALUES ('$id', '$username', '$remarks','$pass_reject')";
        
        if($conn->query($query2)){
       
             $mail->Body =   "<div style = 'text-align:center;'>"
                            ."<img src = 'cid:logo'></img></br>"
                            ."<p>".$admin[0]['system_name']."</p></br>"
                            ."<p>Files were rejected please pass again-".$remarks."</p></br>"
                            ."<a href = '#'> Visit ".$admin[0]['system_name']."</a></div>";
            if($mail->send()){
                // echo "Email Sent";
                // header("Location: ../business_files.php?status=passed");
                echo "<script>window.location.href='../business_files.php?status=pending'</script>";
            }else{
                echo "Error in Sending Email". $mail->ErrorInfo;
            }

        }
    }
}else{
    if ($pass_reject == 'passed'){ 
        $query = "UPDATE tblbusiness SET balance = '".$balance_thispage."' ,status = '".$pass_reject."', last_pass = '".$date."', status_message = 'Files has been verified you can now proceed to payment' where business_id = ".$id;    
        $result = $conn->query($query);

        $query2 = "INSERT INTO tblnotif (`id` , `username`, `remarks`,`status`) VALUES ('$id', '$username', 'Files has been verified you can now proceed to payment','$pass_reject')";
        if($conn->query($query2)){
            $mail->Body =   "<div style = 'text-align:center;'>"
                            ."<img src = 'cid:logo'></img></br>"
                            ."<p>".$admin[0]['system_name']."</p></br>"
                            ."<p>Files has been verified you can now proceed to payment.</p></br>"
                            ."<a href = '#'> Visit ".$admin[0]['system_name']."</a></div>"; //email body
            if($mail->send()){
                // echo "Email Sent";
                // header("Location: ../business_files.php");
                echo "<script>window.location.href='../business_files.php?status=pending'</script>";
            }else{
                echo "Error in Sending Email". $mail->ErrorInfo;
            }
        }
    }else{
    
        $query = "UPDATE tblbusiness SET status = '".$pass_reject."', status_message = 'Files were rejected please pass again' where business_id = ".$id;
        $result = $conn->query($query);

        $query2 = "INSERT INTO tblnotif (`id` , `username`, `remarks`,`status`) VALUES ('$id', '$username', 'Files were rejected please pass again ','$pass_reject')";

        if($conn->query($query2)){
            $mail->Body =   "<div style = 'text-align:center;'>"
                            ."<img src = 'cid:logo'></img></br>"
                            ."<p>".$admin[0]['system_name']."</p></br>"
                            ."<p>Files were rejected please pass again.</p></br>"
                            ."<a href = '#'> Visit ".$admin[0]['system_name']."</a></div>";
            if($mail->send()){
                // echo "Email Sent";
                // header("Location: ../business_files.php");
                echo "<script>window.location.href='../business_files.php?status=pending'</script>";
            }else{
                echo "Error in Sending Email". $mail->ErrorInfo;
            }
        }
    }
}
?> 