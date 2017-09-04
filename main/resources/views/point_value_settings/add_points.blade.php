@extends('layouts/mainapp')
@section('content')

<!-- Main content -->
<?php 
	

?>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">
                    @if(!empty($id))
                        Edit Point Value Setting
                    @else
                        Add Point Value Setting
                    @endif
                </h3>
            </div>
            <!-- /.box-header -->
            
            <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
            </div>
            <!-- end .flash-message -->

            @if (count($errors) > 0)
            <div class = "alert alert-danger">
               <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            <div class="box-body">
                <form  name="add_points" action="points_post" method="post" id="add_points">
                    <!-- select -->
                    <div class="form-group">
                        <label>Type Name</label>
                        <select class="form-control" name="selected_role" id="type" required>
                           <option value=""> None </option>
                           @foreach($data as $role)
                           <option value="{{$role->id}}" {{$role->type == $id ? "selected" : ''}}>
                           {{$role->type}}</option>
                           @endforeach
                        </select>
                    </div>
                    <!-- text input -->   
                    <div class="form-group">
                        <label>Values</label>
                        <input type="number" id="value" name="value" class="form-control values" placeholder="Enter Values" value="{{$id or ''}}" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    <div class="box-footer" style="height: 50px;">
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
         </div>
        <!-- /.box -->
      </div>
   </div>
</section>
<!-- /.content -->
@endsection