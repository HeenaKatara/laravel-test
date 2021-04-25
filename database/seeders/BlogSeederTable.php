<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Auth;
use Faker\Factory as Faker;
use DB;

class BlogSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Blog');
        for($i = 1 ; $i <= 10 ; $i++){
	        DB::table('blogs')->insert([
	        	'title' => $faker->sentence(),
	        	'content' => $faker->paragraph(),
	        	'user_id' => 2,
	        	'created_at' => \Carbon\Carbon::now(),
	        	'Updated_at' => \Carbon\Carbon::now(),
	        ]);
        }
    }
}
