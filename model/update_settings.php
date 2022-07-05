<?php 
    include '../server/server.php'; 
?>
<?php
$name = $_POST["name"];
$color = $_POST["color"];
$contact_name = $_POST["contact_name"];
$contact_number = $_POST["contact_number"];
$email = $_POST["email"];
$email_name = $_POST["email_name"];
$email_title = $_POST["email_title"];
$type_corporation = $_POST["type_corporation"];
$type_cooperative = $_POST["type_cooperative"];
$type_partnership = $_POST["type_partnership"];
$type_single = $_POST["type_single"];
$date = date("Y/m/d");
$path = "../assets/uploads/admin_folder/";

$extension_qr = pathinfo($_FILES['qr']['name'], PATHINFO_EXTENSION);
$qrname = "qrcode_payment.".$extension_qr;
$qr_path = $path.$qrname;
$qr_file = $_FILES['qr']['tmp_name'];

$extension_logo = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
$logo = "system_logo.".$extension_logo;
$logo_path = $path.$logo;
$logo_file = $_FILES['logo']['tmp_name'];


$sizelogo = sizecheck($_FILES['logo']['size']);
$sizeqr = sizecheck($_FILES['qr']['size']);

if($sizelogo < 10000.0 ){
    if($sizeqr < 10000.0 ){
        
        move_uploaded_file($qr_file, $qr_path);
        move_uploaded_file($logo_file, $logo_path);
            $query = "UPDATE tbladmin SET system_name = '".$name."', system_color = '".$color."', system_logo = '".$logo."', business_gcash = '".$qrname."', business_contact_name = '".$contact_name."', business_contact_no = '".$contact_number."', business_email = '".$email."',email_name = '".$email_name."', email_title= '".$email_title."', type_single_fee= '".$type_single."', type_partnership_fee= '".$type_partnership."', type_cooperative_fee= '".$type_cooperative."', type_corporation_fee= '".$type_corporation."' where id = '2'";
            if($conn->query($query)){
                header('location: ../settings_system.php');
            }else{
                echo ("Error uploading file");
            }
    }
}else{
    echo ("file too large");
    echo ($sizelogo);
}
    
  
        
        function sizecheck($size){ //gets the size of the files passed 
            $kb_size = $size/1024;
            $format_size = number_format($kb_size,2);
            return $format_size;
        }
?>