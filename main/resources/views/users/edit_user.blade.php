@extends('layouts/mainapp')
@section('content')

 <!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <!-- Horizontal Form -->
         <div class="box box-info">
            <div class="box-header with-border">
               <h3 class="box-title">Edit User</h3>
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

             <form class="form-horizontal" name="edit_role" action="/kpiAuth/edit_user" method="post">
             
            <form class="form-horizontal" name="edit_user" action="" method="post">

               <div class="box-body">
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="User Name" name="username" value="<?php echo $users[0]->name; ?>" >

                        <input type="hidden" name="id" value="<?php echo $users[0]->id; ?>" >

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                     <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password" >
                     </div>
                  </div> -->
                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                     <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputPassword3" placeholder="Email" name="email" value="{{$users[0]->email}}"  >
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Role</label>
                     <?php foreach($roles as $key => $value){?>
                     <div class="col-sm-10">
                        <input type="checkbox" name="roles[]" value="<?php echo $value->id; ?>"  <?php if($users[0]->role == $value->id){echo "checked";} ?> ><?php echo $value->role; ?><br>
                     </div>
                     <?php }?>
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
   <!-- /.row -->
</section> 
<!-- /.content -->
@endsection

