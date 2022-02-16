<?php

use Illuminate\Database\Seeder;

class ScientificDegrees extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $ScientificDegrees = [//Seeding the Tables Scientific_Degrees with data

            ['scientific_degrees'=>'بكالوريوس','name'=>'معيد','code'=>'أ.'],
            ['scientific_degrees'=>'ماجستير','name'=>'مدرس مساعد','code'=>'أ.'],
            ['scientific_degrees'=>'دكتور','name'=>'أستاذ مساعد','code'=>'د.'],
	      
        ];

        DB::table('scientific_degrees')->insert($ScientificDegrees);
    }
}
