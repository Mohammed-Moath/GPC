<?php

use Illuminate\Database\Seeder;

class ProgramType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $Program = [//Seeding the Tables programs type with data

            ['name'=>'دبلوم'],
            ['name'=>'بكالوريوس'],
        
        ];

        DB::table('program_types')->insert($Program);
    }
}
