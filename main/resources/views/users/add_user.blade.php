@extends('layouts/mainapp')
@section('content')

 <!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <!-- Horizontal Form -->
         <div class="box box-info">
            <div class="box-header with-border">
               @if(isset($users->name))
               <h3 class="box-title">Edit User</h3>
               @else
               <h3 class="box-title">Add User</h3>
               @endif
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
            <form class="form-horizontal" name="add_user" action="add_user" method="post">

               <div class="box-body">
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
                     <div class="col-sm-10">

                        <input type="hidden" name="id" value="{{$users[0]->id or ''}}" >

                        <input type="text" class="form-control" id="inputEmail3" placeholder="User Name" name="username" value="{{$users[0]->name or ''}}" >

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     </div>
                  </div>
                  
                  <?php if(!empty($users[0]->name)){ }else{?>

                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                     <div class="col-sm-10">
                        <input type="password" class="form-control"  placeholder="Password" name="password" >
                     </div>
                  </div>

                  <?php }?>
                  

                  
                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                     <div class="col-sm-10">
                        <input type="email" class="form-control"  placeholder="Email" name="email" value="{{$users[0]->email or ''}}" >
                     </div>
                  </div>
                    

                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Role</label>

                     <?php 
                     foreach($roles as $key => $value){?>
                     <div class="col-sm-2"> 
                        <div class="form-group">
                          <label>
                            <input type="radio" name="role" class="flat-red" value="<?php echo $value->id; ?>" <?php if(!empty($users[0]->role_id)){  if($value->id == $users[0]->role_id){echo "checked";} } ?>  ><?php echo $value->role; ?> 
                            
                          </label>
                        </div>    
                     </div>
                     <?php }?>
                  </div>
               </div>
               <!-- /.box-body -->
               <div class="box-footer" style="height: 50px;">
                  @if(isset($users->name))
                  <button type="submit" class="btn btn-info pull-right">Update</button>
                  @else
                  <button type="submit" class="btn btn-info pull-right">Submit</button>
                  @endif
                  
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

