<?php

use Illuminate\Database\Seeder;

class Program extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Program = [//Seeding the Tables programs with data

	        ['ProgramName'=>'نظم معلومات','scientific_departments_id'=>'3','program_types_id'=>'2'],
	        ['ProgramName'=>'نظم معلومات أدارية','scientific_departments_id'=>'3','program_types_id'=>'2'],
	        ['ProgramName'=>'نظم معلومات محاسبية','scientific_departments_id'=>'3','program_types_id'=>'2'],
	        ['ProgramName'=>'نظم معلومات تسويقية','scientific_departments_id'=>'3','program_types_id'=>'2'],
	        ['ProgramName'=>'تجارة الكترونية','scientific_departments_id'=>'3','program_types_id'=>'2'],
	        ['ProgramName'=>'نظم معلومات جغرافية','scientific_departments_id'=>'3','program_types_id'=>'2'],
	        ['ProgramName'=>'دبلوم تقنية معلومات','scientific_departments_id'=>'2','program_types_id'=>'1'],
	        ['ProgramName'=>'تقنية معلومات انجليزية','scientific_departments_id'=>'2','program_types_id'=>'2'],
	        ['ProgramName'=>'جرافكس','scientific_departments_id'=>'2','program_types_id'=>'2'],
	        ['ProgramName'=>'شبكات','scientific_departments_id'=>'1','program_types_id'=>'2'],
			['ProgramName'=>'هندسة برمجيات','scientific_departments_id'=>'1','program_types_id'=>'2'],
			['ProgramName'=>'علوم حاسوب','scientific_departments_id'=>'1','program_types_id'=>'2'],

        ];

        DB::table('programs')->insert($Program);
    }
}
