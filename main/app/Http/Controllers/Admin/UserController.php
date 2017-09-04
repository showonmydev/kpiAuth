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

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function postLogin(Request $request){
     
		$validator = \Validator::make($request->all(), [
		   'email'    => 'required|email',
		   'password' => 'required|min:8',
		]);

        if ($validator->fails()) {
            return  redirect('login')
                    ->withErrors($validator)
                    ->withInput();
        }

        $input=Input::all();

        $login = array(
                    'email'    => $input['email'],
                    'password' => md5($input['password'])
                );
        $users = DB::table('users')->where($login)->get();
        if(count($users)>0){
            return Redirect::route('dashboard');
        }
        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', 'Invalid Credentials!');
        return Redirect::route('login');
    }
      
    public function logout()
    {
		Session::flush();
		return Redirect::route('login');
    }

    public function add_user(Request $request){
        $roles=DB::table('roles')->orderBy('created_at', 'asc')->get();
        if(!empty($request->id)){
            $id = $request->id;
            $users = DB::table('users')->where('id', '=', $id)->get(); 
            return view('users.add_user',['users' => $users,'roles' => $roles]); 
        }
        return view('users.add_user',['roles'=>$roles]);
    }

    public function add_user_post(Request $request){
        if($request){
            $validator = \Validator::make($request->all(), [
               'username'=>'required',              
               'email'=>'required|email'  
            ]);
            if ($validator->fails()) {
                return redirect('add_user')
                        ->withErrors($validator)
                        ->withInput();
            }

            $input=Input::all();
            $role = '';
            if(!empty($input['roles'])){
                foreach ($input['roles'] as $key => $value) {
                    $role .= $value.',';   
                }
                $role = rtrim($role,',');
                $role = !empty($role)?$role:'';    
            }

            if(empty($input['id'])){
    
    $check_email=DB::table('users')->where('email', '=', $input['email'])->get();
             if(count($check_email) > 0){
                 $request->session()->flash('alert-danger', 'Email id already exists.');
         
                 return Redirect::action('userController@add_user');    
             }
            
                $user=array(
                    'name'      => $input['username'],
                    'password'  => bcrypt($input['password']),
                    'email'     => $input['email'],
                    'role'      => $role,
                    'reporting_person' => '',
                        );
                
                $users = DB::table('users')->insert($user);
                $request->session()->flash('alert-success', 'Record inserted successfully.');
            }else{

				$check_email = DB::table('users')
							->where([['id', '!=', $input['id']],
										 ['email', '=', $input['email']],
									])->get();

				if(count($check_email) > 0){
					$request->session()->flash('alert-danger', 'Email id already exists.');
					return Redirect::action('userController@add_user',$input['id']);  
				}
            
                $user=array(
                'name'      => $input['username'],
                'email'     => $input['email'],
                'role'      => $role,
                'reporting_person' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
                    );
            
                $users=\DB::table('users')->where('id', $input['id'])
                    ->update($user);

                $request->session()->flash('alert-success', 'Record updated successfully.');   
            }
            
            return \Redirect::route('view_user');
        } 
    }

    public function view_user(){
        $users=\DB::table('users')->get();
        return view('users.view_users',['users'=>$users]);
    }

    public function delete_record(Request $request){
        // Delete specific records
        $id = $request->id;
        DB::table('users')->where('id', $id)->delete();
    }
}