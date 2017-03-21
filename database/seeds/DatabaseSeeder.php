<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$password = "pass";

		DB::table('users')->delete();
		DB::table('rooms')->delete();
		DB::table('questions')->delete();
		
		DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);

		DB::table('rooms')->insert([
            'name' => 'Room 1',
            'password' => $password,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);
		DB::table('rooms')->insert([
            'name' => 'Room 2',
            'password' => $password,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);

		factory(App\Question::class, 15)->create();
    }
}
