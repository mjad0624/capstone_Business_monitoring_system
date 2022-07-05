<?php include 'server/server.php' ?>
<?php include 'model/data.php' ?>
<?php 
	$query = "SELECT * FROM tblbusinessinfo";
    $result = $conn->query($query);

    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
	}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Business Information -  Business Management System</title>
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
								<h2 class="text-white fw-bold">Business Information</h2>
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
										<div class="card-title">Business Information</div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
                                            	<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Business
											</a>

                                            <?php if($_SESSION['role']==='administrator'):?>
                                            <a href="model/export_business_csv.php" class="btn btn-danger btn-border btn-round btn-sm">
												<i class="fa fa-file"></i>
												Export CSV
											</a>
                                            <?php endif ?>
                                            
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
													<th scope="col">Owners Name</th>
                                                    <th scope="col">Gender</th>
													<th scope="col">Contact</th>
                                                    <th scope="col">Email Address</th>
                                                    <th scope="col">Address</th>
													<th scope="col">Emergency Contact</th>
                                                    <th scope="col">Business Name</th>
													<th scope="col">Business Type</th>
                                                    <th scope="col">Tax Number</th>
                                                    <th scope="col">DTI/COA number</th>
													<th scope="col">Number of Employees</th>
                                                    
                                        
                                                    <?php if(isset($_SESSION['username'])):?>
                                                    <?php if($_SESSION['role']=='administrator'):?>
													
                                                    <?php endif ?>
													<th scope="col">Action</th>
                                                    <?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($info)): ?>
												<?php $no=1; foreach($info as $row): ?>
												<tr>
                                                    <td><?= $row['id'] ?></td>
													<td >
                                                    <?php $row['profile']!= "" ? $avatar = $row['profile']:$avatar = "person.png"?>
                                                        <div class="avatar avatar-xs">
                                                            <img src="<?= (file_exists('assets/uploads/business_files/business_logo/'.$avatar) ? 'assets/uploads/business_files/business_logo/'.$avatar : 'assets/uploads/business_files/business_logo/person.png') ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                        </div>
                                                        <?php $name = $row['firstname']."_".$row['midlename']."_".$row['lastname']?> 
                                                        <?= ucwords($name) ?>
                                                    </td>
                                                    <td><?= $row['gender'] ?></td>
                                                    <td><?= $row['contact'] ?></td>
                                                    <td><?= $row['emailadd'] ?></td>
                                                    <td><?= $row['address'] ?></td>
                                                    <td><?= $row['e_contact'] ?></td>
                                                    <td><?= $row['b_name'] ?></td>
                                                    <td><?= $row['b_type'] ?></td>
                                                    <td><?= $row['tax_number'] ?></td>
                                                    <td><?= $row['dti_coa_number'] ?></td>
                                                    <td><?= $row['number_employee'] ?></td>
                                                    
                                                    <?php if(isset($_SESSION['username'])):?>
                                                    <?php if($_SESSION['role']=='administrator'):?>
                                                    <?php endif ?>
                                                    <td>
                                                        <div class="form-button-action">
                                                        <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" onclick="editResident(this)" title="View Business"  
                                                             <?php $iddd = $row['id'] ?> data-fname="<?= $row['firstname'];?>"  data-mname="<?= $row['midlename']; ?>" data-l_rental="<?= $row['monthly_rent']; ?>"
                                                            data-b_name="<?= $row['b_name'] ?>" data-lname="<?= $row['lastname']; ?>" data-gender="<?= $row['gender']; ?>" data-img="<?= $row['profile']; ?>" data-number="<?= $row['contact']; ?> "
                                                            data-email="<?= $row['emailadd']; ?>" data-adress="<?= $row['address']; ?>" data-e_number="<?= $row['e_contact']; ?>" 
                                                            data-e_email="<?= $row['e_emailadd']; ?>" data-b_registration = "<?= $row['dti_coa_number']; ?>" >
                                                        <?php 
                                                       
                                                            if(isset($_SESSION['username'])): 
                                                        ?>  
                                                        <i class="fa fa-edit"></i>
                                                        <?php else: ?>
                                                                        
                                                        <i class="fa fa-eye"></i>
                                                        <?php endif ?>
                                                                </a>    
                                                                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_resident.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this business?');" class="btn btn-link btn-danger" data-original-title="Remove">
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
													<th scope="col">Owners Name</th>
                                                    <th scope="col">Gender</th>
													<th scope="col">Contact</th>
                                                    <th scope="col">Email Address</th>
                                                    <th scope="col">Address</th>
													<th scope="col">Emergency Contact</th>
                                                    <th scope="col">Business Name</th>
													<th scope="col">Business Type</th>
                                                    <th scope="col">Tax Number</th>
                                                    <th scope="col">DTI/COA number</th>
													<th scope="col">Number of Employees</th>
                                                    
                                                
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
			</div>

            
            <!-- Modal add-->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Resident Registration Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/add_business.php" enctype="multipart/form-data">
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
                                        <input type="file" class="form-control" name="img" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                    <h4 style ="font-weight:bold;">Owner's Informations</h4>
                                    </div>
                                    <div class="col">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Middlename</label>
                                                <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Lastname</label>
                                                <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" required>
                                            </div>
                                        </div>  
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" required name="gender">
                                                    <option disabled selected value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
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
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" name="number">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Enter Email" name="email">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type = "text" class="form-control" name="address" required placeholder="Enter Address"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">    
                                                <h4 style = "font-weight:bold;">Emergency Contact Person</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" name="e_number">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Enter Email" name="e_email">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Relationship</label>
                                                <input type = "text" class="form-control" name="relation" required placeholder="Enter Relationship"></input>
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
                                                    <input type="text" class="form-control" placeholder="Enter Business Name" name="b_name">
                                                </div>
                                            </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Type</label>
                                                <select class="form-control" required name="b_type">
                                                    <option disabled selected value="">Business Type</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Partnership">Partnership</option>
                                                    <option value="Cooperative">Cooperative</option>
                                                    <option value="Corporation">Corporation</option>
                                                </select>
                                            </div>
                                        </div>   
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Address</label>
                                                <input type = "text" class="form-control" name="b_address" required placeholder="Enter Business Address"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Enter Email" name="b_email">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" name="b_number">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Line of Business</label>
                                                <input type="text" class="form-control" placeholder="Line of Business" name="b_line">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Area (in sq ft)</label>
                                                <input type="email" class="form-control" placeholder="Business Area" name="b_area">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Capital if New/Gross if Renewal</label>
                                                <input type="text" class="form-control" placeholder="Capital if New/Gross if Renewal" name="b_capital">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>DTI/COA Registration No.</label>
                                                <input type="text" class="form-control" placeholder="DTI/COA Registration No." name="b_registration">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Tax Identification Number</label>
                                                <input type="text" class="form-control" placeholder="Tax Identification Number" name="b_tax">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Number of Employees</label>
                                                <input type="text" class="form-control" placeholder="Number of Employees" name="b_employee">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>If Rented Name of Lessor</label>
                                                <input type="text" class="form-control" placeholder="Name of Lessor" name="lessor">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Address of Lessor</label>
                                                <input type="text" class="form-control" placeholder="Address of Lessor" name="l_address">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Amount of Monthly Rental</label>
                                                <input type="text" class="form-control" placeholder="Monthly Rental" name="l_rental">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" name="l_number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" placeholder="Enter Username" name="username">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" placeholder="Enter Password" name="password">
                                            </div>
                                        </div>
                                    </div>

                                   
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

         <!-- Modal edit-->
