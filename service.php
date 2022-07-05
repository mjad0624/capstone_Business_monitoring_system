<?php include 'server/server.php' ?>
<?php 
	$query = "SELECT * FROM tbl_users";
    $result = $conn->query($query);
    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
	}

    $query2 = "SELECT business_files from tblbusiness where business_id = 1";
?>
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
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">kahit ano</h2>
							</div>
						</div>
					</div>
				</div>
                 <br><br>
<h2 style="padding-left: 80px; padding-right: 80px">                 
<b style="color: blue">The Fire Safety Inspection Certificate (FSIC)</b> issued by the Bureau of Fire Protection serves as an assurance that a certain facility, structure or building/occupancy has been duly inspected and deemed complying to the Fire Code of the Philippines or RA 9514.<br><br>
<b style="color: blue">REQUIREMENTS:</b><br>
1. Photocopy of Electrical Inspection Certification<br>
2. Photocopy of Fire Insurance Policy (if any)<br>
3. Official Receipt of Fire Code Fee (present year)<br><br>

<b style="color: blue">HOW TO AVAIL OF THE SERVICE</b><br>
1. Fill-up the application form and complete all the requirements<br>
2. Fire Safety Inspector (FSI) will conduct inspection and submit After Inspection Report (AIR).<br>
3. If it is approved you will receive Order of payment (OP)<br>
4. Pay the assessed amount and submit copy of receipt of payment to Office of the treasurer.<br>
5. The treasurer will issue Fire Safety Inspection Certificate.<br><br>

<b style="color: blue">Zoning Certificate from the OFFICE OF THE MUNICIPAL PLANNING & DEVELOPMENT OFFICE<br>
Requirements:</b><br>
1. Filled-up Application Form<br>
2. Photocopy of Tax Declaration/Certificate of Land Title<br>
3. Photocopy of Realty Tax receipt<br>
4. Building Plan/Electrical Layout and BOM<br><br>

<b style="color: blue">HOW TO AVAIL OF THE SERVICE</b><br>
1. Submit required documents for verification and evaluation.<br>
2. Zoning officer evaluates the completeness of required documents.<br>
3. Zoning officer sets schedule for ocular inspection and verify conformity with existing CLUP and Ordinance.<br>
4. Zoning officer prepares an inspection / evaluation report.<br>
5. MPDO will give you Order of payment.<br>
6. Make corresponding payment at the Municipal’s Treasurer’s Office.<br>
7. The Certificate of Zoning and Locational Clearance are released to the client.<br><br>

<b style="color: blue">Issuance of Sanitary Permit from Rural Health Unit Office</b><br>
Food and Non-food business establishments are required to secure sanitary permit to make sure they observe the standard of the Sanitary Code of the Philippines. Workers /in said establishments are also required to secure health cards.<br><br>
<b style="color:blue">Business falls into two categories:</b><br>
1. Food or those dealing in food preparation and processing. In this case, proprietors, managers, waiters and waitresses & cooks required to secure health cards.<br>
2. Non-food or other establishments not involved in food preparation and processing, in which case managers, helpers, salesmen, salesladies and laborers are required to secure health cards.<br><br>


<b style="color: blue">HOW TO AVAIL OF THE SERVICE</b><br>
1. Go to RHU and secure a checklist of requirements for securing sanitary permit/health cards.<br>
2. Rural Sanitary Inspector (RSI) issues checklist of requirements.<br>
3. Upon completion of the requirements, go back to RHU and submit stool sample for fecalysis and sputum for microscopy. Wait for the service as to release of the exam results and the schedule of the physical examination.<br>
4. Rural Sanitary Inspector (RSI) obtains stool sputum samples and advises clients of the release of examination results and schedule of physical examination.<br>
5. Return to the RHU on the appointed date to secure laboratory results to undergo physical examinations.<br>
6. Municipal Health Officer performs physical examination.<br>
7. If there are no advance findings, you will be issued a sanitary permit and health card.<br>
8. Rural Sanitary Inspector (RSI) issues Sanitary Permit & Health Card.<br><br>

OR<br><br>

1. Go to RHU and secure a checklist of requirements for securing sanitary permit/health cards.<br>
2. Rural Sanitary Inspector (RSI) issues checklist of requirements.<br>
3. Submit all required the lab test including physical test results.<br>
4. Rural Sanitary Inspector (RSI) issues Sanitary Permit & Health Card.
</h2>
            </div>
              


                            
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