<?php

use Illuminate\Database\Seeder;

class TypeDeliver extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
           $TypeDeliver = [//Seeding the Tables TypeDeliver with data

	        ['TypeDeliverieName'=>'General Framework of the Project'],
	        ['TypeDeliverieName'=>'Analysis'],
	        ['TypeDeliverieName'=>'The Design'],
	        ['TypeDeliverieName'=>'Implementation'],
	        ['TypeDeliverieName'=>'Full project document'],
        ];

        DB::table('type_delivs')->insert($TypeDeliver);
    }
}
