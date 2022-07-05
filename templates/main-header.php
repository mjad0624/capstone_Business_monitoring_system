<?php include 'server/server.php' ?>
<?php include 'model/fetch_brgy_info.php' ?>

<?php
$query = "SELECT COUNT(status) as count FROM `tblnotif` WHERE status = '1' AND id = ".$_SESSION['id'];
$result = $conn->query($query);
$notif = $result->fetch_assoc();

$query = "SELECT * FROM tblnotif where id = ".$_SESSION['id'];
$result = $conn->query($query);

$resident = array();
while($row = $result->fetch_assoc()){
    $resident[] = $row; 
}
$count = count($resident);


// foreach($resident as $a){
//     $files = explode(",",$a['files']);
//     foreach($files as $b){
//     echo ($b);
//     }
?>

<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header">
        
        <a href="dashboard.php" class="logo">
            <img src="<?=isset($admin[0]['system_logo'])?"assets/uploads/admin_folder/".$admin[0]['system_logo']:"logo.png"?>" class="navbar-brand"> <span class="text-light ml-2 fw-bold" style="font-size:20px"><?=strtoupper($admin[0]['system_name'])?></span>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg">
        
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-settings"></i>
                    </a>
                    <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                        <li>
                            <?php if(isset($_SESSION['role'])):?>
                                <a class="see-all" href="model/logout.php">Sign Out<i class="icon-logout"></i> </a>
                            <?php else: ?>
                                <a class="see-all" href="login.php">Sign In<i class="icon-login"></i> </a>
                            <?php endif ?>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
<script>

$("#notifDropdown").click(function(){
$.ajax({
   url: 'model/notification.php',
   success: function(data){
    alert("success");
   }
});
)};
</script>