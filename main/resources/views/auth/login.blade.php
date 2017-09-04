<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>KPI | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
   <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    
    <link href="{{asset('assets/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>KPI Login</b>
      </div><!-- /.login-logo -->
      @if(session()->has('message.level'))
	    <div class="alert alert-{{ session('message.level') }}"> 
	    {!! session('message.content') !!}
	    </div>
	  @endif
      @if(count($errors))
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
	  @endif
      <div class="login-box-body">
        <!--<p class="login-box-msg">Sign in to start your session</p>-->
        <form class="form-horizontal login-form" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group has-feedback">
            {!! Form::text('email',null,array('class'=>'form-control','placeholder'=>'Username','required'=>'required'))!!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            {!! Form::password('password',array('class'=>'form-control','placeholder'=>'Password','required'=>'required'))!!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
            {!! Form::submit('Login',array('class'=>'btn btn-primary btn-block btn-flat'))!!}
             
            </div><!-- /.col -->
          </div>
        {!! Form::close() !!}
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    
    <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
  </body>
</html>