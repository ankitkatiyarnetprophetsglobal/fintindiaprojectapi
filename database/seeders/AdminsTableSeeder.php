<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->insert(array(
        	array(
				'name' => "Arun Kumar",
				'email' => 'arun.kumar@seqfast.com',
				'password' => Hash::make('Password@2k2k'),
        	),
        	array(
				'name' => "Sandeep Singh",
				'email' => "sandy@gmail.com",
				'password' => Hash::make('password'),
        	),
			array(
				'name' => "Ramesh Kumar",
				'email' => "ramesh.kumar@seqfast.com",
				'password' => Hash::make('Password@2k2k'),
        	),
			
			array(
				'name' => "Shubham Aggarwal",
				'email' => "it.fitindia@gmail.com",
				'password' => Hash::make('Password@2k2k'),
        	)
			
        ));

        
    }
}
