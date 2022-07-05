<?php 
include '../server/server.php';
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");
?>

<?php
$paid_unpaid = $_POST["status"];
$remarks = $_POST["remarks"];
$id = $_POST["national"];
$username = $_POST["fname"];
$balance = $_POST["balance"];
$datefull = date("Y-m-d");
$files = "";

include 'data.php';


$mail = new PHPMailer\PHPMailer\PHPMailer();

$query = "SELECT application_type from tblbusinessinfo where id = ".$id;
$result = $conn->query($query);
$container = $result->fetch_assoc();
$business_status = $container['application_type'];



$files = "";
$total = isset($_FILES["docu"]["name"]) ? count($_FILES["docu"]["name"]):0;

for($i = 0 ; $i < $total; $i++){
    
$size = sizecheck($_FILES['docu']['size'][$i]); //create html for this //gets the size of file
$path = '../assets/uploads/business_files/'.$id.$username; //location of file folder


if($size < 100000.0){
    $temp_file = $_FILES['docu']['tmp_name'][$i]; 
    $files .= "admin".$datefull.$_FILES['docu']['name'][$i].",";
    if($temp_file !=""){

        $newfilepath = $path."/admin".$datefull.$_FILES['docu']['name'][$i];

        if(move_uploaded_file($temp_file, $newfilepath)){       //uploading the files into the folder
            $mail->addAttachment($newfilepath,$_FILES['docu']['name'][$i]);
        }else{

            echo "Upload error encountered:".$_FILES['docu']['error'][$i];

        }
    }else{
        echo "error no files found";
    } 
}else{

    echo "File too large";

}
}


$mail->Subject = $admin[0]['email_title'];		//title of email //editable
$mail->AltBody = "Payment has been received download your requested documents on your account."; //alternative content //editable
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
$mail->AddEmbeddedImage("../assets/uploads/admin_folder/".$admin[0]['system_logo'], 'logo');




if($remarks != ""){
    if ($paid_unpaid == 'paid'){
           
        $query = "UPDATE tblbusiness SET payment = 'paid', last_pass = '".$datefull."', balance = '0', business_status = '".$business_status."' where business_id = ".$id;    
        $result = $conn->query($query);

        $query3 = "UPDATE tblbusinesspayments SET balance = '".$balance."', date = '".$datefull."', status = '".$business_status."' where id = ".$id;    
        $result = $conn->query($query3);


        $query2 = "INSERT INTO tblnotif (`id`, `username`, `remarks`,`status`,`files`) VALUES ('$id', '$username', '$remarks','$paid_unpaid','$files')";
        if($conn->query($query2)){
            $mail->Body =   "<div style = 'text-align:center;'>"
                            ."<img src = 'cid:logo'></img></br>"
                            ."<p>".$admin[0]['system_name']."</p></br>"
                            ."<p>Payment Received - ".$remarks."</p></br>"
                            ."<a href = '#'> Visit ".$admin[0]['system_name']."</a></div>";

            if($mail->send()){
                // header("Location: ../business_balance.php?balance=unpaid");
                echo "<script>window.location.href='../business_balance.php?balance=unpaid'</script>";
            }else{
                echo "Error in Sending Email". $mail->ErrorInfo;
            }
        }else{
            echo "error updating database";
        }
        
        
    }else if ($paid_unpaid == 'unpaid'){
        
        $query = "UPDATE tblbusiness SET payment = 'unpaid' where business_id = ".$id;
        $result = $conn->query($query);

        $query3 = "DELETE FROM tblbusinesspayments where id = ".$id." AND YEAR(date) = ".date('Y');    
        $result = $conn->query($query3);

        $query2 = "INSERT INTO tblnotif (`id` , `username`, `remarks`,`status`) VALUES ('$id', '$username', '$remarks','$paid_unpaid')";
        if($conn->query($query2)){
            $mail->Body =   "<div style = 'text-align:center;'>"
                            ."<img src = 'cid:logo'></img></br>"
                            ."<p>".$admin[0]['system_name']."</p></br>"
                            ."<p>Invalid Receipt - ".$remarks."</p></br>"
                            ."<a href = '#'> Visit ".$admin[0]['system_name']."</a></div>";
            if($mail->send()){
                // header("Location: ../business_balance.php?balance=unpaid");
                echo "<script>window.location.href='../business_balance.php?balance=unpaid'</script>";
            }else{
                echo "Error in Sending Email". $mail->ErrorInfo;
            }
        }else{
            echo "error updating database";
        }
        
    }
}else{
    if ($paid_unpaid == 'paid'){
        $remarks = "Payments has been received."; 
        $query = "UPDATE tblbusiness SET payment = 'paid', last_pass = '".$datefull."', balance = '0', business_status = '".$business_status."' where business_id = ".$id;    
        $result = $conn->query($query);

        $query3 = "UPDATE tblbusinesspayments SET balance = '".$balance."', date = '".$datefull."',status = '".$business_status."' where id = ".$id;    
        $result = $conn->query($query3);

        $query2 = "INSERT INTO tblnotif (`id`, `username`, `remarks`,`status`,`files`) VALUES ('$id', '$username', '$remarks','$paid_unpaid','$files')";
        
        if($conn->query($query2)){
            $mail->Body =   "<div style = 'text-align:center;'>"
                            ."<img src = 'cid:logo'></img></br>"
                            ."<p>".$admin[0]['system_name']."</p></br>"
                            ."<p>".$remarks."</p></br>"
                            ."<a href = '#'> Visit ".$admin[0]['system_name']."</a></div>";
            if($mail->send()){
                // header("Location: ../business_balance.php?balance=unpaid");
                echo "<script>window.location.href='../business_balance.php?balance=unpaid'</script>";
            }else{
                echo "Error in Sending Email". $mail->ErrorInfo;
            }
        }else{
            echo "error updating database";
        }

    }else if ($paid_unpaid == 'unpaid'){
        $remarks = "Invalid Receipt."; 
        $query = "UPDATE tblbusiness SET payment = 'unpaid' where business_id = ".$id;
        $result = $conn->query($query);
        
        
        $query3 = "DELETE FROM tblbusinesspayments where id = ".$id." AND YEAR(date) = ".date('Y');    
        $result = $conn->query($query3);

 
        $query2 = "INSERT INTO tblnotif (`id` , `username`, `remarks`,`status`) VALUES ('$id', '$username', '$remarks','$paid_unpaid')";
       
        if($conn->query($query2)){

            $mail->Body =   "<div style = 'text-align:center;'>"
                            ."<img src = 'cid:logo'></img></br>"
                            ."<p>".$admin[0]['system_name']."</p></br>"
                            ."<p>".$remarks."</p></br>"
                            ."<a href = '#'> Visit ".$admin[0]['system_name']."</a></div>";

            if($mail->send()){
                // header("Location: ../business_balance.php?balance=unpaid");
                echo "<script>window.location.href='../business_balance.php?balance=unpaid'</script>";
            }else{
                echo "Error in Sending Email". $mail->ErrorInfo;
            }
        }else{
            echo "error updating database";
        }
        
    }
}



//functions
function sizecheck($size){ //gets the size of the files passed 
    $kb_size = $size/1024;
    $format_size = number_format($kb_size,2);
    return $format_size;
}

?>


