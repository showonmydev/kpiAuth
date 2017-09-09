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

class IPController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function ip_setting(Request $request){

        if($request->Input()){
           // print_r($request->Input());die;
            $ips =  $request->Input('ips');

            $ip_data=array(
                'ips'   => $ips
            );

            if(!empty($request->Input('id'))){

                $result=DB::table('ipsettings')
                ->where('id', $request->Input('id'))
                ->update($ip_data);
  
            }else{
                $result=DB::table('ipsettings')->insert($ip_data);
            }
    
            $request->session()->flash('alert-success', 'IP updated successfully.');
        }

        $ipsettings = DB::table('ipsettings')
        ->where('id', 1)
        ->get();
        
        return view('ipsetting.ip_settings',['ipsettings' => $ipsettings]);
    }
}
