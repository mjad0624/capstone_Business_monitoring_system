<?php // function to get the current page name
function PageName() {
  return substr( $_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") +1);
}

$current_page = PageName();
?>
<div class="sidebar sidebar-style-2" >			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <?php if(!empty($_SESSION['avatar'])): ?>
                        <img src="<?= (file_exists('assets/uploads/business_files/business_logo/'.$_SESSION['avatar']) ? 'assets/uploads/business_files/business_logo/'.$_SESSION['avatar'] : 'assets/uploads/business_files/business_logo/person.png') ?>" alt="User Profile" class="avatar-img rounded-circle">
                    <?php else: ?>
                        <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif ?>
                   
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="<?= isset($_SESSION['username']) && $_SESSION['role']=='administrator' ? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        <span>
                        <?= isset($_SESSION['username']) ? ucfirst($_SESSION['username']) : 'Guest User' ?>
                            <span class="user-level"><?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Guest' ?></span>
                        <?= isset($_SESSION['username']) && $_SESSION['role']=='administrator' ? '<span class="caret"></span>' : null ?> 
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#edit_profile" data-toggle="modal">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                                <a href="#changepass" data-toggle="modal">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <?php if(isset($_SESSION['username'])):?>
                <?php if($_SESSION['role']!= 'business'):?>
            <ul class="nav nav-primary">
                <li class="nav-item <?= $current_page=='business_dashboard.php' ? 'active' : null ?>">
                        <a href="business_dashboard.php">
                            <i class="fas fa-flag"></i>
                            <p>Business Dashboard</p>
                        </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item <?= $current_page=='officials.php' ? 'active' : null ?>">
                    <a href="officials.php">
                        <i class="fas fa-user-tie"></i>
                        <p>Officials and Staff</p>
                    </a>
                </li>
                
                <li class="nav-item <?= $current_page=='business_info.php' || $current_page=='generate_resident.php' ? 'active' : null ?>">
                    <a href="business_info.php">
                        <i class="icon-people"></i>
                        <p>Business Information</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='revenue.php' ? 'active' : null ?>">
                    <a href="revenue.php">
                        <i class="fas fa-dollar-sign"></i>
                        <p>Revenues</p>
                    </a>
                </li>
                <li class="nav-item  <?= $current_page=='users.php' ? 'active' : null ?>">
                    <a href="users.php">
                        <i class="fas fa-dollar-sign"></i>
                        <p>Users</p>
                    </a>
                </li>
                
              
           
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='staff'): ?>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">System</h4>
                    </li>
                    <li class="nav-item">
                        <a href="#support" data-toggle="modal">
                            <i class="fas fa-flag"></i>
                            <p>Support</p>
                        </a>
                    </li>
                    
                <?php endif ?>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'): ?>
                
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">System</h4>
                </li>
                <li class="nav-item <?= $current_page=='purok.php' || $current_page=='position.php' || $current_page=='chairmanship.php' || $current_page=='precinct.php' || $current_page=='support.php' || $current_page=='backup.php' ? 'active' : null ?>">
                    <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                        <i class="icon-wrench"></i>
                            <p>Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?= $current_page=='purok.php' || $current_page=='position.php'  || $current_page=='precinct.php' || $current_page=='chairmanship.php'|| $current_page=='support.php' || $current_page=='backup.php' ? 'show' : null ?>" id="settings">
                        <ul class="nav nav-collapse">
                          
                            
                            <?php if($_SESSION['role']=='staff'):?>
                                <li>
                                    <a href="#support" data-toggle="modal">
                                        <span class="sub-item">Support</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                
                                <li class="<?= $current_page=='support.php' ? 'active' : null ?>">
                                    <a href="support.php">
                                        <span class="sub-item">Support</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page=='settings_system.php' ? 'active' : null ?>">
                                    <a href="settings_system.php">
                                        <span class="sub-item">System Settings</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page=='settings_business.php' ? 'active' : null ?>">
                                    <a href="settings_business.php">
                                        <span class="sub-item">Business Requirements</span>
                                    </a>
                                </li>
                                
                            <?php endif ?>
                        </ul>
                    </div>
                </li>
                    <?php endif ?>
                <?php else: ?>

                    <ul class="nav nav-primary">

                    <li class="nav-item">
                        <a href="business_client.php">
                            <i class="fas fa-home"></i>
                            <p>Main Page</p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="forbusiness.php">
                        <i class="icon-layers"></i>
                        <p>Business requirements</p>
                    </a>
                    </li>
                    <li class="nav-item">
                        <a href="#support" data-toggle="modal">
                            <i class="fas fa-flag"></i>
                            <p>Support</p>
                        </a>
                    </li>
                    
                

                </ul>
                <?php endif ?>
            <?php endif ?>
            </ul>
        </div>
    </div>
</div>