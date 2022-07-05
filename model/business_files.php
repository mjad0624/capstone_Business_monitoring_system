<?php include '../server/server.php' ?>
<?php
$id = $_SESSION['id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$avatar = $_SESSION['avatar'];

$queryadmin = "SELECT * from tbladmin where id = '2'";
$result = $conn->query($queryadmin);
$admin = array();
while($row = $result->fetch_assoc()){
    $admin[] = $row; 
}

$fname 		= $conn->real_escape_string($_POST['fname']);
$mname 		= $conn->real_escape_string($_POST['mname']);
$lname 		= $conn->real_escape_string($_POST['lname']);
$gender 		= $conn->real_escape_string($_POST['gender']);
$number 		= $conn->real_escape_string($_POST['number']);
$email 		= $conn->real_escape_string($_POST['email']);
$address 		= $conn->real_escape_string($_POST['address']);
$e_number 		= $conn->real_escape_string($_POST['e_number']);
$e_email 		= $conn->real_escape_string($_POST['e_email']);
$relation 		= $conn->real_escape_string($_POST['relation']);
$b_name 		= $conn->real_escape_string($_POST['b_name']);
$b_type 		= $conn->real_escape_string($_POST['b_type']);
$b_address 		= $conn->real_escape_string($_POST['b_address']);
$b_email 		= $conn->real_escape_string($_POST['b_email']);
$b_number 		= $conn->real_escape_string($_POST['b_number']);
$b_area 		= $conn->real_escape_string($_POST['b_area']);
$b_line 		= $conn->real_escape_string($_POST['b_line']);
$b_capital 		= $conn->real_escape_string($_POST['b_capital']);
$b_registration 		= $conn->real_escape_string($_POST['b_registration']);
$b_tax		= $conn->real_escape_string($_POST['b_tax']);
$b_employee		= $conn->real_escape_string($_POST['b_employee']);
$lessor 		= $conn->real_escape_string($_POST['lessor']);
$l_address 		= $conn->real_escape_string($_POST['l_address']);
$l_rental 		= $conn->real_escape_string($_POST['l_rental']);
$l_number 		= $conn->real_escape_string($_POST['l_number']);
$a_type 		= $conn->real_escape_string($_POST['a_type']);
$mode_payment   = "annually";




$files = "";
$date = date("01/20/Y"); //renewal date
$current_date = date("Ymd"); //present date

$total = isset($_FILES["docu"]["name"]) ? count($_FILES["docu"]["name"]):0;

for($i = 0 ; $i < $total; $i++){
    
$size = sizecheck($_FILES['docu']['size'][$i]); //create html for this //gets the size of file
$path = '../assets/uploads/business_files/'.$_SESSION['id'].$_SESSION['username']; //location of file folder


if($size < 10000.0){

    $query1 = "SELECT * FROM tblbusiness where business_id = ".$id;   
    $result = $conn->query($query1);
    $output = $result->fetch_assoc();

    if($result->num_rows){
        echo ("business already exist");
    }else{
        $query1 = "INSERT INTO tblbusiness (`business_id`, `business_name`,`business_logo`) VALUES ('$id', '$username','$avatar')";
        $result = $conn->query($query1);
    }

    $queryinfo = "SELECT * FROM tblbusinessinfo where id = ".$id;   
    $resultinfo = $conn->query($queryinfo);

    if($resultinfo->num_rows){
        // $query1 = "UPDATE tblbusiness SET business_files =".$files." where business_id = ".$id;
        // $result  = $conn->query($query1);
    }else{
        $query2 = "INSERT INTO tblbusinessinfo (`id`,`profile`) VALUES ('$id','$avatar')";
        $result = $conn->query($query2);
    }

    if(!file_exists($path)){//checks if file exist

     mkdir($path, 0777 , true);//making  the folder
    }

    $temp_file = $_FILES['docu']['tmp_name'][$i]; 
    $files .= $current_date."_".$_FILES['docu']['name'][$i].",";
    if($temp_file !=""){

        $newfilepath = $path."/".$current_date."_".$_FILES['docu']['name'][$i];

        if(move_uploaded_file($temp_file, $newfilepath)){       //uploading the files into the folder

            $query1 = "UPDATE tblbusiness SET business_files = '".$files."' where business_id = ".$id;
            $result  = $conn->query($query1);

            if($result === true){
              
                $status = $output["status"];
                $last_pass = $output["last_pass"];

                if($status == "passed"){
                    $queryinfo = "UPDATE tblbusinessinfo SET firstname = '".$fname."',midlename = '".$mname."',lastname = '".$lname."',gender = '".$gender."',contact = '".$number."',emailadd = '".$email."',address = '".$address."',e_contact = '".$e_number."',e_emailadd = '".$e_email."',e_relationship = '".$relation."',b_name = '".$b_name."',b_type = '".$b_type."',b_address = '".$b_address."',b_emailadd = '".$b_email."',b_contact = '".$b_number."',b_line = '".$b_line."',b_area = '".$b_area."',b_capital = '".$b_capital."',dti_coa_number = '".$b_registration."',tax_number = '".$b_tax."',number_employee = '".$b_employee."',lessor = '".$lessor."',monthly_rent = '".$l_rental."',l_contact = '".$l_number."',application_type = '".$a_type."',mode_payment = '".$mode_payment."' where id = ".$id;
                    $resultinfo  = $conn->query($queryinfo);

                    if(datecheck($last_pass)==true){
                        $query1 = "UPDATE tblbusiness SET status = 'pending' where business_id = ".$id;
                        $result  = $conn->query($query1);
                        if ($role == "business"){
                            $_SESSION['message'] = 'All files has been passed wait for further information.';
                            $_SESSION['success'] = 'message';   
                            // header("Location: ../business_client.php");
                        }else{

                            header("Location: ../business_dashboard.php");
                        }
                    }
                }else if($status == "missing"){
                    $queryinfo = "UPDATE tblbusinessinfo SET firstname = '".$fname."',midlename = '".$mname."',lastname = '".$lname."',gender = '".$gender."',contact = '".$number."',emailadd = '".$email."',address = '".$address."',e_contact = '".$e_number."',e_emailadd = '".$e_email."',e_relationship = '".$relation."',b_name = '".$b_name."',b_type = '".$b_type."',b_address = '".$b_address."',b_emailadd = '".$b_email."',b_contact = '".$b_number."',b_line = '".$b_line."',b_area = '".$b_area."',b_capital = '".$b_capital."',dti_coa_number = '".$b_registration."',tax_number = '".$b_tax."',number_employee = '".$b_employee."',lessor = '".$lessor."',monthly_rent = '".$l_rental."',l_contact = '".$l_number."',application_type = '".$a_type."',mode_payment = '".$mode_payment."' where id = ".$id;
                    $resultinfo  = $conn->query($queryinfo);
                                        
                    $query1 = "UPDATE tblbusiness SET status = 'pending' where business_id = ".$id;
                    $result  = $conn->query($query1);
                    if ($role == "business"){
                        $_SESSION['message'] = 'All files has been passed wait for further information.';
                        $_SESSION['success'] = 'message';   
                        // header("Location: ../business_client.php");
                    }else{
                        header("Location: ../business_dashboard.php");
                    }
                }else if($status == "pending"){
                    $queryinfo = "UPDATE tblbusinessinfo SET firstname = '".$fname."',midlename = '".$mname."',lastname = '".$lname."',gender = '".$gender."',contact = '".$number."',emailadd = '".$email."',address = '".$address."',e_contact = '".$e_number."',e_emailadd = '".$e_email."',e_relationship = '".$relation."',b_name = '".$b_name."',b_type = '".$b_type."',b_address = '".$b_address."',b_emailadd = '".$b_email."',b_contact = '".$b_number."',b_line = '".$b_line."',b_area = '".$b_area."',b_capital = '".$b_capital."',dti_coa_number = '".$b_registration."',tax_number = '".$b_tax."',number_employee = '".$b_employee."',lessor = '".$lessor."',monthly_rent = '".$l_rental."',l_contact = '".$l_number."',application_type = '".$a_type."',mode_payment = '".$mode_payment."' where id = ".$id;
                    $resultinfo  = $conn->query($queryinfo);
                                        
                    $query1 = "UPDATE tblbusiness SET status = 'pending' where business_id = ".$id;
                    $result  = $conn->query($query1);

                    if ($role == "business"){

                    if ($role == "business"){
                        $_SESSION['message'] = 'All files has been passed wait for further information.';
                        $_SESSION['success'] = 'message';   
                        header("Location: ../business_client.php");
                    }else{
                        header("Location: ../business_dashboard.php");
                    }
                }
                
                }else{
                    if ($role == "business"){
                        $_SESSION['message'] = 'All files has been passed wait for further information.';
                        $_SESSION['success'] = 'message';   
                        header("Location: ../business_client.php");
                    }else{
                        header("Location: ../business_dashboard.php");
                    }
                }
                
            }else{
                echo "Error";
            }

        }else{

            echo "Upload error encountered:".$_FILES['docu']['error'][$i];

        }
    } 
}else{

    echo "File too large";

}
}


//checking functions

function businesscheck($id,$conn,$username){
}

function sizecheck($size){ //gets the size of the files passed 
    $kb_size = $size/1024;
    $format_size = number_format($kb_size,2);
    return $format_size;
}

function datecheck($pass){ //compared the current date and jan 20 (x)year
    $last_pass =  date("Y",strtotime($pass)); //gets the year from database
    if($last_pass == date("Y")){
        return true;
    }else{
        return false;
    }
}

function clearcheck($status){ //checks if business passed the papers    
    if($status == "clear"){
        
    }else if($status == "pending"){
        
    }
}
?>