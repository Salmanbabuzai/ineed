<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class postSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 50; $i++) { 
    		
    		DB::table('posts')->insert([
        		'post_title'=> 'I need '.Str::random(10).' with '.Str::random(5),
        		'user_id'=> rand(38, 39),
        		'post_details'=> 'I need '.Str::random(20).' with '.Str::random(20),
        		'post_category'=> "1",
        		'post_subcategory'=> "2",
        		'post_maxdays'=> "5",
        		'post_budget'=> rand(750, 99550),
        		'post_city'=> "City Name",
        		'post_pic1'=> "postDefault.jpg",
        	]);
    	}	
    }
}
