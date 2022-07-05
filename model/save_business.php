<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

	$id 	= $conn->real_escape_string($_POST['business_id']);
	$fname 		= $conn->real_escape_string($_POST['fname']);
	$bdate 		= $conn->real_escape_string($_POST['bdate']);
    $owner 		= $conn->real_escape_string($_POST['owner']);
	$profile 	= $conn->real_escape_string($_POST['profileimg']); // base 64 image
	$profile2 	= $_FILES['img']['name'];
	$docu 	= $_FILES['docu']['name'];

	// change profile2 name
	$newName = date('dmYHis').str_replace(" ", "", $profile2);

	  // image file directory
  	$target = "../assets/uploads/business_logo/".basename($profile2);
	$target2 = "../assets/uploads/Business_logo/".basename($docu);  
	$check = "SELECT business_id FROM tblbusiness WHERE business_id='$id'";
	$nat = $conn->query($check)->num_rows;	

	if($nat == 0){
		if(!empty($fname)){

			if(!empty($profile) && !empty($profile2)){

				$query = "INSERT INTO tblbusiness (`business_id`,`business_logo`,`business_name`,`date_established`,`business_owner`,`business_files`) VALUES ('$id','$profile2','$fname','$bdate','$owner','$docu')";

				if($conn->query($query) === true){

					$_SESSION['message'] = 'business Information has been saved!';
					$_SESSION['success'] = 'success';
				}
			}else if(!empty($profile) && empty($profile2)){

				$query = "INSERT INTO tblbusiness (`business_id`,`business_logo`,`business_name`,`date_established`,`business_owner`,`business_files`) VALUES ('$id','$profile2','$fname','$bdate','$owner','$docu')";
				if($conn->query($query) === true){

					$_SESSION['message'] = 'business Information has been saved!';
					$_SESSION['success'] = 'success';
				}

			}else if(empty($profile) && !empty($profile2)){

				$query = "INSERT INTO tblbusiness (`business_id`,`business_logo`,`business_name`,`date_established`,`business_owner`,`business_files`) VALUES ('$id','$profile2','$fname','$bdate','$owner','$docu')";
				if($conn->query($query) === true){

					$_SESSION['message'] = 'business Information has been saved!';
					$_SESSION['success'] = 'success';

					if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

						$_SESSION['message'] = 'business Information has been saved!';
						$_SESSION['success'] = 'success';
					}
					if(move_uploaded_file($_FILES['img']['tmp_name'], $target2)){

						$_SESSION['message'] = 'Business Information has been updated!!';
						$_SESSION['success'] = 'success';
					}
				}

			}else{
				$query = "INSERT INTO tblbusiness (`business_id`,`business_logo`,`business_name`,`date_established`,`business_owner`,`business_files`) VALUES ('$id','person.png','$fname','$bdate','$owner','$docu')";
				if($conn->query($query) === true){

					$_SESSION['message'] = 'business Information has been saved!';
					$_SESSION['success'] = 'success';
				}
			}

		}else{

			$_SESSION['message'] = 'Please complete the form!';
			$_SESSION['success'] = 'danger';
		}
	}else{
		$_SESSION['message'] = 'National ID is already taken. Please enter a unique national ID!';
		$_SESSION['success'] = 'danger';
	}
     header("Location: ../business.php");

	$conn->close();

