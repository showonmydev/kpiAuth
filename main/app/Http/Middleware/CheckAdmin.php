<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class CheckAdmin{
	/**
	* Handle an incoming request.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \Closure  $next
	* @return mixed
	*/
	public function handle($request, Closure $next, $guard = null){
		if($this->check()){
			return $next($request);
		}        
		return redirect('/error');
	}    
    
	//check user role
	public function check(){
		$userrole=\Auth::user()->role_id;
		$user_arr=explode(",",$userrole);
		foreach($user_arr as $role){
			$task = DB::table('roles')->find($role);
			if(isset($task)){
				if(strtolower($task->role)=="admin"){
					return true;
				}
			}
		}
		return false;
	}
}
