<?php

use Illuminate\Database\Seeder;

class Constraint extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constraint = [//Seeding the Tables Branches with data
            [   
                'Number_AddProposalStudent'=>'1', 
                'Number_AddProposalTeacher'=>'1',
                'Number_chooseWishes'=>'1',
                'Min_Number_StudentinGroup'=>'1', 
                'Max_Number_StudentinGroup'=>'1',
                'Max_Certified_Project_GroupB'=>'1',
                'Max_Certified_Project_GroupG'=>'1',
                //'Max_Supervisor_GroupsB'=>'1', 
                //'Max_Supervisor_GroupsG'=>'1',
            ],
        ];

        DB::table('constraints')->insert($constraint);
    }
}
