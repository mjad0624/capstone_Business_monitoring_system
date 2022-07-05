<?php include '../server/server.php' ?>
<?php
// $status = $_POST["balance"];
$id2 = $_POST["national"];
$username = $_POST["username"];
$date = date("Y-m-d");
$files = "";


$total = isset($_FILES["receipt"]["name"]) ? count($_FILES["receipt"]["name"]):0;
    
$size = sizecheck($_FILES['receipt']['size']); //gets the size of file
$path = '../assets/uploads/business_files/'.$id2.$username; //location of file folder

echo ($id2)."</br>";
echo ($username)."</br>";
echo ($date)."</br>";
echo ($files)."</br>";

if($size < 1000.0){

    $temp_file = $_FILES['receipt']['tmp_name']; 
    $files = "receipt_".$date."_".$_FILES['receipt']['name'];
    if($temp_file !=""){

        $newfilepath = $path."/receipt_".$date."_".$_FILES['receipt']['name'];

        if(move_uploaded_file($temp_file, $newfilepath)){//uploading the files into the folder 
            $query1 = "UPDATE tblbusiness SET payment = 'pending' where business_id = ".$id2;
            $result  = $conn->query($query1);
            
            $query2 = "INSERT INTO tblbusinesspayments (`id`, `username`, `date`,`pic_receipt`) VALUES ('$id2', '$username', '$date','$files')";
            if($conn->query($query2))
            {   
                $_SESSION['message'] = 'All files has been passed wait for further information.';
                $_SESSION['success'] = 'message';        
                header("Location: ../business_client.php");
            }else{
                echo ("error inserting data in the database");
            }

        }else{

            echo "Upload error encountered:".$_FILES['docu']['error'];

        }
    }else{
        echo "error no files found";
    } 
}else{

    echo "File too large";

}


        
        






//functions
function sizecheck($size){ //gets the size of the files passed 
    $kb_size = $size/1024;
    $format_size = number_format($kb_size,2);
    return $format_size;
}

?>

