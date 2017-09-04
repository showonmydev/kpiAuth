@extends('../layouts/mainapp')
@section('content')
<!-- Main content -->
<section class="content">
<div class="row">
                  
</div>
<div class="row">
	<div class="col-sm-12">
		<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
			<thead>
				<tr role="row">
					<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Id</th>
					<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Role</th>
					<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Question</th>
					<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Suggestion</th>
					<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
					<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Action</th>
                  
				</tr>
			</thead>
			<tbody>
            
				<?php $i=1; ?>
				@foreach ($data as $users)
				<tr role="row" class="odd">
					<td class="sorting_1">{{$i}}</td>
					<td>{{$users->role}}</td>
					<td>{{$users->text}}</td>
					<td>{{$users->suggestion}}</td>
					<td>{{strtoupper($users->status)}}</td>
					<td>
						<a href="edit_evaluation_point/{{$users->id}};"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp&nbsp
						<a style="cursor:pointer" onclick="question_delete({{$users->id}});"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</td>
				</tr>
				<?php $i++; ?>
				@endforeach
               
			</tbody>
		</table>
	</div>
</div> 
</div>
</div>
<!-- /.content -->
<!-- jQuery 2.1.3 -->
<script src="{{asset('assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
<!--Ajax request js-->
<script src="{{asset('assets/js/admin_level.js')}}" type="text/javascript"></script>
@endsection