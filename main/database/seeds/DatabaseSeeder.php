<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        DB::table('users')->insert([
        [ 
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id'=>1,
            'reporting_person'=>0,
        ],[
            'name' => 'Shubham',
            'email' => 'shubham@gmail.com',
            'password' => bcrypt('test123'),
            'role_id'=>0,
            'reporting_person'=>0,
        ],[
            'name' => 'Divya',
            'email' => 'divya@gmail.com',
            'password' => bcrypt('test123'),
            'role_id'=>0,
            'reporting_person'=>0,
        ],[
            'name' => 'Rinkesh',
            'email' => 'rinkesh@gmail.com',
            'password' => bcrypt('test123'),
            'role_id'=>0,
            'reporting_person'=>0,
          ] 
        ]);
        
        DB::table('roles')->insert([
        [
            'role' => 'Admin',
        ],
        [
            'role' => 'HR',
        ],
        [
            'role' => 'Developer',
        ],
        [
            'role' => 'Designer',
        ],
        [
            'role' => 'Business Analyst',
        ],
        [
            'role' => 'Tester',
        ]    
        ]);
        
        DB::table('point_value_settings')->insert([
        [
            'type'   => 'HR',
            'value' => 20,
        ],
        [
            'type' => 'Project Developer',
            'value' => 80,
        ],
        [
            'type' => 'Project KT',
            'value' => 30,
        ],
        [
            'type' => 'BA Senior',
            'value' => 50,
        ]    
        ]);
    }
}
