<?php

use Illuminate\Database\Seeder;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $UserRole = [ //Seeding the user's authority table with data

	        ['UserRoleEn'=>'Administrator','UserRoleAr'=>'مدير النظام'],
	        ['UserRoleEn'=>'Project_Committee','UserRoleAr'=>'لجنة المشاريع'],//Shortcut for the authority of the official of the graduation projects committee "GPCO"
	        ['UserRoleEn'=>'Student','UserRoleAr'=>'الطلاب'],
	        ['UserRoleEn'=>'Faculty_Member','UserRoleAr'=>'هيئة تدريس'],
	        ['UserRoleEn'=> 'Guest','UserRoleAr'=>'زائر']

        ];

        DB::table('user_roles')->insert($UserRole);
    }
}
