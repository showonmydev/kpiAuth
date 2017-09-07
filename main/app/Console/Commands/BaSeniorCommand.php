<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BaSeniorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'basenior:command';

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
        $baList = DB::table('users')->where('role_id', 5)->get();
        $setting_id = DB::table('point_value_settings')
                        ->where('type', 'BA Senior')
                        ->pluck('id');

        $now = Carbon::now();
        $year =  $now->year;
        $month =  $now->month;

        foreach ($baList as $key => $value) {
            $data = array();
            $data = ['settings_id' => $setting_id[0],
                     'users_id' => $value->id,
                     'revision_id' => $value->reporting_person,
                     'months' => $month,
                     'year'=>$year
                    ];
            $user_exit = DB::table('evaluate_tickets')->where($data)->first();

            if (is_null($user_exit)) {

                $data['created_at'] = date("Y-m-d h:i:s");
                DB::table('evaluate_tickets')->insert($data);
                $this->info('All  users are Inserted successfully!');
            } else {

                $this->info('All  users are Already exit successfully!');
            }

        }
    }
}
