<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Ticket extends Controller
{
    //this is for generation ticket
    public function get_ticket(request $request)
    {
    	
		if(isset($request))
		{
			$ticket = DB::table('evaluate_tickets')
			->where('revision_id',auth()->user()->role_id)
			->where(function($query)
			        {
			            $query->where('status', '=', 'enable')
			                  ->orWhere('months', '=', date("m"));
			        })
            ->join('users', 'evaluate_tickets.users_id', '=', 'users.id')
            ->select('evaluate_tickets.*', 'users.name')
            ->get();
            
            
            //this is for project wise Ticket Generation
            $no_of_project = DB::table('evaluate_tickets')
            				->where('revision_id',auth()->user()->role_id)
            				->groupBY('evaluate_tickets.project_id')
            				->join('project', 'evaluate_tickets.project_id', '=', 'project.id')
            				->select('evaluate_tickets.project_id','project.project_name')
            				->get();
            
			//return View with data
			return view('ticket.view_ticket',['ticket'=>$ticket,'project_count'=>$no_of_project]);
		}
	}
	
	
}
