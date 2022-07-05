<?php include 'server/server.php' ?>
<?php include 'model/data.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
    

	<title>Business Transaction Information </title>
</head>

<body>
<?php include 'templates/loading_screen.php' ?>
<?php
// print_r($lastrevenue[3][0]['data']);

// echo date("Y",strtotime("-1 year"));
?>
<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

    <div class="main-panel">
            
		<div class="content">
				<div class="panel-header">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Business Page</h2>
							</div>
						</div>
					</div>
				</div>
                <div class="page-inner mt--2">
                <div class="row">

                <div class="col-md-4">
							<div class="card card-stats card-secondary card-round" >
								<div class="card-body" style = "background: #fafafa;">
									<div class="row">
                                        <div class="col-12">
											<div style = "height:90%; width:90%;">
                                            <canvas id="myChartb_type" style = "height:100%; width:100%;" ></canvas>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>

                        <div class="col-md-4">
                                <div class="card card-stats card-secondary card-round" >
                                    <div class="card-body" style = "background: #fafafa;">
                                        <div class="row">
                                            <div class="col-12">
                                                <div style = "height:90%; width:90%;">
                                                <canvas id="myChartrenew" style = "height:100%; width:100%;" ></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
							    </div>
                            </div>  

                        <div class="col-md-4">
                                <div class="card card-stats card-secondary card-round" >
                                    <div class="card-body" style = "background: #fafafa;">
                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                <h1 class="text-dark" id = "total_business_data"><?= $totalbusiness[0][0]['data'] ?> </h1>
                                                <p class="text-dark" id = "total_business_label">Total running business </p>
                                                <p class=" text-dark" style = "float:right;"><?= date('Y/m/d')?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
	    					</div>
                        

                            <div class="col-md-4">
                                <div class="card card-stats card-secondary card-round"  >
                                    <div class="card-body" style = "background: #fafafa;">
                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <h1 class="text-dark" id = "present_data">&#8369; <?=isset($totalrevenue[0][0]['data'])?$totalrevenue[0][0]['data']:0; ?></h1>
                                                    <p class="text-dark" id = "present_text">Total Revenue this  <?= date("Y"); ?> </p>
                                                    </br>
                                                    <h1 class="text-dark" id = "last_data"><?=number_format($percent_diff,2) ?>%</h1>
                                                    <p class="text-dark" id = "last_text"><?= $percent_diff<0 ?"Lower":"Greater" ?> than last year's &#8369; <?=$totalrevenue[0][1]['data']; ?></p>
                                                  
                                                </div>
                                            </div>
                                            <div class="col-1">
                                            </div>
                                            <div class="col-7">
                                            
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
	    					</div>

                            <div class="col-md-4">
							<div class="card card-stats card-warning card-round">
								<div class="card-body "style = "background: #fafafa;" >
									<div class="row-md-4">
                                        <div style = "height:100%; width:100%;">
                                            <canvas id="newbusiness"  ></canvas>
                                        </div>
                                    </div>
                                <a href="new_business.php?status=new" class="card-link text-dark" style = "font-size: 80%;">View New Businesses</a>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-stats card-warning card-round">
								<div class="card-body" style = "background: #fafafa;" >
									<div class="row-md-4">
                                        <div style = "height:100%; width:100%;">
                                                <canvas id="closebusiness"></canvas>
                                        </div>
									</div>
                                   <a href="closed_business.php?status=closed" class="card-link text-dark" style = "font-size: 80%;">View Closed busineses</a>
                                </div>        
							</div>
                        </div>
                      
                            <div class="col-md-4">
							<div class="card card-stats card-secondary card-round" >
								<div class="card-body" style = "background: #fafafa;">
                                           
                                    <div class="col-11">
                                                <div style = "height:100%; width:100%;">
                                                <canvas id="myChartrevenue"></canvas>
                                                </div>
                                            </div> 
                                    </div>
							
							</div>
						</div>

						
                        
                        	<div class="col-md-4">
							<div class="card card-stats card-primary card-round">
								<div class="card-body" style = "background: #fafafa;">
									<div class="row">
										<div class="col-12">
											<div>
                                            <canvas id="myChart" style = "height:100%; width:100%;" ></canvas>
											</div>
										</div>     
									</div>
								</div>
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-secondary card-round" >
								<div class="card-body" style = "background: #fafafa;">
									<div class="row">
                                        <div class="col-12">
											<div>
                                            <canvas id="myChart2" style = "height:100%; width:100%;" ></canvas>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>


                <!-- pie chart -->
                <!-- <div id="pie-wrapper">
                    <div class="#" style = "height:35%; width:35%;">
                    <canvas id ="mychart"></canvas>  
                    </div>
                    <div class="#" style = "height:35%; width:35%;">
                        <label class = "form-control" id = "pass"></label>
                        <label class = "form-control" id = "uncheck"></label>
                        <label class = "form-control" id = "missing"></label>  
                    </div>
                </div> -->
                <!-- pie chart -->

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
                                                <h4>Emergency Contact Person</h4>
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
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <input type="text" class="form-control" placeholder="Enter Firstname" id = "fname" name="fname" required>
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
                                                <input type = "text" class="form-control" id = "aaaaddress" name="address" required placeholder="Enter Address"></input>
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
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" id = "e_number" name="e_number">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Enter Email" id = "e_email" name="e_email">
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
                                                    <input type="text" class="form-control" placeholder="Enter Business Name" id = "bname" name="b_name">
                                                </div>
                                            </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Type</label>
                                                <select class="form-control" required id = "b_type" name="b_type">
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
                                                <input type = "text" class="form-control" id = "b_address" name="b_address" required placeholder="Enter Business Address"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Enter Email" id = "b_email" name="b_email">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" id = "b_number" name="b_number">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Line of Business</label>
                                                <input type="text" class="form-control" placeholder="Line of Business" id = "b_line" name="b_line">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Business Area (in sq ft)</label>
                                                <input type="email" class="form-control" placeholder="Business Area" id = "b_area" name="b_area">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Capital if New/Gross if Renewal</label>
                                                <input type="text" class="form-control" placeholder="Capital if New/Gross if Renewal" id = "b_capital" name="b_capital">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>DTI/COA Registration No.</label>
                                                <input type="text" class="form-control" placeholder="DTI/COA Registration No." id = "b_registration" name="b_registration">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Tax Identification Number</label>
                                                <input type="text" class="form-control" placeholder="Tax Identification Number" id = "b_tax" name="b_tax">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Number of Employees</label>
                                                <input type="text" class="form-control" placeholder="Number of Employees" id = "b_employee" name="b_employee">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>If Rented Name of Lessor</label>
                                                <input type="text" class="form-control" placeholder="Name of Lessor" id = "lessor" name="lessor">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Address of Lessor</label>
                                                <input type="text" class="form-control" placeholder="Address of Lessor" id = "l_address" name="l_address">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Amount of Monthly Rental</label>
                                                <input type="text" class="form-control" placeholder="Monthly Rental" id = "l_rental" name="l_rental">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number"  id = "number"name="l_number">
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

            
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>		
	

 <!-- pie charts.-->
 
	<?php include 'templates/footer.php' ?>
 


    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    
    

        $(document).ready(function() {
            $('#residenttable').DataTable();
        });



