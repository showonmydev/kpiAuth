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
	       		<?php if(!empty($roles[0]->role)){ ?>
	          <h3 class="box-title">Edit Role</h3>
	          	<?php }else{ ?>
	          	<h3 class="box-title">Add Role</h3>
	          	<?php }?>
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
	       <form class="form-horizontal" name="add_role" action="add_role_post" method="post" id="add_role">

	          <div class="box-body">
	             <div class="form-group">
	                <label for="inputEmail3" class="col-sm-2 control-label">Role</label>
	                <div class="col-sm-10">

	                	<input type="hidden" name="id" value="{{$roles[0]->id or ''}}" >

	                   <input type="text" class="form-control" id="inputEmail3" placeholder="Role" name="role" value="{{$roles[0]->role or ''}}" >

	                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                </div>
	             </div>
	             
	          </div>
	          <!-- /.box-body -->
	          <div class="box-footer" style="height: 50px;">
	             
	             <button type="submit" class="btn btn-info pull-right">Submit</button>
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
