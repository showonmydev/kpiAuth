@extends('layouts/mainapp')
@section('content')
<!-- Content Header (Page header) -->

<section class="content-header">
<section class="content">
   <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">View Points</h3>
          </div>
          <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
            @endforeach
          </div>
          <!-- end .flash-message -->
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
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-6"></div>
              <div class="col-sm-6"></div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                 <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                       <tr role="row">
                          <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Id</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Type</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Values</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Action</th>
                       </tr>
                    </thead>
                    <tbody>
                       @php ($i=1)
<!--If no data found print proper message and redirect add role page -->
                       @foreach ($roles as $role)
                       <tr role="row" class="odd">
                          <td class="sorting_1">{{ $i }}</td>
                          <td>{{ $role->type }}</td>
                          <td>{{ $role->value }}</td>
                          <td>
                             <a href="<?php echo url('/add_points/').'/'.$role->id;  ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
                             <a href="<?php echo url('/delete_points/').'/'.$role->id;  ?>"  class="delete_points" id="{{ $role->id }}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                             &nbsp;&nbsp;&nbsp;
                          </td>
                       </tr>
                       @php ($i++)
                       @endforeach
                    </tbody>
                 </table>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection
