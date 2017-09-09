<?php //print_r($roles);die; ?>
@extends('layouts/mainapp')
@section('content')

 <!-- Main content -->
<section class="content">

<div class="row">
	 <div class="col-md-12">
	    <!-- Horizontal Form -->
	    <div class="box box-info">
	       <div class="box-header with-border">
	       
	          <h3 class="box-title">Update IP Setting</h3>
	          	
	       </div>
	       <div class="flash-message">
			    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
			      @if(Session::has('alert-' . $msg))

			      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			      @endif
			    @endforeach
			  </div> <!-- end .flash-message -->
	       <!-- /.box-header -->
	       <!-- form start -->
	        @if (count($errors) > 0)
	             <div class = "alert alert-danger">
	                <ul>
	                   @foreach ($errors->all() as $error)
	                      <li>{{ $error }}</li>
	                   @endforeach
	                </ul>
	             </div>
	          @endif
	       <form class="form-horizontal" name="ip_setting" action="Ip-setting" method="post">

	          <div class="box-body">
	             <div class="form-group">
	                <label for="ips" class="col-sm-2 control-label">IP</label>
	                <div class="col-sm-10">
	                	<input type="hidden" name="id" value="{{$ipsettings[0]->id or ''}}" >
	                	<textarea name="ips" rows="10" cols="10" class="form-control" placeholder="IP" id="ips" value="{{$ipsettings[0]->ips or ''}}" >{{$ipsettings[0]->ips or ''}}</textarea>
	                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                </div>
	             </div>
	             
	          </div>
	          <!-- /.box-body -->
	          <div class="box-footer" style="height: 50px;">
	             <button type="submit" class="btn btn-info pull-right">Update</button>
	          </div>
	          <!-- /.box-footer -->
	       </form>
	    </div>
	    <!-- /.box -->
	    <!-- general form elements disabled -->
	    
	    <!-- /.box -->
	 </div>
</div>
</section>

<!-- /.content -->
@endsection
