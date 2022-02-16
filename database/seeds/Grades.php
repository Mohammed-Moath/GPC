<?php

use Illuminate\Database\Seeder;

class Grades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Grades = [//Seeding the Tables Branches with data
            [   'DegreeOfAttendance'=>'5',
                'DegreeOfDelivery'=>'5',
                'DegreeOfSupervisor'=>'30',
                'DegreeOfMidtermDiscussion'=>'20',
                'DegreeOfFinalDiscussion'=>'40',
            ],
        ];

        DB::table('grades')->insert($Grades);
    }
}
