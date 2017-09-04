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
					Edit Evaluation Point
                 
					@else
					Add Evaluation Point
					@endif
                  
				</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form class="question_form" name="question_submit_form">

					<!-- select -->
					<div class="form-group">
						<label for="question_for">Question For</label>
						<select class="form-control" id="question_for" name="question_for"  required>
							<option value="">Select Question For</option>
							@foreach($roles as $role)
							<option value="{{$role->id}}" {{ isset($data->role_id) && $data->role_id==$role->id ? 'selected':'' }}>{{$role->type}}</option>
							@endforeach
						</select>
					</div>
                    
					<div class="form-group">
						<label for="Question">Question</label>
						<textarea class="form-control" id="Question" name="Question" rows="3" placeholder="Enter Question" required>{{$data->question or ''}}</textarea>
					</div>
                    
					<div class="form-group">
						<label for="Suggestion">Suggestion</label>
						<textarea class="form-control" id="Suggestion" name="Suggestion" rows="3" placeholder="Enter Question Suggestion" required>{{$data->question_suggestion or ''}}</textarea>
					</div>
                    
					<!-- select -->
					<div class="form-group">
						<label for="Status">Status</label>
						<select class="form-control" name="Status" id="Status" required>
							<option value="">Select Status</option>
							<option value="enable" {{ isset($data->status) && $data->status=="Active" ? 'selected':'' }}>Active</option>
							<option value="disable" {{ isset($data->status) && $data->status=="Deactive" ? 'selected':'' }}>Deactive</option>
						</select>
					</div>
                    
					<!--submit-->
					<div class="form-group">
						@if(isset($data->id))
						<input type="hidden" name="id" value="{{$data->id}}">
						<button class="btn btn-success text-center add_question_update">Update</button>				@else
						<button class="btn btn-success text-center add_question_submit">Submit</button>
						@endif
					</div>
				</form>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!--/.col (right) -->
</div>
</div>
<!-- jQuery 2.1.3 -->
<script src="{{asset('assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
    
<!--Ajax request js-->
<script src="{{asset('assets/js/admin_level.js')}}" type="text/javascript"></script>      
@endsection