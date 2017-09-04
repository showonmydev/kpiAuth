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

class PointValueSettingController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_points(Request $request)
    {
        $data = DB::table('point_value_settings')->get();
        $id = "";

        if(!empty($request->id)){
            $id = $request->id;
            try {
				$get_data = DB::table('point_value_settings')->where('id',  $id)->get()->toArray();
				if(empty($get_data)){
				    $request->session()->flash('alert-danger', "No Records Founds");
				}            
            } catch(\Illuminate\Database\QueryException $ex){
                $request->session()->flash('alert-danger', $ex->getMessage());
            }
        }
        return view('point_value_settings.add_points', compact('id', 'data'));
    }

    public function points_post(Request $request)
    {
        $validator = \Validator::make($request->all(), [
        	'type'    => 'required',
            'values'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('add_points')
                        ->withErrors($validator)
                        ->withInput();
        }
            
        $input=Input::all();
        $get_data = DB::table('point_value_settings')->where('id', $input['type'])->get();

        if(count($get_data) == 0){

            $request->session()->flash('alert-danger', 'Role not exists. plz Connect to admin');
            return Redirect::route('add_points');   
        }

        if($input['value'] ==  $get_data[0]->value){

            $request->session()->flash('alert-success', 'Records are matched');
            return Redirect::route('add_points', ['id' => $input['selected_role']])->with('succes', 'Du har sendt en besked');
        }
        else {
            // Update an entry
            DB::table('point_value_settings')->where('id', $input['selected_role'])
                ->update( array('value' => $input['value'],
                				'created_at' => date('Y-m-d h:i:s'))
                		);
            $request->session()->flash('alert-success', 'Record updated successfully.');
        }     
        return \Redirect::route('view_points'); 
    }

    public function view_points()
    {
        $roles=\DB::table('point_value_settings')->get();
        return view('point_value_settings.view_points', compact('roles'));
    }

    public function delete_points(Request $request)
    {
        // Delete specific records
        $id = $request->id;
        \DB::table('point_value_settings')->where('id', $id)->update(array('points' =>  NULL, 'updated_at' => date('Y-m-d h:i:s')));
        $request->session()->flash('alert-success', 'Record updated successfully.');
        $roles=\DB::table('point_value_settings')->get();
        return \Redirect::route('view_points');
    }
}