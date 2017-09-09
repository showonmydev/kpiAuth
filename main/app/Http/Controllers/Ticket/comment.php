<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class comment extends Controller
{
    //this is for getting all comment log
    function get_all_comment(request $request)
    {
		$comment = DB::table('evaluation_comments')
				  ->where('user_id',$request->id)
				  ->where('responsible_id',auth()->user()->role_id)
				  ->where('type','log')
				  ->get()->toArray();
				  
		$points = DB::table('evaluation_points')
				  ->where('settings_id',$request->setting_id)
				  ->where('status',1)
				  ->get()->toArray();
		
		$totalpoint=DB::table('point_value_settings')->where('id', $request->setting_id)->pluck('value');
		
		$status=DB::table('evaluate_tickets')->where('id', $request->id)->pluck('status');
		
		$data=array(
					'comment'=>$comment,
					'points'=>$points,
					'total_point'=>$totalpoint,
					'status'=>$status,
					);	  
		return json_encode($data);
	}
	
	//this is for submit log comment
	public function submit_comment(request $request)
	{
		$data=$request->all();
		$comment = DB::table('evaluation_comments')->insert($data);
		return $data;
	}
	
	//this is for submit final comment
	public function final_comment(request $request)
	{
		$data=array(
				'user_id'=>$request->user_id,
				'project_id'=>$request->project_id,
				'responsible_id'=>$request->responsible_id,
				'month'=>$request->month,
				'year'=>$request->year,
				'comments'=>$request->comments,
				'settings_id'=>$request->settings_id,
				'type'=>2,
				);
		$comment = DB::table('evaluation_comments')->insert($data);
		$insert_id=DB::getPdo()->lastInsertId();
		
		$result=0;
		$total=count($request->no);
		$each_no=$request->total_point/$total;
		
		foreach($request->no as $key=>$point)
		{
		    $total_Question_no=5;
			$total_get_user=$point;
			$get_percentage=($total_get_user*100)/$total_Question_no;
			
			//find out the current get number
			$acheived=($get_percentage*$each_no)/100;
		   
		    $data1=array(
						'comment_id'=>$insert_id,
						'point_id'=>$key,
						'point_value'=>$each_no,
						'acheived_value'=>$acheived,
					   );
					
			$result=DB::table('evaluation_ratings')->insert($data1);
		}
		
		if($result)
		{
			$ticket = DB::table('evaluate_tickets')
			->where('id',$request->user_id)
			->delete();
			return 1;
		}
		return 0;
	}
}
