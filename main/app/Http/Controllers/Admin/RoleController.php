<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use Session;
use Redirect;
use DB;;


class RoleController extends Controller{

	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Http\Response
	*/
	public function add_role(Request $request)
	{     
		if(!empty($request->id)){
			$id = $request->id;
			$roles = DB::table('roles')->where('id', $id)->get();
			return view('roles.add_role', ['roles'=>$roles]);
		}  
		return view('roles.add_role');        
	}

	public function add_role_post(Request $request){
		if($request){
			$validator = \Validator::make($request->all(), [
					'role'  =>'required',
				]);

			if($validator->fails()){
				return redirect('add_role')
				->withErrors($validator)
				->withInput();
			}
			$input=Input::all();
			$roles = '';
			if(empty($input['id'])){
             
				$roles_check=\DB::table('roles')->where('role', '=', $input['role'])->get();
				if(count($roles_check) > 0){
					$request->session()->flash('alert-danger', 'Role already exists.');         
					return \Redirect::route('add_role');    
				}                
				$roles=array(
					'role'       => trim($input['role']),
					'created_at' => date('Y-m-d h:i:s'),					
				);                        
				$users = DB::table('roles')->insert($roles);
				$request->session()->flash('alert-success', 'Record inserted successfully');
			}else{
             
				$roles_check=\DB::table('roles')->where('role', $input['role'])->get();

				if(count($roles_check) > 0){
					$request->session()->flash('alert-danger', 'Role already exists.');
					return Redirect::action('RoleController@add_role',$input['id']);
				}             
				// Update an entry
				\DB::table('roles')->where('id', $input['id'])
				->update(array('role' => $input['role'],'created_at' => date('Y-m-d h:i:s')));
				$request->session()->flash('alert-success', 'Record updated successfully.');
			}
			return \Redirect::route('view_role');
		}
	}    

	public function view_role(){
		$roles=\DB::table('roles')->get();
		return view('roles.view_role',['roles'=>$roles]);
	}

	public function delete_record(Request $request){
		// Delete specific records
		$id = $request->id;
		\DB::table('roles')->where('id', $id)->delete();
	}
}