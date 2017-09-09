@extends('../layouts/mainapp')
@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements disabled -->
			<div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title">
						@if(isset($data))
						Edit Project
						@else
						Add Project
						@endif
					</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<form class="add_project_form" name="project_submit_form">
						<!-- text input -->
						<div class="form-group">
							<label for="project_name">Project Name</label>
							<input type="text" name="project_name" id="project_name" class="form-control" placeholder="Enter Project Name" value="{{$data->project_name or ''}}" required/>
						</div>
						<div class="form-group">
							<label for="client_name">Client Name</label>
							<input type="text" name="client_name" id="client_name" class="form-control" placeholder="Enter Client Name" value="{{$data->client_name or ''}}" required/>
						</div>

						<!-- select -->
						<div class="form-group">
							<label for="project_manager">Project Manager</label>
							<select class="form-control" name="project_manager"  id="project_manager" required>
								<option value="">Select Project Manager</option>
								@foreach($users as $user)
								<option value="{{$user->id}}" {{ isset($data->project_manager) && $data->project_manager==$user->id ? 'selected':'' }}>{{$user->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="responsible">Responsible</label>
							<select class="form-control" id="responsible" name="responsible" required>
								<option value="">Select Responsible Person</option>
								@foreach($users as $user)
								<option value="{{$user->id}}" {{ isset($data->responsible) && $data->responsible==$user->id ? 'selected':'' }}>{{$user->name}}</option>
								@endforeach
							</select>
						</div>

						<!-- Select multiple-->
						<div class="form-group">
							<label for="accountable">Accountable</label>
							<select multiple class="form-control" id="accountable" name="accountable[]" required>
								<?php 
								if(isset($data))
								{
									$a=$data->accountable;
									$a=explode(",", $a);
								}
								?>
								@foreach($users as $user)
								<option value="{{$user->id}}"
									@if(isset($a))
									@foreach($a as $check)
									{{ isset($check) && $check==$user->id ? 'selected':'' }}
									@endforeach
									@endif
									>{{$user->name}}</option>
								@endforeach
							</select>
						</div>
                    
						<!--select-->
						<div class="form-group">
							<label for="status">Status</label>
							<select class="form-control" name="status" id="status" required>
								<option value="">Select Status</option>
								<option value="Open" {{ isset($data->status) && $data->status=="open" ? 'selected':'' }}>Open</option>
								<option value="Close" {{ isset($data->status) && $data->status=="close" ? 'selected':'' }}>Close</option>
								<option value="Hold" {{ isset($data->status) && $data->status=="hold" ? 'selected':'' }}>Hold</option>
							</select>
						</div>
					
						<div class="form-group">
							<label for="client_comment">Client Comment</label>
							<textarea class="form-control" id="client_comment" name="client_comment" rows="3" placeholder="Enter Client Comment">{{$data->client_comment or ''}}</textarea>
						</div>
                    
						<div class="form-group">
							<label for="business_analysis">Business analysis</label>
							
							<select class="form-control" id="business_analysis" name="business_analysis" required>
								<option value="">Select business_analysis</option>
								@foreach($users as $user)
								<option value="{{$user->id}}" {{ isset($data->business_analysis) && $data->business_analysis==$user->id ? 'selected':'' }}>{{$user->name}}</option>
								@endforeach
							</select>
						</div>
					
						<!--submit-->
						<div class="form-group">
							@if(isset($data->id))
							<input type="hidden" name="id" value="{{$data->id}}">
							<button class="btn btn-success text-center project_update">Update</button>				@else
							<button class="btn btn-success text-center project_submit">Submit</button>
							@endif
						</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.col (right) -->
	</div>
</section>
<!-- jQuery 2.1.3 -->
<script src="{{asset('assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
    
<!--Ajax request js-->
<script src="{{asset('assets/js/admin_level.js')}}" type="text/javascript"></script>
        
<!-- /.content -->
@endsection