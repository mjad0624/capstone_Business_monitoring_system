<?php 
    //BUSINESS DASHBOARD

    $date = date('Y');
    //tblbusinessinfo datas data
        $queryinfo = "SELECT * FROM tblbusinessinfo";
        $resultinfo = $conn->query($queryinfo);
        $info = array();
        while($row = $resultinfo->fetch_assoc()){
            $info[] = $row; 
        }

    //tblbusiness data
    $querybusiness = "SELECT * FROM tblbusiness";
    $resultbusiness = $conn->query($querybusiness);
    $business = array();
	while($row = $resultbusiness->fetch_assoc()){
		$business[] = $row; 
	}
    
    //tblusers data
    if(isset($user)){
        $queryusers = "SELECT * FROM tbl_users WHERE NOT username='$user' ORDER BY `created_at` DESC";
        $resultusers = $conn->query($queryusers);
        $users = array();
        while($row = $resultusers->fetch_assoc()){
            $users[] = $row; 
        }
    }

    // tblbusinesspayments data

    // $queryyear = "SELECT YEAR(date) from tblbusinesspayments GROUP BY YEAR(date)";
    // $result = $conn->query($queryyear);
    // $year= array();
    // while($row = $result->fetch_assoc()){
    //     $year[] = $row; 
    // }
    // $count = count($year);

    $queryrevenuepage = "SELECT tblbusinesspayments.*, tblbusinessinfo.firstname, tblbusinessinfo.midlename, tblbusinessinfo.lastname,tblbusinessinfo.profile, tblbusinessinfo.b_type FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id";
    $resultrevenuepage = $conn->query($queryrevenuepage);
        $revenuepage = array();
        while($row = $resultrevenuepage->fetch_assoc()){
            $revenuepage[] = $row; 
        }

    //tblbuisnessinfo individual data
    if(isset($id)){
        $queryindivinfo = "SELECT * FROM tblbusinessinfo where id =".$id;
        $resultindivinfo = $conn->query($queryindivinfo);
        $indivinfo = array();
        while($row = $resultindivinfo->fetch_assoc()){
            $indivinfo[] = $row; 
        }
    }

    //tbl_users individual data //business client
    if(isset($_SESSION['id'])){
        $query = "SELECT * FROM tbl_users where id = ".$_SESSION['id'];
        $result = $conn->query($query);
        $indivusers = $result->fetch_assoc();
    }
    //tblbuisnessinfo individual data //business client
    if(isset($_SESSION['id'])){
        $queryindivinfo = "SELECT * FROM tblbusinessinfo where id =".$_SESSION['id'];;
        $result = $conn->query($queryindivinfo);
        $indivclientinfo = $result->fetch_assoc();
    }
    //tblbusiness individual data //business client
    $querylastpass = "SELECT YEAR(last_pass) as lastpass, status, payment, balance,status_message FROM `tblbusiness` where business_id = ".$_SESSION['id'];
    $result = $conn->query($querylastpass);
	$container = $result->fetch_assoc();

    //new business 
    $newbusiness = array();
    for($ctr=0;$ctr<5;$ctr++){
        $querynewbusiness = array(
            "SELECT MONTHNAME(created_at)as label, COUNT(*) as data FROM tbl_users INNER JOIN tblbusiness WHERE YEAR(created_at) = ".$date." AND user_type = 'business' AND id = tblbusiness.business_id AND username = tblbusiness.business_name AND tblbusiness.business_status != 'closed'  GROUP BY MONTH(created_at)",
            "SELECT MONTHNAME(last_pass) as label, COUNT(*) as data FROM `tblbusiness` INNER JOIN tblbusinessinfo WHERE YEAR(last_pass) = ".$date." AND business_status = 'new' AND business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='cooperative' AND tblbusiness.business_status != 'closed' group by  MONTHNAME(last_pass) DESC",
            "SELECT MONTHNAME(last_pass) as label, COUNT(*) as data FROM `tblbusiness` INNER JOIN tblbusinessinfo WHERE YEAR(last_pass) = ".$date." AND business_status = 'new' AND business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='single' AND tblbusiness.business_status != 'closed' group by  MONTHNAME(last_pass) DESC",
            "SELECT MONTHNAME(last_pass) as label, COUNT(*) as data FROM `tblbusiness` INNER JOIN tblbusinessinfo WHERE YEAR(last_pass) = ".$date." AND business_status = 'new' AND business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='partnership' AND tblbusiness.business_status != 'closed' group by  MONTHNAME(last_pass) DESC",
            "SELECT MONTHNAME(last_pass) as label, COUNT(*) as data FROM `tblbusiness` INNER JOIN tblbusinessinfo WHERE YEAR(last_pass) = ".$date." AND business_status = 'new' AND business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='corporation' AND tblbusiness.business_status != 'closed' group by  MONTHNAME(last_pass) DESC",
            );

        $resultnewbusiness = $conn->query($querynewbusiness[$ctr]);
        $containernewbusiness = array();
                                
        while($rowsnewbusiness = $resultnewbusiness->fetch_assoc()){
            $containernewbusiness[] = $rowsnewbusiness;

        } 
        array_push($newbusiness,$containernewbusiness);
    }

    //new business total
    $querytotalnewbusiness = "SELECT COUNT(username) as total FROM tbl_users INNER JOIN tblbusiness WHERE YEAR(created_at) = ".$date." AND user_type = 'business' AND id = tblbusiness.business_id AND username = tblbusiness.business_name AND tblbusiness.business_status != 'closed'";
    $result = $conn->query($querytotalnewbusiness);
    $totalnewbusiness = $result->fetch_assoc();
    
    //closed business
    $closebusiness = array();
    for($ctr=0;$ctr<5;$ctr++){
        $queryclose = array(
            "SELECT MONTHNAME(last_pass) as label, COUNT(*) as data FROM `tblbusiness` WHERE YEAR(last_pass) = ".$date." AND business_status = 'closed' GROUP by  MONTHNAME(last_pass) DESC",
            "SELECT MONTHNAME(last_pass) as label, COUNT(*) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE YEAR(last_pass) = ".$date." AND business_status = 'closed' and business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='cooperative' group by  MONTHNAME(last_pass)",
            "SELECT MONTHNAME(last_pass) as label, COUNT(*) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE YEAR(last_pass) = ".$date." AND business_status = 'closed' and business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='single' group by  MONTHNAME(last_pass)",
            "SELECT MONTHNAME(last_pass) as label, COUNT(*) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE YEAR(last_pass) = ".$date." AND business_status = 'closed' and business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='partnership' group by  MONTHNAME(last_pass)",
            "SELECT MONTHNAME(last_pass) as label, COUNT(*) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE YEAR(last_pass) = ".$date." AND business_status = 'closed' and business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='corporation' group by  MONTHNAME(last_pass)",
        );                        
        $resultclose = $conn->query($queryclose[$ctr]);
        $containerclosebusiness = array();
                                
        while($rows = $resultclose->fetch_assoc()){
            $containerclosebusiness[] = $rows;

        } 
        array_push($closebusiness,$containerclosebusiness);
    }
    
    //business type chart 
	$querytype = "SELECT COUNT(*) as total, tblbusinessinfo.b_type as type FROM tblbusiness INNER JOIN tblbusinessinfo ON tblbusiness.business_id = tblbusinessinfo.id WHERE tblbusiness.business_status != 'closed' GROUP BY tblbusinessinfo.b_type";
    $result = $conn->query($querytype);
    $type = array();

    while($rowtype = $result->fetch_assoc()){
		$type[] = $rowtype;  
    } 

    //renew/unrenew chart
    $renew = array();
    for($ctr=0;$ctr<5;$ctr++){
        $queryrenew = array(
            "SELECT business_status as label, COUNT(business_id) as data FROM tblbusiness WHERE business_status != 'new' AND business_status != 'closed' GROUP BY business_status",
            "SELECT business_status as label, COUNT(business_id) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='cooperative'AND business_status != 'new' AND business_status != 'closed' GROUP BY business_status",
            "SELECT business_status as label, COUNT(business_id) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='single'AND business_status != 'new' AND business_status != 'closed' GROUP BY business_status",
            "SELECT business_status as label, COUNT(business_id) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='partnership'AND business_status != 'new' AND business_status != 'closed' GROUP BY business_status",
            "SELECT business_status as label, COUNT(business_id) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='corporation'AND business_status != 'new' AND business_status != 'closed' GROUP BY business_status"
        
        );
        $result = $conn->query($queryrenew[$ctr]);
        $containerrenew = array();

        while($rowrenew = $result->fetch_assoc()){
            $containerrenew[] = $rowrenew;  
        } 
        array_push($renew,$containerrenew);
    }


    //yearly revenue
    $totalrevenue = array();
    for($ctr=0;$ctr<5;$ctr++){
        $queryyearlyrevenue = array(
            "SELECT YEAR(date) as label,SUM(balance) as data FROM tblbusinesspayments GROUP BY YEAR(date) DESC",
            "SELECT tblbusinessinfo.b_type as label ,SUM(balance) as data FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='cooperative' AND YEAR(tblbusinesspayments.date) = '2021' GROUP BY YEAR(date)",
            "SELECT tblbusinessinfo.b_type as label ,SUM(balance) as data FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='single' AND YEAR(tblbusinesspayments.date) = ".$date." GROUP BY YEAR(date)",
            "SELECT tblbusinessinfo.b_type as label ,SUM(balance) as data FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='partnership' AND YEAR(tblbusinesspayments.date) = ".$date." GROUP BY YEAR(date)",
            "SELECT tblbusinessinfo.b_type as label ,SUM(balance) as data FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='corporation' AND YEAR(tblbusinesspayments.date) = '2021' GROUP BY YEAR(date)"
            
        );
        $result = $conn->query($queryyearlyrevenue[$ctr]);
        $containeryearlyrevenue = array();

        while($rowyearlyrevenue = $result->fetch_assoc()){
            $containeryearlyrevenue[] = $rowyearlyrevenue;  
        }
        array_push($totalrevenue,$containeryearlyrevenue);
    } 


        //last year revenue
        $lastrevenue = array();
        for($ctr=0;$ctr<5;$ctr++){
            $querylastrevenue = array(
                "SELECT YEAR(date) as label,SUM(balance) as data FROM tblbusinesspayments GROUP BY YEAR(date) DESC",
                "SELECT tblbusinessinfo.b_type as label ,SUM(balance) as data FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='cooperative' AND YEAR(tblbusinesspayments.date) = '".date("Y",strtotime("-1 year"))."' GROUP BY YEAR(date)",
                "SELECT tblbusinessinfo.b_type as label ,SUM(balance) as data FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='single' AND YEAR(tblbusinesspayments.date) = '".date("Y",strtotime("-1 year"))."' GROUP BY YEAR(date)",
                "SELECT tblbusinessinfo.b_type as label ,SUM(balance) as data FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='partnership' AND YEAR(tblbusinesspayments.date) = '".date("Y",strtotime("-1 year"))."' GROUP BY YEAR(date)",
                "SELECT tblbusinessinfo.b_type as label ,SUM(balance) as data FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='corporation' AND YEAR(tblbusinesspayments.date) = '".date("Y",strtotime("-1 year"))."' GROUP BY YEAR(date)"
                
            );
            $result = $conn->query($querylastrevenue[$ctr]);
            $containeryearlyrevenue = array();
    
            while($rowyearlyrevenue = $result->fetch_assoc()){
                $containeryearlyrevenue[] = $rowyearlyrevenue;  
            }
            array_push($lastrevenue,$containeryearlyrevenue);
        } 
    
    //currrent & last revenue percent difference
    
    
    $current = isset($totalrevenue[0][0]['data'])?$totalrevenue[0][0]['data']:0;
    $last = isset($totalrevenue[0][1]['data'])?$totalrevenue[0][1]['data']:0;

    $percent_diff = (($current-$last)/$last)*100;


    

    //Revenue pie chart 
    $queryrevenue = "SELECT SUM(tblbusinesspayments.balance) as revenue, tblbusinessinfo.b_type FROM tblbusinesspayments INNER JOIN tblbusinessinfo WHERE tblbusinesspayments.id = tblbusinessinfo.id AND YEAR(tblbusinesspayments.date) = ".date("Y")." GROUP BY tblbusinessinfo.b_type";
    $result = $conn->query($queryrevenue);
    $revenue = array();
    while($rowrevenue = $result->fetch_assoc()){
		$revenue[] = $rowrevenue;  
    } 
   
    //total running busineses text 
   
    $totalbusiness = array();
        for($ctr=0;$ctr<5;$ctr++){
            $querytotalbusiness= array(
                "SELECT COUNT(business_status) as data FROM tblbusiness WHERE business_status != 'closed'",
                "SELECT tblbusinessinfo.b_type as label, COUNT(business_status) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE tblbusiness.business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='cooperative' AND tblbusiness.business_status != 'closed'",
                "SELECT tblbusinessinfo.b_type as label, COUNT(business_status) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE tblbusiness.business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='single' AND tblbusiness.business_status != 'closed'",
                "SELECT tblbusinessinfo.b_type as label, COUNT(business_status) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE tblbusiness.business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='partnership' AND tblbusiness.business_status != 'closed'",
                "SELECT tblbusinessinfo.b_type as label, COUNT(business_status) as data FROM tblbusiness INNER JOIN tblbusinessinfo WHERE tblbusiness.business_id = tblbusinessinfo.id AND tblbusinessinfo.b_type ='corporation' AND tblbusiness.business_status != 'closed'"
            );
            $result = $conn->query($querytotalbusiness[$ctr]);
            $containertotalbusiness = array();
    
            while($row = $result->fetch_assoc()){
                $containertotalbusiness[] = $row;  
            }
            array_push($totalbusiness,$containertotalbusiness);
        } 

    //closed business total chart
    $querytotalclosebusiness = "SELECT COUNT(business_status) as totalclose FROM tblbusiness WHERE YEAR(last_pass) = ".date('Y')." AND business_status = 'closed'";
    $result = $conn->query($querytotalclosebusiness);
    $totalclose = $result->fetch_assoc();

    //status business query chart
	$querystatus = "SELECT status,COUNT(*) as total FROM tblbusiness GROUP BY status";
    $result = $conn->query($querystatus);
    $status = array();

    while($rowstatus = $result->fetch_assoc()){
		$status[] = $rowstatus;  
    } 

    //balance chart datas
    $querybal = "SELECT COUNT(balance) as unpaid FROM tblbusiness WHERE balance !=0 and payment = 'unpaid' OR payment = 'pending'";
    $result = $conn->query($querybal);
    $unpaid = $result->fetch_assoc();

    $querybal = "SELECT COUNT(balance) as paid FROM tblbusiness WHERE balance = 0 AND status = 'passed' AND payment = 'paid'";
    $result = $conn->query($querybal);
    $paid = $result->fetch_assoc();    