//chart datas
    
        //get data and make them array
    function extract_data(container, datacontainer, labelcontainer){
        
        let length = container.length;
        for(var ctr = 0; ctr<length; ctr++){
            let length2 = container[ctr].length
            let data = [];
            let label = [];
            for(var ctr2 = 0; ctr2<length2; ctr2++){

                data.push(container[ctr][ctr2]['data'])
                label.push(container[ctr][ctr2]['label'])    
            }   
            datacontainer.push(data);
            labelcontainer.push(label);
        }
    }
    //get percentage diff
    function percent_diff(current,last) {

        if(last!==0){
        percent_diff = ((current-last)/last)*100;

        return percent_diff;
        }else{
            let int  = 0;
            return int;
        }
    }


    //dictionary
    let b_type_value = {all: "0" , cooperative: "1" , single: "2" , partnership: "3" , corporation: "4"}
    // console.log(b_type_value);
    

    const newcontainer = <?php echo json_encode($newbusiness); ?>;
    const closecontainer = <?php echo json_encode($closebusiness); ?>;
    const statuscontainer = <?php echo json_encode($status); ?>;
    const b_typecontainer = <?php echo json_encode($type); ?>;
    const revenuecontainer = <?php echo json_encode($revenue); ?>;
    const renewcontainer = <?php echo json_encode($renew); ?>;
    const xnewbus = [];
    const ynewbus = [];
    const xclosebus = [];
    const yclosebus = [];
    const statusdata = [];
    const statuslabels = [];
    const renewdata = [];
    const renewlabels = [];
    const b_typedata = [];
    const b_typelabels = [];
    const revenuedata = [];
    const revenuelabels = [];
    const unpaid = "<?php echo ($unpaid['unpaid']); ?>";
    const paid = "<?php echo ($paid['paid']); ?>";
    statuscontainer.forEach(b=> statuslabels.push(b['status']));
    statuscontainer.forEach(b=> statusdata.push(b['total']));
    b_typecontainer.forEach(b=> b_typedata.push(b['total']));
    b_typecontainer.forEach(b=> b_typelabels.push(b['type']));
    extract_data(newcontainer,ynewbus,xnewbus);
    extract_data(closecontainer,yclosebus,xclosebus);
    extract_data(renewcontainer,renewdata,renewlabels);         

    revenuecontainer.forEach(a => revenuedata.push(a['revenue']));
    revenuecontainer.forEach(a => revenuelabels.push(a['b_type']))
    const totalnew = "<?php echo $totalnewbusiness['total'];?>";
    const totalclose = "<?php echo $totalclose['totalclose'];?>";
    
    document.querySelector("#add").addEventListener("click",function(){
        statusdata.push(2);
    })
    
    //console.log(ynewbus);
    //console.log(xnewbus);
