<?php

use Illuminate\Database\Seeder;

class Branches extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           $Branches = [//Seeding the Tables Branches with data

	        ['BrancheNameAR'=>'المركز الرئيسي','BrancheNameEN'=>'Main Center'],
	        ['BrancheNameAR'=>'فرع الطالبات','BrancheNameEN'=>'Girls Branch'],
            ['BrancheNameAR'=>'فرع تعز','BrancheNameEN'=>'Tiza Branch'],
            ['BrancheNameAR'=>'فرع الحديدة','BrancheNameEN'=>'Hodedl Branch'],
            ['BrancheNameAR'=>'فرع عدن','BrancheNameEN'=>'Aden Branch'],
        ];

        DB::table('branches')->insert($Branches);
    }
}
