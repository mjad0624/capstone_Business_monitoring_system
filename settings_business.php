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
                                <form method="POST" action="model/update_requirements.php" enctype="multipart/form-data">
                                    <input type="hidden" name="size" value="1000000">
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                </div> 
                                                <div class="col-md-6">   
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" required placeholder="Title" id = "email" value = "<?=isset($admin[0]['client_requirement_title'])? $admin[0]['client_requirement_title']:"" ?>" name="title" style = "text-align:center;">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea type = "text" class="form-control" rows = "10" col = "50" required id = "address" name="description" placeholder="Quick Description"><?= isset($admin[0]['client_requirement'])? $admin[0]['client_requirement']:"" ?></textarea>
                                                    </div>
                                                <div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <a href = "<?="assets/uploads/admin_folder/".$admin[0]['client_requirement_file']?>">Current Document:</a>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label style = "float:right; font-size:large;">Insert Document here:</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <input type="file" id = "pic" name = "file"  class="form-control" accept = "pdf/*">
                                                    </div>
                                                </div>
                                        
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" style = "float:right;">
                                                        <button type="submit" class="btn btn-primary" >Save Changes</button>
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
			</div>
        </div>
    </div>   
            
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		
		
	
	<?php include 'templates/footer.php' ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
<script>
    

//color change
   $("#color").change(function(e) {
    var color = document.getElementById("color").value;
    var header = document.querySelector(".logo-header")
    header.style = "background:color = color";

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