<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KPI | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
   <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />  
    <!-- FontAwesome 4.3.0 -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.css">
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />  

    <!-- css for checkbox -->
    <link href="{{asset('assets/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="{{asset('assets/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />


    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href=" {{asset('assets/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{asset('assets/plugins/iCheck/flat/blue.css')}}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{asset('assets/dist/css/custom.css')}}" rel="stylesheet" type="text/css" />
	<!--datatable-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo"><b>Dashboard</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('assets/dist/img/avatar5.png')}}" class="img-circle" alt="User Image" />
            </div>
            <?php
            $all_role=DB::table('roles')->select('role')->where('id',auth()->user()->role_id)->get()->first();
            $current_user_role_id=auth()->user()->role_id;
            ?>
            <div class="pull-left info">
            	<big><big>
              <p align="center">&nbsp&nbsp{{strtoupper(auth()->user()->name)}}</p>
              	</big></big>
              <p align="center">{{strtoupper($all_role->role)}}</p>

            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->

          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            @if(isset($all_role->role) && strtolower($all_role->role)=="admin")
            <li class="active treeview">
              <a href="{{url('/home')}}">
                <i class="fa fa-home"></i> <span>Dashboard</span>
              </a>
              <!--<ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>-->
            </li>

            <!--register user-->
            <li class="treeview">
              
              
              <!--<ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>-->
            </li>

            <li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='add_role') || (Request::path() =='view_role')  )?'active' :'' ?>">
              <a href="#">
                <i class="fa fa-group"></i><span>Role Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='add_role') )?'active' :'' ?>">
                  <a href="{{url('/add_role')}}">
                    <i class="fa fa-plus-square"></i><span>Add Role</span>
                  </a>
                </li>

                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='view_role') )?'active' :'' ?>">
                  <a href="{{url('/view_role')}}">
                    <i class="fa fa-eye"></i><span>View Role</span>
                  </a>
                </li>
              </ul>
            </li>
            
			<li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='add_user') || (Request::path() =='add_project')  || (Request::path() =='view_project') )?'active' :'' ?>">
              <a href="#">
                <i class="fa fa-sitemap"></i><span>Project Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='add_project') )?'active' :'' ?>">
                  <a href="{{url('add_project')}}">
                  <i class="fa fa-plus-square"></i><span>Add Project</span>
                  </a>
                </li>
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='view_project') )?'active' :'' ?>">
                  <a href="{{url("view_project")}}">
                    <i class="fa fa-eye"></i><span>View Project</span>
                  </a>
                  </li>
              </ul>
            </li>

            <li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='add_user') || (Request::path() =='view_user')  || (Request::path() =='edit_user') )?'active' :'' ?>">
              <a href="#">
                <i class="fa fa-user"></i><span>User Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='add_user') )?'active' :'' ?>">
                  <a href="{{url('/add_user')}}">
                  <i class="fa fa-plus-square"></i> <span>Add User</span>
                  </a>
                </li>
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='view_user') )?'active' :'' ?>" >
                  <a href="{{url('/view_user')}}" class="active">
                    <i class="fa fa-eye"></i> <span>View User</span>
                  </a>
                </li>
              </ul>
            </li>
            <!--register user end-->

            <!--Point Setting Section-->
            <li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='add_points') || (Request::path() =='view_points'))?'active' :'' ?>">
              <a href="#">
                <i class="fa fa-comments"></i> <span>Point Value Setting</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='add_points') )?'active' :'' ?>">
                  <a href="{{url('/add_points')}}">
                  <i class="fa  fa-plus-square"></i> <span>Add </span>
                  </a>
                </li>
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='view_points') )?'active' :'' ?>" >
                  <a href="{{url('/view_points')}}" class="active">
                    <i class="fa fa-eye"></i> <span>View Points </span>
                  </a>
                </li>
              </ul>
            </li>

            <!--Evaluation Point Section-->
            <li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='add_evaluation_point') || (Request::path() =='view_evaluation_point'))?'active' :'' ?>">
              <a href="#">
                <i class="fa fa-comments"></i> <span>Question Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='add_question') )?'active' :'' ?>">
                  <a href="{{url('/add_evaluation_point')}}">
                  <i class="fa  fa-plus-square"></i> <span>Add Question</span>
                  </a>
                </li>
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='view_question') )?'active' :'' ?>" >
                  <a href="{{url('/view_evaluation_point')}}" class="active">
                    <i class="fa fa-eye"></i> <span>View Question</span>
                  </a>
                </li>
              </ul>
            </li>
            @endif
 
	<!--these menu for HR Role-->
	@if(isset($all_role->role) && (strtolower($all_role->role)=="hr") )

			<li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='ticket/view') || (Request::path() =='ticket/view'))?'active' :'' ?>">
		  <a href="#">
			<i class="fa fa-comments"></i> <span>Users</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		  </a>
		  <ul class="treeview-menu">
			<li class="<?php echo (!empty(Request::path()) && (Request::path() =='ticket/view') )?'active' :'' ?>">
			  <a href="{{url('ticket/view')}}">
			  <i class="fa  fa-plus-square"></i> <span>All User</span>
			  </a>
			</li>
		  </ul>
		</li>
	@endif
	<!--End of HR Role Menu-->

	<!--these menu for developer Role-->
	@if(isset($all_role->role) && strtolower($all_role->role)=="developer")
			<li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='ticket/view') || (Request::path() =='ticket/view'))?'active' :'' ?>">
		  <a href="#">
			<i class="fa fa-comments"></i> <span>Project</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		  </a>
		  <ul class="treeview-menu">
			<li class="<?php echo (!empty(Request::path()) && (Request::path() =='ticket/view') )?'active' :'' ?>">
			  <a href="{{url('ticket/view')}}">
			  <i class="fa  fa-plus-square"></i> <span>View Project</span>
			  </a>
			</li>
		  </ul>
		</li>
	@endif
	<!--End of developer Role Menu-->

	<!--these menu for Designer Role-->
	@if(isset($all_role->role) && strtolower($all_role->role)=="designer")
			<li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='add_evaluation_point') || (Request::path() =='view_evaluation_point'))?'active' :'' ?>">
		  <a href="#">
			<i class="fa fa-comments"></i> <span>Project</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		  </a>
		  <ul class="treeview-menu">
			<li class="<?php echo (!empty(Request::path()) && (Request::path() =='add_question') )?'active' :'' ?>">
			  <a href="{{url('/add_evaluation_point')}}">
			  <i class="fa  fa-plus-square"></i> <span>View Project</span>
			  </a>
			</li>
		  </ul>
		</li>
	@endif
	<!--End of Designer Role Menu-->

	<!--these menu for business analyst Role-->
	@if(isset($all_role->role) && strtolower($all_role->role)=="business analyst")
			<li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='add_evaluation_point') || (Request::path() =='view_evaluation_point'))?'active' :'' ?>">
		  <a href="#">
			<i class="fa fa-comments"></i> <span>Project</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		  </a>
		  <ul class="treeview-menu">
			<li class="<?php echo (!empty(Request::path()) && (Request::path() =='add_question') )?'active' :'' ?>">
			  <a href="{{url('/add_evaluation_point')}}">
			  <i class="fa  fa-plus-square"></i> <span>View Project</span>
			  </a>
			</li>
		  </ul>
		</li>
	@endif
	<!--End of business analyst Role Menu-->

            <li>
	            <a href='{{url("logout")}}'><i class="icon-key"></i> Log Out </a>
	        </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">


                 @yield('content')
     
        </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>



    <!-- sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

    <script src="{{asset('assets/dist/js/form-validation.js')}}"></script>

    <!-- jQuery UI 1.11.2 -->
    <script src="{{asset('assets/plugins/jQueryUI/jquery-ui-1.10.3.min.js')}}" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

     <!--this is for checkbox-->

    <script src="{{asset('assets/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script> 
    <!-- iCheck -->
    <!-- Slimscroll -->
    <script src="{{asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/app.min.js')}}" type="text/javascript"></script>


    <!-- custom js -->
    <script src="{{asset('assets/dist/js/custom.js')}}" type="text/javascript"></script>

 <!--form validation js-->
<script src="{{asset('assets/js/jQueryValidation.js')}}" type="text/javascript"></script>
 <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <!--sweet alert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.js"></script>
  </body>
</html>
