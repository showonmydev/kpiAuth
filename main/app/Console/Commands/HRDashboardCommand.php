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
        $usersList = DB::table('users')->whereNotIn( 'role_id', [1, 2])->get(); 
        $hrList = DB::table('users')->where( 'role_id',  2)->pluck('id');
        $setting_id = DB::table('point_value_settings')
                        ->where('type', 'HR')
                        ->pluck('id');

        $now = Carbon::now();
        $year =  $now->year;
        $month =  $now->month;


        foreach ($hrList as $hr) {
            foreach ($usersList as $value) {
                $data = array();
                $data = array('settings_id' => $setting_id[0],
                                  'users_id' => $value->id,
                                  'revision_id' => $hr,
                                  'months' => $month,
                                  'year'=>$year,
                                  'created_at'=>date("Y-m-d h:i:s"));

                $user_exit = DB::table('evaluate_tickets')
                                ->where('settings_id' , $setting_id[0])
                                ->where('users_id' , $value->id)
                                ->where('revision_id' , $hr)
                                ->where('months' , $month)
                                ->where('year' , $year)
                                ->first();

                if (is_null($user_exit)) {

                    DB::table('evaluate_tickets')->insert($data);
                    $this->info('All  users are Inserted successfully!');
                } else {
                    $this->info('All  users are Already exit successfully!');
                }
            }
        }
    }
}