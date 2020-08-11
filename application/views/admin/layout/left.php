<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="" class="site_title"><!-- <i class="fa fa-user"></i> --><img src="<?php echo base_url()?>assets/images/Aalap-Final-logo.png" width="50" height="50" > <span>Aalap</span></a>
        </div>
        <div class="clearfix"></div>
            <!-- menu profile quick info -->
        <div class="profile clearfix">
             
            <div class="profile_info">
                <span style="margin-left: 0px;font-size: 17px;color: #00acc2;">Welcome, <i>Admin</i></span>                
            </div>
        </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3>General</h3>
                    <ul class="nav side-menu">
                       <li><a href="<?php echo base_url('AdminController/dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a> </li>                  
                       <li><a href="<?php echo base_url('AdminController/user') ?>"><i class="fa fa-bar-chart-o"></i> User management</a> </li>
                       <li><a href="<?php echo base_url('AdminController/country') ?>"><i class="fa fa-desktop"></i> Country management</a> </li>
                       <li><a href="<?php echo base_url('AdminController/city') ?>"><i class="fa fa-bar-chart-o"></i> City management</a> </li>
                       <li><a><i class="fa fa-bar-chart-o"></i> Guest management <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                            
                              <li><a href="<?php echo base_url('AdminController/privileges') ?>">Privileges</a> </li>
                              <li><a href="<?php echo base_url('AdminController/guessUserManagement') ?>">Users management</a> </li>                   

                            </ul>
                       </li>
                       <li><a href="<?php echo base_url('AdminController/rewards') ?>"><i class="fa fa-desktop"></i> Rewards management</a> </li>
                       <li><a href="<?php echo base_url('AdminController/redemption') ?>"><i class="fa fa-bar-chart-o"></i> Redemption management</a> </li>
                       <li><a href="<?php echo base_url('AdminController/chatRoom') ?>"><i class="fa fa-desktop"></i> Chat Room management</a> </li>
                       <li><a href="<?php echo base_url('AdminController/badwords') ?>"><i class="fa fa-bar-chart-o"></i> Bad Words </a> </li>
                       <li><a href="<?php echo base_url('AdminController/feedback') ?>"><i class="fa fa-desktop"></i>Feedback Management </a> </li>
                       <li><a href="<?php echo base_url('AdminController/spamusers') ?>"><i class="fa fa-bar-chart-o"></i>Spam Users </a> </li>
                       <li><a><i class="fa fa-desktop"></i> Notifications <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                            
                              <li><a href="<?php echo base_url('AdminController/customNotification') ?>">Custom Notification</a></li>
   
                            </ul>
                       </li>
                       <li><a href="<?php echo base_url('AdminController/analytics') ?>"><i class="fa fa-bar-chart-o"></i>Analytics </a> </li>
                    </ul>
                </div>
            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('adminController/logout');?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
    </div>
</div>