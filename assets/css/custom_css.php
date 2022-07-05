<?php include '../../server/server.php' ?>
<?php include '../../model/data.php' ?>

<?php
    header('Content-type: text/css; charset:UTF-8');
    //body, header, sidebar,body_header,text 
    $custom_css =[["#f9fbfd", "#1572e8","#1269db","#1269db","#000"],        //theme1    //blue
    ["#FFEDED", "#362222","#B3541E","#B3541E","#000"],                       //theme2    //orange                         
    ["#D3DEDC", "#7C99AC","#92A9BD","#92A9BD","#000"],                      //theme3     //light blue
    ["#F0ECE3", "#A68DAD","#DFD3C3","#DFD3C3","#000"],                      //theme4    //pink
    ["#deeaee", "#3b3a30","#b2c2bf","#b2c2bf","#000"]];                     //theme5    //gray
                              
    $a = $admin[0]['system_color'];
?>

:root{
        --body-1: #f9fbfd;
        --header-1: #1572e8;
        --sidebar-header-1: #1269db;
        --body_header-1: #1269db;
        --text-1: #353535;
        --body-2: <?=$custom_css[$a][0]?>;
        --header-2: <?=$custom_css[$a][1]?>;
        --sidebar-header-2: <?=$custom_css[$a][2]?>;
        --body_header-2: <?=$custom_css[$a][3]?>;
        --text-2: <?=$custom_css[$a]?>[4];
    }

    body{
        background-color:  <?=$custom_css[$a][0]?> !important;
    }
    .sidebar{
        background-color:  <?=$custom_css[$a][0]?> !important;
    }

    .navbar{
        background-color:  <?=$custom_css[$a][1]?> !important;
    }
    .logo-header{
        background-color:  <?=$custom_css[$a][2]?> !important;
    }
    .panel-header{
        background-color:  <?=$custom_css[$a][2]?> !important;
    }
    .badge{
        background-color:  <?=$custom_css[$a][1]?> !important;
    }

    .sidebar.sidebar-style-2 .nav.nav-primary > .nav-item.active > a{
    background-color:  <?=$custom_css[$a][1]?> !important;
    }

    .btn-link.btn-primary{
        color:  <?=$custom_css[$a][1]?> !important;
    }


