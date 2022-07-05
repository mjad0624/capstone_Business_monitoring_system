<?php include 'server/server.php' ?>
<?php include 'model/data.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include 'templates/header.php' ?>
    <title>Resident Information -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Businesss Application Requirements</h2>
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
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                </div> 
                                                <div class="col-md-6">   
                                                    <div class="form-group">
                                                        <b><label class="form-control" style = "text-align:center;"><?=isset($admin[0]['client_requirement_title'])? $admin[0]['client_requirement_title']:"" ?></label></b></br>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <p style="max-width:100%; color: #353535; text-allign:center;" ><?= isset($admin[0]['client_requirement'])? $admin[0]['client_requirement']:"" ?></p>
                                                    </div>
                                                <div>
                                            </div> 
                                            <div class="row">
                                                
                                                <div class="col-md-10" style = "float: right;">
                                                    <div class="form-group">
                                                        <label style = "float:right; font-size:large;">For more information please see the document:</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                   <a href = "<?="assets/uploads/admin_folder/".$admin[0]['client_requirement_file']?>" style = "float: right;" >Document here:</a>
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
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#residenttable').DataTable();
        });
    </script>
</body>
</html>