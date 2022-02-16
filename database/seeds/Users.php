<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $Users = [ //Seeding the user's  table with data

	        ['Name'=>'محمد معاذ أحمد سعيد','username'=>'مدير النظام','Gender'=>'ذكر','password'=>bcrypt("123456789"),'PhoneNumber'=>'737166320','Email'=>'m.muath1994@gmail.com','PresonalPicture'=>'uploads\user.png','Roles'=>'1','IsActive'=>'1'],
            ['Name'=>'أ.ياسر الذماري','username'=>'لجنة المشاريع','Gender'=>'ذكر','password'=>bcrypt("123456789"),'PhoneNumber'=>'737166320','Email'=>'m.muath1995@gmail.com','PresonalPicture'=>'uploads\user.png','Roles'=>'2','IsActive'=>'1'],
	    
        ];

        DB::table('users')->insert($Users);
    }
}
