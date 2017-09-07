<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class ProjectDeveloperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projectdeveloper:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Using project table update evaluate_tickets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function checkIfUserExits($data){
        $user_exit = DB::table('evaluate_tickets')
                        ->where($data)
                        ->first();

        if (is_null($user_exit)) {
            $data['created_at'] = date("Y-m-d h:i:s");
            DB::table('evaluate_tickets')->insert($data);
            $this->info('All  users are Inserted successfully!');
        } else {
            $this->info('All  users are Already exit successfully!');
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $projectList = DB::table('project')->where('status', '<>', 'closed')->get();
        $setting_id = DB::table('point_value_settings')
                        ->where('type', 'Project Developer')
                        ->pluck('id');
        $now = Carbon::now();
        $year =  $now->year;
        $month =  $now->month;

        foreach ($projectList as $value) {
            $data = array();
            $data = ['settings_id' => $setting_id[0],
                     'project_id' => $value->id,
                     'months' => $month,
                     'year' => $year
                     
                    ];
            $accountable =  preg_split("/[\s,]+/", $value->accountable);

            //Entry for Project Manager
            {
                $data['users_id'] = $value->responsible;
                $data['revision_id'] = $value->project_manager;                
                $this->checkIfUserExits($data);
            }

            //Entry for Responsible with Accountant
            //ToDo : if Responsible is Accountant  then skip entry
            $data['revision_id'] = $value->responsible;
            {
                foreach ($accountable as $key => $usersid) {            
                    $data['users_id'] = $usersid;
                    $this->checkIfUserExits($data);
                }
            }

            //Entry for Responsible with BA
            {
                $data['users_id'] = $value->business_analyst;
                $this->checkIfUserExits($data);
            }
        }
    }
}
