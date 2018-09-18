
<?php $name = $user_email_id = '';
    $controller_name    =   $this->router->fetch_class(); 
    $method_name        =   $this->router->fetch_method();  
    $user_type          = $this->session->userdata('user_type');
    $logged_in_array    = $this->session->userdata('logged_in');
    $name               = $logged_in_array['name'];
    $user_email_id      = $logged_in_array['email'];
?>
<div class="wrapper">
<?php if ($this->session->userdata('logged_in')) { ?>
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>admin/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Z</b>A</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ZingUp</b> Assessment</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-lists text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-lists text-red"></i> 5 new members joined
                    </a>
                  </li>

                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-list text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ucfirst($name);?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo ucfirst($name);?>
                  <small><?php echo $user_email_id;?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?>admin/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
    <!--          <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
<!--          <li class="treeview <?php //if($controller_name=='dashboard'){ ?>active <?php //} ?>">
              <a href="<?php //echo base_url(); ?> admin/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
          </li>-->
          <li class="treeview <?php if($controller_name=='theme'){ ?>active <?php } ?>">
          <a href="#">
            <i class="fa fa fa-list"></i>
            <span>Themes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li <?php if($controller_name=='theme' && ($method_name=='create' || $method_name=='edit')){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/theme/create"><i class="fa fa-arrow-circle-right"></i>Create</a></li>
               <li <?php if($controller_name=='theme' && $method_name=='index'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/theme/index"><i class="fa fa-arrow-circle-right"></i> Manage</a></li>

          </ul>
        </li>
        <li class="treeview <?php if($controller_name=='sub_theme'){ ?>active <?php } ?>">
          <a href="#">
            <i class="fa fa fa-list"></i>
            <span>Sub Themes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li <?php if($controller_name=='sub_theme' && ($method_name=='create' || $method_name=='edit')){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/sub_theme/create"><i class="fa fa-arrow-circle-right"></i>Create</a></li>
               <li <?php if($controller_name=='sub_theme' && $method_name=='index'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/sub_theme/index"><i class="fa fa-arrow-circle-right"></i> Manage</a></li>
          </ul>
        </li>
        <li class="treeview <?php if($controller_name=='test' || $controller_name == 'theme_test'){ ?>active <?php } ?>">
          <a href="#">
            <i class="fa fa fa-list"></i>
            <span>Levels</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li <?php if($controller_name=='test' && ($method_name=='create' || $method_name=='edit')){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/test/create"><i class="fa fa-arrow-circle-right"></i>Create</a></li>
               <li <?php if($controller_name=='test' && $method_name=='index'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/test/index"><i class="fa fa-arrow-circle-right"></i> Manage</a></li>
               
               <li <?php if($controller_name=='theme_test' && $method_name=='index'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/theme_test/index"><i class="fa fa-arrow-circle-right"></i> Theme Level Order</a></li>
          </ul>
        </li>
<!--       <li class="treeview <?php if($controller_name=='theme_test'){ ?>active <?php } ?>">
              <a href="<?php echo base_url();?>admin/theme_test/index"><i class="fa fa-bookmark"></i> Theme Level Order</a>
       </li>-->
        <li class="treeview <?php if($controller_name=='sub_theme_test_weightage' && $method_name=='index'){ ?>active <?php } ?>"><a href="<?php echo base_url();?>admin/sub_theme_test_weightage/index"><i class="fa fa-bookmark"></i>Sub Theme Weightage</a></li>
        
        <li class="treeview <?php if($controller_name=='questions' || $controller_name=='question_order'){ ?>active <?php } ?>">
          <a href="#">
            <i class="fa fa fa-list"></i>
            <span>Question & Answers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li <?php if($controller_name=='questions' && ($method_name=='create' || $method_name=='edit')){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/questions/create"><i class="fa fa-arrow-circle-right"></i>Create</a></li>
               <li <?php if($controller_name=='questions' && $method_name=='index'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/questions/index"><i class="fa fa-arrow-circle-right"></i> Manage</a></li>
               <li <?php if($controller_name=='question_order' && $method_name=='index'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/question_order/index"><i class="fa fa-arrow-circle-right"></i> Question Order</a></li>
               
               
          </ul>
        </li>
        
        <li class="treeview <?php if($controller_name=='sub_theme_questions' && $method_name=='index'){ ?>active <?php } ?>"><a href="<?php echo base_url();?>admin/sub_theme_questions/index"><i class="fa fa-bookmark"></i> Question Weightage</a></li>
        
<!--        <li class="treeview <?php if($controller_name=='test_questions' && $method_name=='index'){ ?>active <?php } ?>"><a href="<?php echo base_url();?>admin/test_questions/index"><i class="fa fa-bookmark"></i>Test Questions Mapping</a></li>-->
        
        
        
<!--        <li class="treeview <?php if($controller_name=='activity_goal' && $method_name=='index'){ ?>active <?php } ?>"><a href="<?php echo base_url();?>admin/activity_goal/index"><i class="fa fa-bookmark"></i>Activities to goal</a></li>-->
        
        <li class="treeview <?php if($controller_name=='assessment_goal'){ ?>active <?php } ?>">
          <a href="#">
            <i class="fa fa fa-list"></i>
            <span>Goals Mapping</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li <?php if($controller_name=='assessment_goal' && ($method_name=='create' || $method_name=='edit')){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/assessment_goal/create"><i class="fa fa-arrow-circle-right"></i>Create</a></li>
               <li <?php if($controller_name=='assessment_goal' && $method_name=='index'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/assessment_goal/index"><i class="fa fa-arrow-circle-right"></i> Manage</a></li>
          </ul>
        </li>
        
        
        
        
        
        <li class="treeview <?php if($controller_name=='test_interpretation'){ ?>active <?php } ?>">
              <a href="<?php echo base_url();?>admin/test_interpretation"><i class="fa fa-list"></i> <span>Test Interpretation</span></a>
        </li>
        <li class="treeview <?php if(($controller_name=='goal_segment' || $controller_name=='goals' || $controller_name=='goal_activity' ||  $controller_name=='activity_goal')){ ?>active <?php } ?>">
          <a href="#">
            <i class="fa fa fa-list"></i>
            <span>Goals</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <li <?php if($controller_name=='goal_segment'  && ($method_name=='index' || $method_name=='create')){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/goal_segment/index"><i class="fa fa-arrow-circle-right"></i> Segments</a></li>
<!--                <li <?php if($controller_name=='goals' && $method_name=='create'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/goals/create"><i class="fa fa-arrow-circle-right"></i>Create Goal</a></li>-->
               <li <?php if($controller_name=='goal_activity' && ($method_name=='create' || $method_name=='index')){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/goal_activity/index"><i class="fa fa-arrow-circle-right"></i>Activities</a></li>
               
               <li <?php if($controller_name=='goals' && ($method_name=='index' || $method_name=='create')){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/goals/index"><i class="fa fa-arrow-circle-right"></i> Goals</a></li>
               
               
              
<!--               <li <?php //if($controller_name=='activity_goal' && $method_name=='index'){ ?> class="active" <?php //} ?>><a href="<?php //echo base_url();?>admin/activity_goal/index"><i class="fa fa-arrow-circle-right"></i>Map activities to goal</a></li>-->

          </ul>
        </li>
        <li class="treeview <?php if($controller_name=='advice'){ ?>active <?php } ?>">
          <a href="#">
            <i class="fa fa fa-list"></i>
            <span>Advice Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li <?php if($controller_name=='advice' && ($method_name=='create' || $method_name=='edit')){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/advice/create"><i class="fa fa-arrow-circle-right"></i>Create</a></li>
               <li <?php if($controller_name=='advice' && $method_name=='index'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/advice/index"><i class="fa fa-arrow-circle-right"></i> Manage</a></li>


          </ul>
        </li>
        <li class="treeview <?php if($controller_name=='user'){ ?>active <?php } ?>">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li <?php if($controller_name=='user' && $method_name=='create'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/user/create"><i class="fa fa-arrow-circle-right"></i> Add User</a></li>
            <li <?php if($controller_name=='user' && $method_name=='index'){ ?> class="active" <?php } ?>><a href="<?php echo base_url();?>admin/user/index"><i class="fa fa-arrow-circle-right"></i> Manage</a></li>
          </ul>
        </li>
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
  
  <?php } ?>