// status chart    
const data = {
  labels: statuslabels,
  datasets: [{
    data: statusdata,   
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
    ],
    hoverOffset: 5,
    options: {
        click: function(){
            alert("jfnjdnfjn");
        }
    }
    

  }]
};


const config = {
  type: 'bar',
  data: data,
  options: {
      
    plugins: {
        title: {
            display: true,
            text: "Business Files"
        },
        legend: {
        display: false
        }
    }
}
};


let myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
//status chart end.

//newbusiness line graph
const datanewbusiness = {
  labels:  xnewbus[0],
  datasets: [{
    label: 'Currently '+totalnew+' Total new business(es) this year.',
    data: ynewbus[0],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
    ],
    hoverOffset: 5

  }]
};

const config2 = {
  type: 'line',
  data: datanewbusiness,
  options: {
      
      plugins: {
          title: {
              display: true,
              text: 'Currently '+totalnew+' Total new business(es) this year.'
          },
          legend: {
          display: false
          }
      }
  }
  
};

let newbusinesschart = new Chart(
    document.getElementById('newbusiness'),
    config2
  );
//newbusiness line graph end

// business balance chart
const databalance = {
  labels: [
    "Fully Paid", "Has remaining balance"   
  ],
  datasets: [{
    label: 'Requested Barangay Papers',
    data: [paid, unpaid],
    backgroundColor: [
        'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
    ],
    hoverOffset: 5

  }]
};

const config3 = {
  type: 'bar',
  data: databalance,
  options: {
      
      plugins: {
          title: {
              display: true,
              text: "Business Balance"
          },
          legend: {
          display: false
          }
      }
  }
};

  let myChart2 = new Chart(
    document.getElementById('myChart2'),
    config3
  );
//business balance chart end 

//closed business chart

const dataclosebusiness = {
  labels:  xclosebus[0],
  datasets: [{
    label: 'Currently '+totalclose+' Total closed business(es) this year.',
    data: yclosebus[0],
    backgroundColor: [
        'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
    ],
    hoverOffset: 5

  }]
};

const config4 = {
  type: 'line',
  data: dataclosebusiness,
  options: {
      
      plugins: {
          title: {
              display: true,
              text: 'Currently '+totalclose+' Total business(es) closed  this year.'
          },
          legend: {
          display: false
          }
      }
  }
};

  let closebusinesschart = new Chart(
    document.getElementById('closebusiness'),
    config4
  );

