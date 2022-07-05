<?php 
	include '../server/server.php';


	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
    $idd         = $conn->real_escape_string($_POST['id']);
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
    $username 		= $conn->real_escape_string($_POST['username']);
    $password 		= sha1($conn->real_escape_string($_POST['password']));
	

	$profile 	= $conn->real_escape_string($_POST['profileimg']); // base 64 image
	$profile2 	= $_FILES['img']['name'];
	// $docu 	= $_FILES['docu']['name'];

	// change profile2 name
	$newName = date('dmYHis').str_replace(" ", "", $profile2);

	  // image file directory
  	$target = "../assets/uploads/business_files/business_logo/".basename($profile2);
	// $target2 = "../assets/uploads/business_files/business_logo/".basename($docu);  
	$check = "SELECT username FROM tbl_users WHERE username= '".$username."'";
	$nat = $conn->query($check)->num_rows;	

	if($nat == 0){
		if(empty($username)){

			if(!empty($profile) && !empty($profile2)){
                echo ('dmfknf');
				$query = "INSERT INTO tbl_users (`username`,`password`,`user_type`,`avatar`) VALUES ('$username','$password','business','$profile2')";
				if($conn->query($query) === true){

                    $query = "SELECT id FROM tbl_users WHERE username = '".$username."'";
                    $result = $conn->query($query);
                    $container = $result->fetch_assoc();
                    $id = $container['id'];


                    $query2 = "UPDATE tblbusinessinfo SET firstname = '$fname' , midlename = '$mname'  , lastname = '$lname' , profile = '$profile' , gender = '$gender' , 
                    contact = '$number' , emailadd = '$email', address = '$address' , e_contact = '$e_number' , e_emailadd = '$e_email' , e_relationship = '$relation',
                    b_name = '$b_name' , b_type b_address = '$b_address' ,  b_emailadd = '$b_email ' , b_contact = '$b_number' ,  b_line = '$b_line' ,  b_area = '$b_area' , b_capital = '$b_capital' dti_coa_number = '$b_registration' ,
                    tax_number = '$b_tax' , number_employee = '$b_employee' ,  lessor = '$lessor' , l_address = '$l_address; , monthly_rent = '$l_rental' , l_contact = '$l_number'  
                    WHERE id = '$idd' ";
                    if($conn->query($query2) === true){
                        $_SESSION['message'] = 'business Information has been saved!';
                        $_SESSION['success'] = 'success';
                    }
				}

			}else if(!empty($profile) && empty($profile2)){

				$query = "INSERT INTO tbl_users (`username`,`password`,`user_type`,`avatar`) VALUES ('$username','$password','business','$profile2')";
				if($conn->query($query) === true){

                    $query = "SELECT id FROM tbl_users WHERE username = '".$username."'";
                    $result = $conn->query($query);
                    $container = $result->fetch_assoc();
                    $id = $container['id'];


                    $query2 ="UPDATE tblbusinessinfo SET firstname = '$fname' , midlename = '$mname'  , lastname = '$lname' , profile = '$profile' , gender = '$gender' , 
                    contact = '$number' , emailadd = '$email', address = '$address' , e_contact = '$e_number' , e_emailadd = '$e_email' , e_relationship = '$relation',
                    b_name = '$b_name' , b_type b_address = '$b_address' ,  b_emailadd = '$b_email ' , b_contact = '$b_number' ,  b_line = '$b_line' ,  b_area = '$b_area' , b_capital = '$b_capital' dti_coa_number = '$b_registration' ,
                    tax_number = '$b_tax' , number_employee = '$b_employee' ,  lessor = '$lessor' , l_address = '$l_address; , monthly_rent = '$l_rental' , l_contact = '$l_number'  
                    WHERE id = '$idd' ";
                    if($conn->query($query2) === true){
                        $_SESSION['message'] = 'business Information has been saved!';
                        $_SESSION['success'] = 'success';
                    }
				}

			}else if(empty($profile) && !empty($profile2)){

				$query = "INSERT INTO tbl_users (`username`,`password`,`user_type`,`avatar`) VALUES ('$username','$password','business','$profile2')";
				if($conn->query($query) === true){

                    $query = "SELECT id FROM tbl_users WHERE username = '".$username."'";
                    $result = $conn->query($query);
                    $container = $result->fetch_assoc();
                    $id = $container['id'];


                    $query2 = "UPDATE tblbusinessinfo SET firstname = '$fname' , midlename = '$mname'  , lastname = '$lname' , profile = '$profile' , gender = '$gender' , 
                    contact = '$number' , emailadd = '$email', address = '$address' , e_contact = '$e_number' , e_emailadd = '$e_email' , e_relationship = '$relation',
                    b_name = '$b_name' , b_type b_address = '$b_address' ,  b_emailadd = '$b_email ' , b_contact = '$b_number' ,  b_line = '$b_line' ,  b_area = '$b_area' , b_capital = '$b_capital' dti_coa_number = '$b_registration' ,
                    tax_number = '$b_tax' , number_employee = '$b_employee' ,  lessor = '$lessor' , l_address = '$l_address; , monthly_rent = '$l_rental' , l_contact = '$l_number'  
                    WHERE id = '$idd' ";
                    if($conn->query($query2) === true){
                        $_SESSION['message'] = 'business Information has been saved!';
                        $_SESSION['success'] = 'success';
                    }
				
					if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

						$_SESSION['message'] = 'business Information has been saved!';
						$_SESSION['success'] = 'success';
					}
				// 	if(move_uploaded_file($_FILES['img']['tmp_name'], $target2)){

				// 		$_SESSION['message'] = 'Business Information has been updated!!';
				// 		$_SESSION['success'] = 'success';
				// 	}
				}

			}else{

				$query = "INSERT INTO tbl_users (`username`,`password`,`user_type`,`avatar`) VALUES ('$username','$password','business','person.png')";
				if($conn->query($query) === true){

                    $query = "SELECT id FROM tbl_users WHERE username = '".$username."'";
                    $result = $conn->query($query);
                    $container = $result->fetch_assoc();
                    $id = $container['id'];

                    $query2 ="UPDATE tblbusinessinfo SET firstname = '$fname' , midlename = '$mname'  , lastname = '$lname' , profile = '$profile' , gender = '$gender' , 
                    contact = '$number' , emailadd = '$email', address = '$address' , e_contact = '$e_number' , e_emailadd = '$e_email' , e_relationship = '$relation',
                    b_name = '$b_name' , b_type b_address = '$b_address' ,  b_emailadd = '$b_email ' , b_contact = '$b_number' ,  b_line = '$b_line' ,  b_area = '$b_area' , b_capital = '$b_capital' dti_coa_number = '$b_registration' ,
                    tax_number = '$b_tax' , number_employee = '$b_employee' ,  lessor = '$lessor' , l_address = '$l_address; , monthly_rent = '$l_rental' , l_contact = '$l_number'  
                    WHERE id = '$idd' ";
                    if($conn->query($query2) === true){
                        $_SESSION['message'] = 'business Information has been saved!';
                        $_SESSION['success'] = 'success';
                    }
				}
			}

		}else{

			$_SESSION['message'] = 'Please complete the form!';
			$_SESSION['success'] = 'danger';
		}

	}else{
		$_SESSION['message'] = 'Username already taken!';
		$_SESSION['success'] = 'danger';
	
    }
     header("Location: ../business_info.php");
