<?php

use Illuminate\Database\Seeder;

class ProjectCalendars extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $ProjectCalendars = [//Seeding the Tables Branches with data

	    
			['AcademicYear'=>'2018-2017',
			 'Semester'=>'الأول',
             'SubmissionProposals'=>'1/1/2017 4:49 PM',
             'Number_AddProposalStudent'=>'2',
			 'Number_AddProposalTeacher'=>'3',
			 'createGroup'=>'1/1/2017 4:49 PM',
			 'ChooseWishes'=>'1/1/2017 4:49 PM',
			 'Number_chooseWishes'=>'3',
			 'Number_StudentinGroup'=>'3',
             'Min_Number_StudentinGroup'=>'2',
             'Max_Certified_Project_GroupB'=>'1',
             'Max_Certified_Project_GroupG'=>'1',
             'Max_Supervisor_GroupsB'=>'1',
			 'Max_Supervisor_GroupsG'=>'1',
			],
        ];

        DB::table('project_calendars')->insert($ProjectCalendars);
    }
}
