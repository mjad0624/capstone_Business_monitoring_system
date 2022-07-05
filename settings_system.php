<?php include 'server/server.php' ?>
<?php include 'model/data.php' ?>
<?php
// print_r($admin[0]['system_color']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Support Management -  Barangay Management System</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
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
								<h2 class="text-white fw-bold">System Settings</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>


                            
                        <div class="modal-body">
                            <form method="POST" action="model/update_settings.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                             <div class="col">

                                <div class="form-group">    
                                    <h3 style = "font-weight:bold;">General</h3>
                                </div>
                                <div>&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div style="width: 370px; height: 250;" class="text-center" id="my_camera">
                                            <img src="assets/uploads/admin_folder/<?= $admin[0]['system_logo']?>"  id = "preview_logo"alt="System Logo" class="img img-fluid" width="250" >
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>System Logo</label>
                                            <input type="file" class="form-control" id = "logo"name="logo" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label>System Name</label>
                                            <input type="text" class="form-control" placeholder="Enter system name" value = "<?= $admin[0]['system_name']?>" name="name" required>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Theme Color</label>
                                                <select class="form-control" required id = "color" name="color" value = "<?= $admin[0]['system_color']?>">
                                                    <option disabled selected value="" >Select system theme</option>
                                                    <option value="0">Blue Theme</option>
                                                    <option value="1">Orange Theme</option>
                                                    <option value="2"> Light Blue Theme</option>
                                                    <option value="3">Pink Theme</option>
                                                    <option value="4">Gray Theme</option>

                                                </select>
                                            </div>
                                        </div>   

                                    </div>
                                </div>
                                <div>&nbsp;</div>
                                <div class="form-group">    
                                    <h3 style = "font-weight:bold;">Payment</h3>
                                </div>       
                                <div>&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div style="width: 370px; height: 250;" class="text-center" id="my_camera">
                                            <img src="assets/uploads/admin_folder/<?= $admin[0]['business_gcash']?>" id = "preview_qr"alt="System Qr" class="img img-fluid" width="250" >
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>QR code</label>
                                            <input type="file" class="form-control" name="qr" id = "qr" value = "<?= $admin[0]['business_gcash']?>"  accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label>Person to contact</label>
                                            <input type="text" class="form-control" placeholder="Enter payment person" name="contact_name" value = "<?= $admin[0]['business_contact_name']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" class="form-control" placeholder="Enter contact number" name="contact_number" value = "<?= $admin[0]['business_contact_no']?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div>&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">    
                                            <h3 style = "font-weight:bold;">Application Fees</h3>
                                        </div>      
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">    
                                            <h3 style = "font-weight:bold;">Email</h3>
                                        </div>      
                                    </div>      
                                </div>

                                <div>&nbsp;</div>
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Single</label>
                                                <input type="text" class="form-control" name="type_single" placeholder = "Enter email the system will use" value = "<?= $admin[0]['type_single_fee']?>" title = "The 'from' name on emails" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Partneship</label>
                                                <input type="text" class="form-control" name="type_partnership" placeholder = "Enter email name" value = "<?= $admin[0]['type_partnership_fee']?>" title = "The 'from' name on emails" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Cooperative</label>
                                                <input type="text" class="form-control" name="type_cooperative" placeholder = "Enter email title" value = "<?= $admin[0]['type_cooperative_fee']?>" title = "Email title on emails" required>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label>Corporation</label>
                                                <input type="text" class="form-control" name="type_corporation" placeholder = "Enter email title" value = "<?= $admin[0]['type_corporation_fee']?>" title = "Email title on emails" required>
                                            </div>
                                        </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                                <label>System email</label>
                                                <input type="email" class="form-control" name="email" placeholder = "Enter email the system will use" value = "<?= $admin[0]['business_email']?>" title = "The 'from' name on emails" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Email Name</label>
                                                <input type="text" class="form-control" name="email_name" placeholder = "Enter email name" value = "<?= $admin[0]['email_title']?>" title = "The 'from' name on emails" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Email Title</label>
                                                <input type="text" class="form-control" name="email_title" placeholder = "Enter email title" value = "<?= $admin[0]['email_name']?>" title = "Email title on emails" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                            </div>            
                        </div>
                    </div>
                </div>
                
			</div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            <form>
            
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
<script>
    

//color change
   $("#color").change(function(e) {
    var color = document.getElementById("color").value;
    var header = document.querySelector(".logo-header")
    header.style = "background: red;";

    console.log(color);
 

});

//logo preview img
$("#logo").change(function(e) {
    // alert("fg");

    var file =  document.querySelector('#logo').files[0];
    
        var reader = new FileReader();
        reader.onloadend = function() {
            document.getElementById("preview_logo").src = reader.result;
        }
        reader.readAsDataURL(file);
        $("input").after(img);
 

});

//qr preview img
$("#qr").change(function(e) {
    // alert("fg");

    var file =  document.querySelector('#qr').files[0];
    
        var reader = new FileReader();
        reader.onloadend = function() {
            document.getElementById("preview_qr").src = reader.result;
        }
        reader.readAsDataURL(file);
        $("input").after(img);
 

});
</script>
</html>