<?php if(!empty($info)): ?>
<?php $no=1; foreach($info as $row): ?>
    
           <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Business Registration </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_businessinfo.php" enctype="multipart/form-data">
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
                                        <input type="file" class="form-control" name="img" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                    <h4 style ="font-weight:bold;">Owner's Informations</h4>
                                    </div>
                                    <div class="col">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" class="form-control" placeholder="Enter Firstname" id = "fname" value =" <?php echo $iddd ?>"   required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Middlename</label>
                                                <input type="text" class="form-control" placeholder="Enter Middlename" id = "mname" name="mname" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Lastname</label>
                                                <input type="text" class="form-control" placeholder="Enter Lastname" id = "lname" name="lname" required>
                                            </div>
                                        </div>  
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" required id = "gender" name="gender">
                                                    <option disabled selected value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
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
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" id = "number" name="number">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Enter Email" id = "email" name="email">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Address</label>
                                               
                                                <input type = "text" class="form-control"  required placeholder="Enter Address" id = "address"  name = "address"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">    
                                                <h4 style = "font-weight:bold;">Emergency Contact Person</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" id = "e_number"  name="e_number" value = "<?= $row['e_contact']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Enter Email" id = "e_email" name="e_email" value = "">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Relationship</label>
                                                <input type = "text" class="form-control" id = "relation" name="relation" required placeholder="Enter Relationship"></input>
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
                                                    <input type="text" class="form-control" placeholder="Enter Business Name" id = "b_name" name="b_name" value= "<?= $row['b_name']; ?>">
                                                </div>
                                            </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Type</label>
                                                <select class="form-control" required id = "b_type" name="b_type" value = "<?= $row['b_type']; ?>" >
                                                    
                                                    <option value="Single">Single</option>
                                                    <option value="Partnership">Partnership</option>
                                                    <option value="Cooperative">Cooperative</option>
                                                    <option value="Corporation">Corporation</option>
                                                </select>
                                            </div>
                                        </div>   
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Address</label>
                                                <input type = "text" class="form-control" id = "b_address" name="b_address" value = "<?= $row['address']; ?>" required placeholder="Enter Business Address"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Enter Email" id = "b_email" name="b_email" value = "<?= $row['e_emailadd']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" id = "b_number" name="b_number" value = "<?= $row['b_contact']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Line of Business</label>
                                                <input type="text" class="form-control" placeholder="Line of Business" id = "b_line" name="b_line" value = "<?= $row['b_line']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Area (in sq ft)</label>
                                                <input type="email" class="form-control" placeholder="Business Area" id = "b_area" name="b_area" value = "<?= $row['b_area']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Capital if New/Gross if Renewal</label>
                                                <input type="text" class="form-control" placeholder="Capital if New/Gross if Renewal" id = "b_capital" name="b_capital" value = "<?= $row['b_capital']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>DTI/COA Registration No.</label>
                                                <input type="text" class="form-control" placeholder="DTI/COA Registration No." id = "b_registration" name="b_registration" value = "<?= $row['dti_coa_number']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Tax Identification Number</label>
                                                <input type="text" class="form-control" placeholder="Tax Identification Number" id = "b_tax" name="b_tax" value = "<?= $row['tax_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Number of Employees</label>
                                                <input type="text" class="form-control" placeholder="Number of Employees" id = "b_employee" name="b_employee" value = "<?= $row['number_employee']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>If Rented Name of Lessor</label>
                                                <input type="text" class="form-control" placeholder="Name of Lessor" id = "lessor" name="lessor" value = <?= $row['lessor']; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Address of Lessor</label>
                                                <input type="text" class="form-control" placeholder="Address of Lessor" id = "l_address" name="l_address" value = "<?= $row['l_address']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Amount of Monthly Rental</label>
                                                <input type="text" class="form-control" placeholder="Monthly Rental" id = "l_rental" name="l_rental" value = "<?= $row['monthly_rent']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number"  id = "number"name="l_number" value = "<?= $row['l_contact']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
<?php $no++; endforeach ?>
<?php endif ?>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#residenttable').DataTable();
        });
    </script>
</body>
</html>