<?php include 'server/server.php' ?>
<?php 
$stats = $_GET['status'];
if(isset($stats)){
    include 'model/data.php';

}else{
    header("location:business_dashboard.php");
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
	<title>Business Transaction Information </title>
</head>
<body>
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
								<h2 class="text-white fw-bold">Business Page</h2>
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

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Business Status Information</div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
                                            	
										</div>
                                        <?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
                                        
										<table id="residenttable" class="display table table-striped">
											<thead>
												<tr>
                                                    <th scope="col">Business ID</th>
													<th scope="col">Username</th>
                                                    <th scope="col">File Status</th>
													<th scope="col">Last Passed</th>
                                                    <th scope="col">Files </th>
                                                    <th scope="col">Unsubmitted Days</th>
                                                    

										
													
													
                                                    <?php if(isset($_SESSION['username'])):?>
                                                        <?php if($_SESSION['role']=='administrator'):?>
													
                                                    <?php endif ?>
													<th scope="col">Action</th>
                                                    <?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($business_status)): ?>
													<?php $no=1; foreach($business_status as $row): ?>
													<tr>
                                                    <td><?= $row['business_id'] ?></td>
														<td>
                                                            <div class="avatar avatar-xs">
                                                            <img src="<?= (file_exists('assets/uploads/business_files/business_logo/'.$row['business_logo']) ? 'assets/uploads/business_files/business_logo/'.$row['business_logo'] : 'assets/uploads/business_files/business_logo/person.png') ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                            </div>
                                                            <?= ucwords($row['business_name']) ?>
                                                        </td>
                                                        <td><?= $row['status'] ?></td>
														<td><?= $row['last_pass'] ?></td>
                                                        <td><?php  $query = "SELECT * FROM tblbusiness where business_id = ".$row["business_id"];
                                                                   $result = $conn->query($query);
                                                                   $total = $result->fetch_assoc();
                                                                   $files = explode(",",$total["business_files"]);
                                                                   $num =  count($files);
                                                                   $num -= 1;
                                                                   
                                                               
                                                                   for($i = 0;$i < $num; $i++){
                                                                       $path = "assets/uploads/business_files/".$total["business_id"].$total["business_name"]."/".$files[$i];
                                                                       echo "</br><a href = '".$path."'>".$files[$i]."</a>";
                                                                   } ?></td>
                                                        <td><?= $row['days_not_clear'] ?></td>
                                                        
                                                        <?php if(isset($_SESSION['username'])):?>
                                                            <?php if($_SESSION['role']=='administrator'):?>
                                                        
                                                        <?php endif ?>
														<td>
															<div class="form-button-action">
                                                            <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Resident" onclick="editResident(this)" 
                                                                data-national="<?= $row['business_id'] ?>" data-fname="<?= $row['business_name'] ?>" data-owner="<?= $row['business_owner'] ?>"
                                                                    data-img="<?= $row['business_logo'] ?>">
                                                                    <?php 
                                                                 
                                                                    if(isset($_SESSION['username'])): ?>
                                                                    <i class="fa fa-edit"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a>    

                                                                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_resident.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this resident?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
                                                                <?php endif ?>
															</div>
														</td>
                                                        <?php endif ?>
														
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
                                                <th scope="col">Business ID</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">File Status</th>
                                                <th scope="col">Last Passed</th>
                                                <th scope="col">Files</th>
                                                <th scope="col">Unsubmitted Days</th>
                                                
                                                    <?php if(isset($_SESSION['username'])):?>
                                                        <?php if($_SESSION['role']=='administrator'):?>
													
                                                    <?php endif ?>
													<th scope="col">Action</th>
                                                    <?php endif ?>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>  
						</div>
					</div>
				</div>
			</div>

            <!-- Modal edit-->
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit/View Resident Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/update_status.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="my_camera1" style="width: 370px; height: 250;" class="text-center">
                                        <img src="<?= (file_exists('assets/uploads/business_files/business_logo/'.$row['business_logo']) ? 'assets/uploads/business_files/business_logo/'.$row['business_logo'] : 'assets/uploads/business_files/business_logo/person.png') ?>"class="img img-fluid" width="250" >
                                    </div>
                                    <?php if(isset($_SESSION['username'])):?>
                                    <div class="form-group d-flex justify-content-center"> 
                                    </div>
                                    <div id="profileImage1">
                                        <input type="hidden" name="profileimg">
                                    </div>
                      
                                    
                         
                                    <?php endif ?>
                                    <div class="form-group">
                                        <div class="selectgroup selectgroup-secondary selectgroup-pills" style = "margin-left:20%">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="status" value="passed" class="selectgroup-input" checked="" id="alive">
                                                <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-walking"></i></span>
                                            </label><p class="mt-1 mr-3"><b>Passed</b></p>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="status" value="rejected" class="selectgroup-input" id="dead">
                                                <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-people-carry"></i></span>
                                            </label><p  class="mt-1 mr-3"><b>Reject</b></p>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                    </div>               
                                </div>
                                <div class="col-md-8">
                                <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                            <label>Business ID.</label>
                                            <input type="text" class="form-control" name="national" id="nat_id">
                                    </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" placeholder="Enter business name" name="fname" id="fname">
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col">
                                        <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea class="form-control" id="remarks" name="remarks" placeholder = "Add remarks here" rows="10" cols="30"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                
                                
                                   
                                   
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="res_id">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">OK</button>
                            <?php endif ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' 
    
    
    ?>
   

    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#residenttable').DataTable();
        });

    </script>

</body>
</html>