//closed business chart  end
//business type chart

const databusinesstype = {
  labels: b_typelabels,
  datasets: [{
    data: b_typedata,
    backgroundColor: [
        'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
    ],
    hoverOffset: 5

  }]
};

const configb_type = {
  type: 'bar',
  data: databusinesstype,
  options: {
    indexAxis: 'y',
    plugins: {
          title: {
              display: true,
              text: 'Business Types.'
          },
          legend: {
          display: false
          }
      },
    elements: {
      bar: {
        borderWidth: 2,
      }
    },
    
    }

};

  let myChartb_type = new Chart(
    document.getElementById('myChartb_type'),
    configb_type
  );
//business type chart end

//revenue chart

const datarevenue = {
  labels: revenuelabels,   
  datasets: [{
    label: revenuelabels,
    data: revenuedata,
    backgroundColor: [
        'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
    ],
    hoverOffset: 5

  },]
};

const configrevenue = {
  type: 'pie',
  data: datarevenue,
  options:{
    plugins: {
          title: {
              display: true,
              text: 'Revenue distribution this year.'
          },
          legend: {
            position:'right'
          }
        }
  }
};

  let myChartrevenue = new Chart(
    document.getElementById('myChartrevenue'),
    configrevenue
  );
// revenue chart end


//renew/unrenew business chart
const datarenew = {
  labels: renewlabels[0],
  datasets: [{
    data: renewdata[0],   
    backgroundColor: [
        'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
    ],
    hoverOffset: 5,
    
    

  }]
};


const configrenew = {
  type: 'bar',
  data: datarenew,
  options: {
      
    plugins: {
        title: {
            display: true,
            text: "Renewed/Unrenewed Business"
        },
        legend: {
        display: false
        }
    }
}
};


let myChartrenew = new Chart(
    document.getElementById('myChartrenew'),
    configrenew 
  );



  console.log(configrenew.options.plugins.title.text)

//status chart event click 
  document.querySelector('#myChart').addEventListener("click", function(event){
    const points = myChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);
        const firstPoint = points[0];
        var label = myChart.data.labels[firstPoint.index];
        var value = myChart.data.datasets[firstPoint.datasetIndex].data[firstPoint.index];

       if(label == "pending"){
        window.location.href = "business_files.php?status=pending"; 
       }else if(label == "missing"){
        window.location.href = "business_files.php?status=missing"; 
       }else if(label ==  "passed"){
        window.location.href = "business_files.php?status=passed"; 
       }else if(label ==  "rejected"){
        window.location.href = "business_files.php?status=rejected"; 
       } 
       
        
  })
  document.querySelector('#myChartrevenue').addEventListener("click", function(event){
    const points = myChartrevenue.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);
        const firstPoint = points[0];
        var label = myChartrevenue.data.labels[firstPoint.index];
        var value = myChartrevenue.data.datasets[firstPoint.datasetIndex].data[firstPoint.index];

       if(label == "Cooperative"){
        window.location.href = "revenue.php";
       }else if(label == "Single"){
        window.location.href = "revenue.php";
       }else if(label == "Partnership"){
        window.location.href = "revenue.php";
       }else if(label == "Corporation"){
        window.location.href = "revenue.php";
       }
        
  })


//balance chart event click 
document.querySelector('#myChart2').addEventListener("click", function(event){
    const points = myChart2.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);
        const firstPoint = points[0];
        var label = myChart2.data.labels[firstPoint.index];
        var value = myChart2.data.datasets[firstPoint.datasetIndex].data[firstPoint.index];

       if(label == "Fully Paid"){
        window.location.href = "business_balance.php?balance=paid"; 
       }else if(label == "Has remaining balance"){
        window.location.href = "business_balance.php?balance=unpaid"; 
       }else if(label == "Pending"){
        window.location.href = "business_balance.php?balance=unpaid"; 
       }
        
  })

const revenue_card = document.getElementById("revenue-card");
//business type click event

