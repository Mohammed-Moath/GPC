<?php

use Illuminate\Database\Seeder;

class ScientificDepartments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ScientificDepartments = [//Seeding the scientific sections with data

	        ['DepartmentName'=>'علوم حاسوب'],
	        ['DepartmentName'=>'تقنية معلومات'],
	        ['DepartmentName'=>'نظم معلومات']
	        

        ];

        DB::table('scientific_departments')->insert($ScientificDepartments);
    }
}
