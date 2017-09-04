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

class EvaluationPointController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct(){
		$this->middleware('auth');
	}
    
	function prepare_que_add(){
		$roles = DB::table('point_value_settings')->get();
		return view('evaluation_points.add_evaluation_point',['roles'=>$roles]);	
	}
    
	function delete_evaluation_point($id){
		$result = DB::table('evaluation_points')->where('id', '=', $id)->delete();
		if($result){
			return 1;
		}else{
			return false;
		}
	} 
	
	function edit_evaluation_points($id){
		$roles = DB::table('roles')->get();
		$data = DB::table('evaluation_points')->where('id', $id)->first();
		return view('evaluation_points.add_evaluation_point', compact('data' , 'roles'));
	}
    
    
	function view_evaluation_points(Request $request){
		$result = DB::table('evaluation_points')
			->join('roles', 'roles.id', '=', 'evaluation_points.settings_id')
            ->select('roles.role', 'evaluation_points.*')
            ->get();

		return view('evaluation_points.view_evaluation_point',['data' => $result]);
	}
	
	//this controller using for add evaluation_pointController
	public function add_evaluation_points(request $request){
		
		$validator = \Validator::make($request->all(), [
				'question_for'=>'required',
				'Question'=>'required',
				'Suggestion'=>'required',
				'Status'=>'required',
				//'client_comment'=>'required',
				//'business_analysis'=>'required'
			]);
        
		if($validator->fails()){
			return response()->json($validator->messages(), 500);
		}
        
		$role_id = $request->Input('question_for');
		$Question=$request->Input('Question');
		$Suggestion=$request->Input('Suggestion');
		$Status=$request->Input('Status');
		
		
		
		$data=array(
			'settings_id'   => $role_id,
			'text'=> $Question,
			'suggestion'=>$Suggestion,
			'status'=>$Status,
			//'user_id'=>$user = \Auth::user()->id,
			//'created_at'=>date("Y-m-d h:i:s"),
		);
    
		if($request->Input('id')){
			$result=DB::table('evaluation_points')
			->where('id', $request->Input('id'))
			->update($EvaluationPointController_data);
			return $result="update";
		}
		else{
			$result=DB::table('evaluation_points')->insert($data);	
		}
		if($result)
		return 1;
	}    
}