var last_text= document.getElementById("last_text");
var last_data= document.getElementById("last_data");
var present_data= document.getElementById("present_data");
var present_text= document.getElementById("present_text");
const date = new Date();

document.querySelector('#myChartb_type').addEventListener("click", function(event){
    const points = myChartb_type.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);
        const firstPoint = points[0];
        var label = myChartb_type.data.labels[firstPoint.index];
        var value = myChartb_type.data.datasets[firstPoint.datasetIndex].data[firstPoint.index];

       if(label == "Cooperative"){
        config2.options.plugins.title.text = "Total new Cooperative Business(es) this year";
        newbusinesschart.data.datasets[0].data = ynewbus[1];
        newbusinesschart.data.labels = xnewbus[1]; 
        newbusinesschart.update();

        config4.options.plugins.title.text = "Total closed Cooperative Business(es) this year";
        closebusinesschart.data.datasets[0].data = yclosebus[1];
        closebusinesschart.data.labels = xclosebus[1]; 
        closebusinesschart.update();

        configrenew.options.plugins.title.text = "Renewed/Unrenewed Cooperative Business(es)";
        myChartrenew.data.datasets[0].data = renewdata[1];
        myChartrenew.data.labels = renewlabels[1]; 
        myChartrenew.update();

        document.getElementById("total_business_data").innerHTML = '<?=$totalbusiness[1][0]['data'] ?>'; 
        document.getElementById("total_business_label").innerHTML = 'Total running <?= $totalbusiness[1][0]['label'] ?> busineses'; 
        //

        let last = <?=isset($totalrevenue[0][1]['data'])?$totalrevenue[0][1]['data']:0; ?>;
        let current = <?=isset($lastrevenue[1][0]['data'])?$lastrevenue[1][0]['data']:0; ?>;
        //console.log(current);
        var percent = percent_diff(last,current)

        present_data.innerHTML = '<?=isset($totalrevenue[1][0]['data'])?$totalrevenue[1][0]['data']:0; ?>';
        present_text.innerHTML = '<?=$totalrevenue[1][0]['label'] ?>'+' business revenues this ' + date.getFullYear();;
        last_data.innerHTML = percent+"%";
        last_text.innerHTML = percent_diff<0 ?"Lower than last years $"+ "<?=isset($lastrevenue[1][0]['data'])?$lastrevenue[1][0]['data']:0; ?>" : "Greater than last years $" + "<?=isset($lastrevenue[1][0]['data'])?$lastrevenue[1][0]['data']:0; ?>" 
        

       }else if(label == "Partnership"){

        config2.options.plugins.title.text = "Total new Partnership Business(es) this year";
        newbusinesschart.data.datasets[0].data = ynewbus[3];
        newbusinesschart.data.labels = xnewbus[3]; 
        newbusinesschart.update();

        config4.options.plugins.title.text = "Total closed Partnership Business(es) this year";
        closebusinesschart.data.datasets[0].data = yclosebus[3];
        closebusinesschart.data.labels = xclosebus[3]; 
        closebusinesschart.update();

        configrenew.options.plugins.title.text = "Renewed/Unrenewed Partnership Business(es)";
        myChartrenew.data.datasets[0].data = renewdata[3];
        myChartrenew.data.labels = renewlabels[3]; 
        myChartrenew.update();

        document.getElementById("total_business_data").innerHTML = '<?=$totalbusiness[3][0]['data'] ?>';
        document.getElementById("total_business_label").innerHTML = 'Total running <?= $totalbusiness[3][0]['label'] ?> busineses';
        
        var percent = percent_diff(<?=$totalrevenue[3][0]['data'] ?>,<?=isset($lastrevenue[3][0]['data'])?$lastrevenue[3][0]['data']:0; ?>)

        present_data.innerHTML = '<?=isset($totalrevenue[3][0]['data'])?$totalrevenue[3][0]['data']:0; ?>';
        present_text.innerHTML = '<?=$totalrevenue[3][0]['label'] ?>'+' business revenues this ' + date.getFullYear();
        last_data.innerHTML = percent+"%";
        last_text.innerHTML = percent_diff < 0 ? "Lower than last years $"+"<?=isset($lastrevenue[3][0]['data'])?$lastrevenue[3][0]['data']:0; ?>"  : "Greater than last years $"+ "<?=isset($lastrevenue[3][0]['data'])?$lastrevenue[3][0]['data']:0; ?>" ; 

        

       }else if(label ==  "Single"){

        config2.options.plugins.title.text = "Total new Single Business(es) this year";    
        newbusinesschart.data.datasets[0].data = ynewbus[2];
        newbusinesschart.data.labels = xnewbus[2]; 
        newbusinesschart.update();

        config4.options.plugins.title.text = "Total closed Single Business(es) this year";
        closebusinesschart.data.datasets[0].data = yclosebus[2];
        closebusinesschart.data.labels = xclosebus[2]; 
        closebusinesschart.update();

        configrenew.options.plugins.title.text = "Renewed/Unrenewed Single Business(es)";
        myChartrenew.data.datasets[0].data = renewdata[2];
        myChartrenew.data.labels = renewlabels[2]; 
        myChartrenew.update();

        document.getElementById("total_business_data").innerHTML = '<?=$totalbusiness[2][0]['data'] ?>';
        document.getElementById("total_business_label").innerHTML = 'Total running <?= $totalbusiness[2][0]['label'] ?> busineses';

        var percent = percent_diff(<?=$totalrevenue[2][0]['data'] ?>,<?=isset($lastrevenue[2][0]['data'])?$lastrevenue[2][0]['data']:0; ?>)

        present_data.innerHTML = '<?=isset($totalrevenue[2][0]['data'])?$totalrevenue[4][0]['data']:0; ?>';
        present_text.innerHTML = '<?=$totalrevenue[2][0]['label'] ?>'+' business revenues this ' + date.getFullYear();;
        last_data.innerHTML = percent+"%";
        last_text.innerHTML = percent_diff<0 ?"Lower than last years $" + "<?=isset($lastrevenue[2][0]['data'])?$lastrevenue[2][0]['data']:0; ?>" : "Greater than last years $" + "<?=isset($lastrevenue[2][0]['data'])?$lastrevenue[2][0]['data']:0; ?>"; 
        
        
       }else if(label ==  "Corporation"){
        config2.options.plugins.title.text = "Total new Corporation Business(es) this year";   
        newbusinesschart.data.datasets[0].data = ynewbus[4];
        newbusinesschart.data.labels = xnewbus[4]; 
        newbusinesschart.update();
        
        config4.options.plugins.title.text = "Total closed Corporation Business(es) this year";
        closebusinesschart.data.datasets[0].data = yclosebus[4];
        closebusinesschart.data.labels = xclosebus[4]; 
        closebusinesschart.update();

        configrenew.options.plugins.title.text = "Renewed/Unrenewed Corporation Business(es)";
        myChartrenew.data.datasets[0].data = renewdata[4];
        myChartrenew.data.labels = renewlabels[4]; 
        myChartrenew.update();

        document.getElementById("total_business_data").innerHTML = '<?= $totalbusiness[4][0]['data'] ?>';      
        document.getElementById("total_business_label").innerHTML = 'Total running <?= $totalbusiness[4][0]['label'] ?> busineses';  
        
        var percent = percent_diff(<?=$totalrevenue[4][0]['data'] ?>,<?=isset($lastrevenue[4][0]['data'])?$lastrevenue[4][0]['data']:1; ?>);

        present_data.innerHTML = '<?=isset($totalrevenue[4][0]['data'])?$totalrevenue[4][0]['data']:0; ?>';
        present_text.innerHTML = '<?=$totalrevenue[4][0]['label'] ?>'+' business revenues this ' + date.getFullYear();
        last_data.innerHTML = percent+"%";
        last_text.innerHTML = percent_diff<0 ?"Lower than last years $" + "<?=isset($lastrevenue[4][0]['data'])?$lastrevenue[4][0]['data']:0; ?>" : "Greater than last years $" + "<?=isset($lastrevenue[4][0]['data'])?$lastrevenue[4][0]['data']:0; ?>" 
        
        
        
       } 
       
        
  })
    </script>

</body>
</html>