// BUSINESS_FILES

    if(isset($stats)){
        //business_status table
        $querystatus  = "SELECT * FROM tblbusiness where status = '".$stats."'";
        $resultstatus = $conn->query($querystatus);
        $business_status = array();
        while($row = $resultstatus->fetch_assoc()){
            $business_status[] = $row; 
        }
    
    }

    //BUSINESS_BALANCE
    if(isset($_GET['balance'])){
        if($_GET['balance'] == 'paid'){
            $query = "SELECT YEAR(last_pass) as ylastpass, business_id,business_name,business_logo,business_files,status,last_pass,days_not_clear,balance,payment FROM tblbusiness where balance = '0' AND status = 'passed' and payment = 'paid'";
            $result = $conn->query($query);
            $balance = array();
            while($row = $result->fetch_assoc()){
                $balance[] = $row; 
            }
        }else if($_GET['balance'] == 'unpaid' || $_GET['balance'] == 'passed' || $_GET['balance'] == 'missing' ||$_GET['balance'] == 'pending' ){
            $query = "SELECT YEAR(last_pass) as ylastpass, business_id,business_name,business_logo,business_files,status,last_pass,days_not_clear,balance,payment FROM tblbusiness where balance != '0' and payment = 'unpaid' OR payment = 'pending' ";
            $result = $conn->query($query);
            $balance = array();
            while($row = $result->fetch_assoc()){
                $balance[] = $row; 
            }
        
    }
}
    if(isset($_GET['balance'])){
    
    foreach($balance as $row)                                                     
    if($row['ylastpass'] != date('Y') && $row['status'] == "missing"){
       
       $unsubmitdays = date('z')-20;
       $qunsubmitdays = "  UPDATE tblbusiness SET days_not_clear = ".$unsubmitdays." where business_id = ".$row['business_id'];
       $result = $conn->query($qunsubmitdays);
    }else if($row['ylastpass'] == date('Y') && $row['status'] == "passed"){
       $qunsubmitdays = "  UPDATE tblbusiness SET days_not_clear = 0 where business_id = ".$row['business_id'];
       $result = $conn->query($qunsubmitdays);
       }
    }
    
    //receipt 
    if(isset($_GET['balance'])){
        $queryreceipt = "SELECT pic_receipt as receipt FROM tblbusinesspayments WHERE balance =0";
        $containerreceipt = $conn->query($queryreceipt);
        $receipt = $containerreceipt->fetch_assoc();
    }


    //admin data
    $queryadmin = "SELECT * from tbladmin where id = '2'";
            $result = $conn->query($queryadmin);
            $admin = array();
            while($row = $result->fetch_assoc()){
                $admin[] = $row; 
            }

    
?>