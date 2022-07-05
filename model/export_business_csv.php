<?php

require("../server/server.php");

// get Users
$query = "SELECT id,firstname,midlename,lastname,profile,gender,contact,emailadd,address,e_contact,e_emailadd,e_relationship,b_name,b_type,b_address,b_emailadd,b_contact,b_line,b_area,b_capital,dti_coa_number,tax_number,number_employee,lessor,l_address,monthly_rent,l_contact,application_type,mode_payment FROM tblbusinessinfo";
if (!$result = $conn->query($query)) {
    exit($conn->error);
}

$users = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Business_info.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'First Name','Middle Name', 'Last Name', 'Profile', 'Gender', 'Contact', 'Email', 'Address', 'Emergency Contact', 'Emergency Email', 'Emergency Address', 'Business Type', 'Business Address', 'Business Contact', 'Business Line', 'Area(sq ft)', 'Capital', 'DTI/COA Number', 'Tax number', 'Number of Employee','Lessor','Lessor Address','Monthly Rent','Lessor Contact','Application Type','Mode of Payment'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}


?>