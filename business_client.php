<?php include 'server/server.php' ?>
<?php include 'model/monitor_business.php' ?>
<?php include 'model/data.php' ?>

<?php 
error_reporting(0); 
?>
<?php
$image =  ($indivusers['avatar']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Resident Information - Barangay Management System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<!-- <?php include 'templates/loading_screen.php' ?> -->
	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
        <div class="content">
				<div class="panel-header ">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold"><?php echo ($_SESSION['username']);?></h2>
                                <div id="alert-message"></div>
                                
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">
                            
                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='message' ? 'bg-message' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                                <?php if (isset($container['status_message'])):?>
                                    <div class="alert alert-message" role="alert">
                                        <?php echo $container['status_message']; ?>
                                    </div>
                                <?php endif ?>
                            <?php endif ?>
                            
                            <div class="modal-body">
                            <form action="model/business_files.php" method = "post" enctype = "multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div style="width: 370px; height: 250;" class="text-center" id="my_camera">
                                            <img src="<?= (file_exists('assets/uploads/business_files/business_logo/'.$image) ? 'assets/uploads/business_files/business_logo/'.$image : 'assets/uploads/business_files/business_logo/person.png') ?>" alt="Resident Profile" class="img img-fluid" width="250">
                                        </div>
                                        <!-- <div class="form-group d-flex justify-content-center">
                                            <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                                            <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                                        </div> -->
                                        <div id="profileImage">
                                            <input type="hidden" name="profileimg">
                                        </div><br>
                                    <div class="form-group">
                                        <!-- <label>Select Photo</label>
                                        <input type="file" class="form-control" name="img" accept="image/*">
                                        <label>Documents</label> -->
                                    

                                    <!-- SUBMIT BUTTON CONDITIONS/RESTRICTIONS     -->
                                    <?php if(isset($container['status'])){
                                        if($container['status'] == 'passed' & $container['payment'] != 'paid'  ){ ?>
                                            <a class="btn btn-danger btn-sm" style = "width: 100%;" type="button" href="#payment" data-toggle="modal" title="Payment" style = "color:white;">Pay Here</a>  
                                            <p></p>
                                        <?php }else if($container['status'] != 'passed' & $container['payment'] != 'paid'  ){ ?>
                                            <a type="button" class="btn btn-danger btn-sm " style = "width: 100%;" href="#submit" data-toggle="modal" title="View Business" style = "color:white;">Submit Files</a>
                                        <?php }else if($container['status'] == 'passed' & $container['payment'] == 'paid' & $container['status_message'] == 'You can now renew your papers.' ){?>
                                            <a type="button" class="btn btn-danger btn-sm " style = "width: 100%;" href="#submit" data-toggle="modal" title="View Business" style = "color:white;">Renew Here.</a>
                                    <?php }}else{?> 
                                        <a type="button" class="btn btn-danger btn-sm " style = "width: 100%;" href="#submit" data-toggle="modal" title="View Business" style = "color:white;">Submit Files</a>   
                                    <?php }?> 
                                </div>
                                
                                    
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business ID.</label>
                                                <Label class="form-control"><?php echo ($_SESSION['id']);?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Name</label>
                                                <Label class="form-control"><?php echo ($_SESSION['username']);?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Status</label>
                                                <Label class="form-control"><?php echo (isset($container['status'])?$container['status']:"missing");?></label>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Payment Status</label>
                                                <Label class="form-control"><?php echo (isset($container['payment'])?$container['payment']:"missing");?></label>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </form>                       
                        </div>
                       
                    </div>
                </div>
            </div>

<!-- //modal submit -->
            <div class="modal fade" id="submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Resident Registration Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/business_files.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                                <div class="col-md-4">
                                    <div style="width: 370px; height: 250;" class="text-center" id="my_camera">
                                        <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                                        <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                                    </div>
                                    <div id="profileImage">
                                        <input type="hidden" name="profileimg">
                                    </div>
                                    <div class="form-group">
                                    <label>Update Profile image</label>
                                        <input type="file" class="form-control" name="img" accept="image/*" >
                                    </div>
                                    <div class="form-group">
                                    <label>Submit Files Here</label>
                                    <input type="file" class="form-control" name="docu[]" accept="image/*, .pdf" multiple required>
                                    </div>
                                    <div class="form-group">
                                    <h4 style ="font-weight:bold;">Owner's Informations</h4>
                                    </div>
                                    <div class="col">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" class="form-control" placeholder="Enter Firstname"  name="fname" value = "<?= isset($indivclientinfo['firstname'])?$indivclientinfo['firstname']:"" ?>" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Middlename</label>
                                                <input type="text" class="form-control" placeholder="Enter Middlename" id = "mname" name="mname" value = "<?= isset($indivclientinfo['midlename'])?$indivclientinfo['midlename']:"" ?>" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Lastname</label>
                                                <input type="text" class="form-control" placeholder="Enter Lastname" id = "lname" name="lname" value = " <?= isset($indivclientinfo['lastname'])?$indivclientinfo['lastname']:"" ?>" required>
                                            </div>
                                        </div>  
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" required id = "gender" name="gender" >
                                                    <option disabled selected value="" >Select Gender</option>
                                                    <option value="Male"<?= $indivclientinfo['gender']=="Male"?"selected":""?>>Male</option>
                                                    <option value="Female"<?= $indivclientinfo['gender']=="Female"?"selected":""?>>Female</option>
                                                </select>
                                            </div>
                                        </div>   
                                       
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                      
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" required placeholder="Enter Contact Number" value = "<?= isset($indivclientinfo['contact'])?$indivclientinfo['contact']:"" ?>" id = "number" name="number">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" required placeholder="Enter Email" id = "email" value = "<?= isset($indivclientinfo['emailadd'])?$indivclientinfo['emailadd']:"" ?>" name="email">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type = "text" class="form-control" required id = "address" name="address" value = "<?= isset($indivclientinfo['address'])?$indivclientinfo['address']:"" ?>" placeholder="Enter Address"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">    
                                                <h4>Emergency Contact Person</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" required placeholder="Enter Contact Number"value = "<?= isset($indivclientinfo['e_contact'])?$indivclientinfo['e_contact']:"" ?>" id = "e_number" name="e_number">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" required placeholder="Enter Email" id = "e_email" name="e_email" value = "<?= isset($indivclientinfo['e_emailadd'])?$indivclientinfo['e_emailadd']:"" ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Relationship</label>
                                                <input type = "text" class="form-control" required id = "relation" name="relation" required placeholder="Enter Relationship" value = "<?= isset($indivclientinfo['e_relationship'])?$indivclientinfo['e_relationship']:"" ?>"></input>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">    
                                                <h3 style = "font-weight:bold;">Business Informations</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                    <label>Business Name</label>
                                                    <input type="text" class="form-control" required placeholder="Enter Business Name" id = "bname" name="b_name" value = "<?= isset($indivclientinfo['b_name'])?$indivclientinfo['b_name']:"" ?>">
                                                </div>
                                            </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Type</label>
                                                <select class="form-control" required id = "b_type" name="b_type">
                                                    <option disabled selected value="">Business Type</option>
                                                    <option value="Single" <?= $indivclientinfo['b_type']=="Single"?"selected":""?>>Single</option>
                                                    <option value="Partnership" <?= $indivclientinfo['b_type']=="Partnership"?"selected":""?>>Partnership</option>
                                                    <option value="Cooperative" <?= $indivclientinfo['b_type']=="Cooperative"?"selected":""?>>Cooperative</option>
                                                    <option value="Corporation" <?= $indivclientinfo['b_type']=="Corporation"?"selected":""?>>Corporation</option>
                                                </select>
                                            </div>
                                        </div>   
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Address</label>
                                                <input type = "text" class="form-control" required id = "b_address" name="b_address" required placeholder="Enter Business Address" value = "<?= isset($indivclientinfo['b_address'])?$indivclientinfo['b_address']:"" ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" required placeholder="Enter Email" id = "b_email" name="b_email" value = "<?= isset($indivclientinfo['b_emailadd'])?$indivclientinfo['b_emailadd']:"" ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" required placeholder="Enter Contact Number" id = "b_number" name="b_number" value = "<?= isset($indivclientinfo['b_contact'])?$indivclientinfo['b_contact']:"" ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Line of Business</label>
                                                <input type="text" class="form-control" required placeholder="Line of Business" id = "b_line" name="b_line" value = "<?= isset($indivclientinfo['b_line'])?$indivclientinfo['b_line']:"" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Area (in sq ft)</label>
                                                <input type="email" class="form-control" required placeholder="Business Area" id = "b_area" name="b_area" value = "<?= isset($indivclientinfo['b_area'])?$indivclientinfo['b_area']:"" ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Capital if New/Gross if Renewal</label>
                                                <input type="text" class="form-control" placeholder="Capital if New/Gross if Renewal" id = "b_capital" name="b_capital" value = "<?= isset($indivclientinfo['b_capital'])?$indivclientinfo['b_capital']:"" ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>DTI/COA Registration No.</label>
                                                <input type="text" class="form-control" required placeholder="DTI/COA Registration No."  value = "<?= isset($indivclientinfo['dti_coa_number'])?$indivclientinfo['dti_coa_number']:"" ?>" id = "b_registration" name="b_registration">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Tax Identification Number</label>
                                                <input type="text" class="form-control" placeholder="Tax Identification Number"  value = "<?= isset($indivclientinfo['tax_number'])?$indivclientinfo['tax_number']:"" ?>" id = "b_tax" name="b_tax">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Number of Employees</label>
                                                <input type="text" class="form-control" required placeholder="Number of Employees"  value = "<?= isset($indivclientinfo['number_employee'])?$indivclientinfo['number_employee']:"" ?>" id = "b_employee" name="b_employee">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>If Rented Name of Lessor</label>
                                                <input type="text" class="form-control" required placeholder="Name of Lessor"  value = "<?= isset($indivclientinfo['lessor'])?$indivclientinfo['lessor']:"" ?>" id = "lessor" name="lessor">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Address of Lessor</label>
                                                <input type="text" class="form-control" required placeholder="Address of Lessor"  value = "<?= isset($indivclientinfo['l_address'])?$indivclientinfo['l_address']:"" ?>" id = "l_address" name="l_address">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Amount of Monthly Rental</label>
                                                <input type="text" class="form-control" required placeholder="Monthly Rental"  value = "<?= isset($indivclientinfo['monthly_rent'])?$indivclientinfo['monthly_rent']:"" ?>" id = "l_rental" name="l_rental">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" required placeholder="Enter Contact Number"  value = "<?= isset($indivclientinfo['l_contact'])?$indivclientinfo['l_contact']:"" ?>" id = "number"name="l_number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Type of Application</label>
                                                <select class="form-control" required id = "a_type" name="a_type" >
                                                    <option disabled selected value="">Type of Application</option>
                                                    <option value="new">New</option>
                                                    <option value="renew">Renewal</option>
                                                    <option value="closed">Closure</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal payment -->
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form method="POST" action="model/payment.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="my_camera1" style="width: 370px; height: 250;" class="text-center">
                                        <img src="<?= (file_exists('assets/uploads/admin_folder/'.$admin[0]['business_gcash']) ? 'assets/uploads/admin_folder/'.$admin[0]['business_gcash'] : 'assets/uploads/business_files/business_logo/person.png') ?>"class="img img-fluid" width="250" >
                                    </div>
                                    <?php if(isset($_SESSION['username'])):?>
                                   
                                    <?php endif ?>
                                    <div class="form-group" style = "text-align: center;">
                                        <!-- <div class="selectgroup "> -->
                                            <label class="selectgroup-item">
                                            or Contact : &nbsp;&nbsp;
                                            </label><b><?=strtoupper($admin[0]['business_contact_name'])?></b></br>
                                            <label class="selectgroup-item">
                                            No : &nbsp;&nbsp;
                                            </label><b><?=strtoupper($admin[0]['business_contact_no'])?></b>
                                        <!-- </div> -->
                                        <img id = "img-preview" src = "assets/uploads/admin_folder/no-preview.jpg" style = "height:350px; width:250px;">
                                    </div>

                                    
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                            <label>Business ID.</label>
                                            <input type="text" class="form-control" name="national" value = "<?=$_SESSION['id'] ?>"id="nat_id">
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" placeholder="Enter business name" value = "<?=$_SESSION['username'] ?>" name="username" >
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col">
                                        <div class="form-group">
                                                    <label>Unpaid Balance</label>
                                                    <input type="text" class="form-control" placeholder="Enter business name" value = "<?=$container['balance'] ?>" name="balance">
                                            </div>
                                        </div>
                                    </div>

                                    <div class = "row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label><b>Insert receipt here</b></label>
                                                <input type="file" id = "pic" name = "receipt"  class="form-control" accept = "image/*">
                                            </div>
                                        </div>
                                    </div>

                                      
                                    

  
                                  

                                    

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                    <label></label>
                                                    <p><b>Note:  </b>Include the username and business ID of the business on the in-app message when sending the payment .</p>
                                                    <b><p>Processing takes up to three working days and businesses will be notify through email after the papers is process .</p></b>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="modal-footer">
                                            <input type="hidden" name="id" id="res_id">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
        echo "<h2>&nbsp;&nbsp;&nbsp;Submitted files</h2></br>";
        $query = "SELECT * FROM tblbusiness where business_id = ".$_SESSION['id'];
        $result = $conn->query($query);
        $total = $result->fetch_assoc();
        
        if(isset($total["business_files"])){
        $files = explode(",",$total["business_files"]);
        $num =  count($files);
        $num -= 1;

      
        for($i = 0;$i < $num; $i++){
            $path = "assets/uploads/business_files/".$total["business_id"].$total["business_name"]."/".$files[$i];
            echo "</br>&nbsp;&nbsp;&nbsp;<a href = '".$path."'> ".$files[$i]."</a>";
        }
    }
   ?>
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <script>
   
//image preview 
   $("#pic").change(function(e) {
    // alert("fg");

    var file =  document.querySelector('#pic').files[0];
    
        var reader = new FileReader();
        reader.onloadend = function() {
            document.getElementById("img-preview").src = reader.result;
        }
        reader.readAsDataURL(file);
        $("input").after(img);
 

});
       


    </script>
    <?php include 'templates/footer.php' ?>
</body>
</html>