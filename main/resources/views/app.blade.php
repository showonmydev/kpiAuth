<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>KPI | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
   <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />  
    <!-- FontAwesome 4.3.0 -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="{{asset('assets/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href=" {{asset('assets/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{asset('assets/plugins/iCheck/flat/blue.css')}}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{asset('assets/plugins/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="{{asset('assets/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" />

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
              <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="{{url('/home')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
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

            <li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='add_role') || (Request::path() =='view_role') )?'active' :'' ?>">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Role Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='add_role') )?'active' :'' ?>">
                  <a href="{{url('/add_role')}}">
                    <i class="fa fa-dashboard"></i> <span>Add Role</span>
                  </a>
                </li>

                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='view_role') )?'active' :'' ?>">
                  <a href="{{url('/view_role')}}">
                    <i class="fa fa-eye"></i> <span>View Role</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="treeview <?php echo (!empty(Request::path()) && (Request::path() =='add_user') || (Request::path() =='view_user') )?'active' :'' ?>">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>User Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='add_user') )?'active' :'' ?>">
                  <a href="{{url('/add_user')}}">
                  <i class="fa fa-dashboard"></i> <span>Add User</span>
                  </a>
                </li>
                <li class="<?php echo (!empty(Request::path()) && (Request::path() =='view_user') )?'active' :'' ?>" >
                  <a href="{{url('/view_user')}}" class="active">
                    <i class="fa fa-users"></i> <span>View User</span>
                  </a>
                </li>
              </ul>
            </li>
            <!--register user end-->
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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

    <script src="js/form-validation.js"></script>

    <!-- jQuery UI 1.11.2 -->
    <script src="{{asset('assets/plugins/jQueryUI/jquery-ui-1.10.3.min.js')}}" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>    
    <!-- iCheck -->
    <!-- Slimscroll -->
    <script src="{{asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/app.min.js')}}" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
  </body>
</html>

<script type="text/javascript">
  $('.delete_user').click(function(){
    var id = $(this).attr('id');
    var url = "<?php echo base_path();?>";
    alert(url);
    /*$.ajax({
      url:"",
      success:function(data){

      }
    });*/
  });
</script>