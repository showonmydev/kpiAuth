<style>
	.box > .icon { 
		text-align: center; 
		position: relative; }
	.box > .icon > .image { 
		position: relative; 
		z-index: 2; 
		margin: auto; 
		width: 88px; 
		height: 88px; 
		border: 8px solid white; 
		line-height: 88px; 
		border-radius: 50%; 
		background: #63B76C; 
		vertical-align: middle; }
	.box > .icon:hover > .image { 
		background: #333; }
	.box > .icon > .image > i { 
		font-size: 36px !important; 
		color: #fff !important; 
		margin-top: 15px; }
	.box > .icon:hover > .image > i { 
		color: white !important; }
	.box > .icon > .info { 
		margin-top: -24px; 
		background: rgba(0, 0, 0, 0.04); 
		border: 1px solid #e0e0e0; 
		padding: 15px 0 10px 0; }
	.box > .icon:hover > .info { 
		background: rgba(0, 0, 0, 0.04); 
		border-color: #e0e0e0; 
		color: white; }
	.box > .icon > .info > h3.title { 
		font-family: "Roboto",sans-serif !important; 
		font-size: 16px; 
		color: #222; 
		font-weight: 500; }
	.box > .icon > .info > p { 
		font-family: "Roboto",sans-serif !important; 
		font-size: 13px; 
		color: #666; 
		line-height: 1.5em; 
		margin: 20px;}
	.box > .icon:hover > .info > h3.title, .box > .icon:hover > .info > p, .box > .icon:hover > .info > .more > a { 
		color: #222; }
	.box > .icon > .info > .more a { 
		font-family: "Roboto",sans-serif !important; 
		font-size: 12px; 
		color: #222; 
		line-height: 12px; 
		text-transform: uppercase; 
		text-decoration: none; }
	.box > .icon:hover > .info > .more > a { 
		color: #fff; 
		padding: 6px 8px; 
		background-color: #63B76C; }
	.box .space { 
		height: 30px; }

	#collapse1 ul{
		list-style-type: none;
	}

	#collapse1 ul li{
		margin-bottom: 5px;
	}
</style>
@extends('layouts/mainapp')
@section('content')
<!-- Main content -->
     
        
<!--this is ticket-->
@php($check="0")
@foreach($project_count as $id)
@php($check="1")
<div class="col-md-12 product_content all_comment{{$id->project_id}}">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse1{{$id->project_id}}">{{$id->project_name}}</a>
				</h4>
			</div>

			<div id="collapse1{{$id->project_id}}" class="panel-collapse collapse in">
				@foreach($ticket as $row)
				@if($row->project_id==$id->project_id)
				<div class="col-xs-8 col-sm-4 col-lg-3">
					<div class="box">							
						<div class="icon">
							<div class="image"><i class="fa fa-user"></i></div>
							<div class="info">
								<h3 class="title">{{$row->name or ''}}</h3>
								<p>
									Month : {{date('F', mktime(0, 0, 0, $row->months, 10))}} <br>
									Year : {{$row->year or ''}}
								</p>
								<div class="more">
									<a href="" onclick="add_comment('{{$row->id}}','{{$row->revision_id}}','{{$row->project_id}}','{{$row->settings_id}}','{{url('get_comment')}}','{{auth()->user()->name}}')"><i class="fa fa-eye"></i>&nbspView</a>
									<a href="" id="show" data-toggle="modal" data-target="#product_view" style="display:none"></a>
									<!--data-toggle="modal" data-target="#product_view"-->
								</div>
							</div>
						</div>
					</div> 
				</div>
		

				<!--end of ticket-->
				@endif
				@endforeach								
			</div>								
		</div>
	</div>
</div>
@endforeach
	

<!--here ticket generated for HR-->
@if($check==0)
@foreach($ticket as $row)
<div class="col-xs-8 col-sm-4 col-lg-3">
	<div class="box">							
		<div class="icon">
			<div class="image"><i class="fa fa-user"></i></div>
			<div class="info">
				<h3 class="title">{{$row->name or ''}}</h3>
				<p>
					Month : {{date('F', mktime(0, 0, 0, $row->months, 10))}} <br>
					Year : {{$row->year or ''}}
				</p>
				<div class="more">
					<a href="" onclick="add_comment('{{$row->id}}','{{$row->revision_id}}','{{$row->project_id}}','{{$row->settings_id}}','{{url('get_comment')}}','{{auth()->user()->name}}')"><i class="fa fa-eye"></i>&nbspView</a>
					<a href="" id="show" data-toggle="modal" data-target="#product_view" style="display:none"></a>
					<!--data-toggle="modal" data-target="#product_view"-->
				</div>
			</div>
		</div>
	</div> 
</div>
@endforeach
@endif

<!--End of code HR-->

<!--here is start model-->
<div class="modal fade product_view" id="product_view">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
				<h3 class="modal-title">User Review</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<!--here is evaluation question-->
					<div class="col-md-12 product_content all_comment">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collapse1">View All Comments</a>
									</h4>
								</div>
								<div id="collapse1" class="panel-collapse collapse">
									<ul id="comment_message" style="height: 200px;overflow-y: auto;">
							      	
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--end of evaluation question-->
					
					
					
					<div class="col-md-12 product_content final_comment">
						<!--here is all comments-->
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" id="final_comment" href="#collapse2">View All Questions</a>
									</h4>
								</div>
								<div id="collapse2" class="panel-collapse collapse in">
									<form style="margin-top:10px;" id="final_submit">
										<div id="path3" class="hide">{{url('add_final_submit')}}</div>
										<ul id="question_message" style="height: 150px;overflow-y: auto;">
							      	
										</ul>
										<div class="col-md-12">
											<label>Comment</label>
											<textarea class="form-control" name="comments" required ></textarea><br>
											
										</div>
										<center><input type="submit" id="final_question_submit" class="btn btn-primary"></center>
									</form>
								</div>
							</div>
						</div>	
						<!--end of comments-->
					</div>
					
					
					
					<div class="col-md-12 log_comment_box">
						<!--here is submit comments-->
						<form id="comment_form">
							<div class="form-group">
								<!--here is all hidden field-->
								<div id="formhidden_field">
		                    			
								</div>
								<div id="path" class="hide">{{url('add_comment')}}</div>
								<div id="path_redirect" class="hide">{{url('get_comment')}}</div>
								<!--end of hidden field-->
								<label>Comment</label>
								<textarea class="form-control" name="comments" required></textarea>
							</div>
							<div class="form-group">
								<input type="submit" id="post_comment" class="btn btn-primary">
							</div>
						</form>
						<!--end of submit comments-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
<!--end of model-->
<!-- /.content -->
<!-- jQuery 2.1.3 -->
<script src="{{asset('assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
    
<!--Ajax request js-->
<script src="{{asset('assets/js/admin_level.js')}}" type="text/javascript"></script>
@endsection