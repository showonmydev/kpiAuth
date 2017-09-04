<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use Session;
use Redirect;
use DB;

class ProjectController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
    
	public function prepare_project_add()
	{

		$users =DB::table('users')->where('role_id', '!=' , 1)->get();
		$ba =DB::table('users')->where('role_id', '=' , 5)->get();

		return view('project/add_project',['users'=>$users,'ba' => $ba]);
	}
	
	//this is for deleting project data
	function delete_project($id)
	{
		$result = DB::table('project')->where('id', '=', $id)->delete();
		if($result){
			return 1;
		}else{
			return false;
		}
	} 
	
	function edit_project($id)
	{
		$users =DB::table('users')->where('role_id', '!=' , 1)->get();
		$result = DB::table('project')->where('id', $id)->first();
		$ba =DB::table('users')->where('role_id', '=' , 5)->get();
		return view('project.add_project',['data' => $result,'users'=>$users,'ba' => $ba]);
	}
    
    
    
	//this controler responsible for view all project
	function view_project(Request $request)
	{
		$result = DB::table('project')->get();
		$users = DB::table('users')->get();
		return view('project.view_project',['data' => $result,'users_key'=>$users]);
	}
	
	
	//this controler responsible for add project
	function add_project(Request $request)
	{
		$validator = \Validator::make($request->all(), [
				'project_name'=>'required',
				'client_name'=>'required',
				'client_name'=>'required',
				'project_manager'=>'required',
				'responsible'=>'required',
				'accountable'=>'required',
				'status'=>'required',
				//'client_comment'=>'required',
				//'business_analysis'=>'required'
			]);
        
		if($validator->fails())
		{
			return response()->json($validator->messages(), 500);
		}
        
		$project_name=$request->Input('project_name');
		$client_name=$request->Input('client_name');
		$project_manager=$request->Input('project_manager');
		$responsible=$request->Input('responsible');
		$accountable=json_encode($request->Input('accountable'));
		$status=$request->Input('status');
		$client_comment=$request->Input('client_comment');
		$business_analysis=$request->Input('ba');
		
		$project_data=array(
			'project_name'   => $project_name,
			'client_name'=> $client_name,
			'project_manager'=>$project_manager,
			'responsible'=>$responsible,
			'accountable'=>$accountable,
			'status'=>$status,
			'client_final_comment'=>$client_comment,
			'business_analyst'=>$business_analysis,
			'user_id' => $user =\Auth::user()->id,
			'created_at'=>date("Y-m-d h:i:s"),
		);


    
		if($request->Input('id'))
		{
			$result=DB::table('project')
			->where('id', $request->Input('id'))
			->update($project_data);
			return $result="update";
		}
		else{
			$result=DB::table('project')->insert($project_data);	
		}
		if($result)
		return 1;
	}
}