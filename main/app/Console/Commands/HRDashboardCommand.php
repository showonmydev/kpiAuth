<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Model;
use DB;

class HRDashboardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hrdashboard:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //List of users except role type is admin and HR
        $usersList = DB::table('users')->where('role_id', '<>', 1)->get();
        $hr_setting_id = DB::table('point_value_settings')
                        ->where('type', 'HR')
                        ->pluck('id');

        $now = Carbon::now();
        $year =  $now->year;
        $month =  $now->month;
        foreach ($hr_setting_id  as $hr_id) {

            foreach ($usersList as $value) {
            $data = array();
            $data = array('settings_id' => $hr_id, 
                              'users_id' => $value->id, 
                              'revision_id' => 2,
                              'months' => $month,
                              'year'=>$year,
                              'created_at'=>date("Y-m-d h:i:s"));
            DB::table('evaluate_tickets')->insert($data);
            }
        }    

        $this->info('All  users are Inserted successfully!');
    }
}
