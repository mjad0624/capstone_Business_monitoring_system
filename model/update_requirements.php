<?php 
    include '../server/server.php'; 
?>
<?php
$title = $_POST["title"];
$description = $_POST["description"];
$date = date("Y-m-d");
$path = "../assets/uploads/admin_folder/";

$extension_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$file_name = $date."business_requirements.".$extension_file;
$file_path = $path.$file_name;
$file_file = $_FILES['file']['tmp_name'];


$sizefile = sizecheck($_FILES['file']['size']);

if($sizefile < 10000.0 ){
        move_uploaded_file($file_file, $file_path);
            $query = "UPDATE tbladmin SET client_requirement = '".$description."',client_requirement_title = '".$title."',client_requirement_file = '".$file_name."' where id = '2'";
            if($conn->query($query)){
                header('location: ../settings_business.php');
            }else{
                echo ("Error uploading file");
            }
    
}else{
    echo ("file too large");
    echo ($sizefile);
}
    
  
        
        function sizecheck($size){ //gets the size of the files passed 
            $kb_size = $size/1024;
            $format_size = number_format($kb_size,2);
            return $format_size;
        }
?>