
<?php include '../server/server.php' ?>
<?php include 'data.php' ?>
<html>
<body>

<?php
$year = date('Y'); //current year
$date = new DateTime(); 
$current_date = date("Y");
$id = $_SESSION['id'];

$result = ($date)->format('Y/m/d');
// echo ($result);
// echo ($current_date);

    $query = "SELECT last_pass FROM `tblbusiness` where business_id = ".$id;
    $result = $conn->query($query);
    $lastpass = array();
	$lastpass = $result->fetch_assoc();
		
// print_r ($lastpass['last_pass']);

//difference between 2 dates in days
$date2 = new DateTime($lastpass['last_pass']);
$interval = $date->diff($date2);

// shows the total amount of days (not divided into years, months and days like above)
echo "difference " . $interval->days . " days ";      

?> 

<?php



$var = ["dfdf","hghg","ghggh"];
print_r (isset($var['0'])?$var:0);

function datecheck($date,$current_date){ //compared the current date and jan 20 (x)year
    if($date==$current_date){
        return true;
    }else{
        return false;
    }
}



// $str = "Hello world. It's a beautiful day.";
// $text = (explode(" ",$str));
// $total = count($text);`
// $tring="";
// for($i=0;$i<$total;$i++){

//     $tring .=$text[$i]." ";

// }

//echo ($tring);

// function datecheck($date,$current_date){
//     if($date==$current_date){
//         echo "yahoooo their alligned";
//     }else{
//         echo "pupu what a disapointment";
//     }
// }

//datecheck($date,$current_date);

//displaying files
echo "</br>";
echo (date('Y'));
echo "</br>";


echo "<h2> Display files</h2></br>";
$query = "SELECT * FROM tblbusiness where business_id = ".$id;
    $result = $conn->query($query);
    $total = $result->fetch_assoc();
    $files = explode(",",$total["business_files"]);
    print_r ($files);
    $num =  count($files);
    $num -= 1;
    echo ($num);

    for($i = 0;$i < $num; $i++){
        $path = "../assets/uploads/business_files/".$total["business_id"].$total["business_name"]."/".$files[$i];
        echo "</br><a href = '".$path."'> pdf file</a>";
    }

$query = "SELECT last_pass FROM tblbusiness where business_id = 1";
$result = $conn->query($query);
$total = $result->fetch_assoc();
//$last_pass =  date("Y",strtotime($total["last_pass"])); //gets the year from database

?> 

<h2> submit files</h2></br>
<form action="business_files.php" method = "post" enctype = "multipart/form-data">
    <input type="file" name="docu[]" id = "docu" multiple> 
    <button type="submit">Submit</button>
</form>

<button type="submit" id = "add">adddata</button>
<div class = "charbox" style = "width: 1000px;">
    <canvas id="myChart2" style = "height:100px; width:100px;" ></canvas>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
<script>


    const unpaid = "<?php echo ($unpaid['unpaid']); ?>";
    const paid = "<?php echo ($paid['paid']); ?>";
    
    
    document.getElementById('add').addEventListener("click", function(){


        updatechart();
    })

const databalance = {
  labels: [
    "Fully Paid", "Has remaining balance"   
  ],
  datasets: [{
    label: 'Requested Barangay Papers',
    data: [paid, unpaid],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
    ],
    hoverOffset: 5

  }]
};

const config3 = {
  type: 'pie',
  data: databalance,
};

const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config3
  );

  data = [1,2];
  function updatechart(){
    myChart2.data.datasets[0].data = data;
    myChart2.update();
  }
  document.querySelector('#myChart2').addEventListener("click", function(event){
    const points = myChart2.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);
        const firstPoint = points[0];
        var label = myChart2.data.labels[firstPoint.index];
        var value = myChart2.data.datasets[firstPoint.datasetIndex].data[firstPoint.index];

       if(label == "Fully Paid"){
        window.location.href = "business_balance.php?balance=paid"; 
       }else if(label == "Has remaining balance"){
        window.location.href = "business_balance.php?balance=unpaid"; 
       }
        
  })

</script>
</html>