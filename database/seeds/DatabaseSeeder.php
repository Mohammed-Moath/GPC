<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

         //$this->call(AcademicNumbers::class);
         $this->call(Users::class);
         $this->call(ScientificDepartments::class);
         $this->call(ProgramType::class);
         $this->call(Program::class);
         $this->call(ScientificDegrees::class);
         $this->call(Constraint::class);

         $this->call(ProjectCalendars::class);
         $this->call(Grades::class);
         $this->call(UserRole::class);
         $this->call(Branches::class);
        
         //$this->call(ProjectCalendars::class);
         //$this->call(TypeDeliver::class);
         //$this->call(TypeAttachment::class);
        // factory(App\User::class,10)->create();
         //factory(App\ProjectSupervisor::class,1)->create();
         //factory(App\Proposal::class,10)->create();
         //factory(App\projectGroup::class,10)->create();
         //factory(App\ProjectStudent::class,1)->create();
         //factory(App\Meeting::class,10)->create();
         //factory(App\MeetingTask::class,10)->create();
         //factory(App\Deliv::class,10)->create();
         //factory(App\ProjectDegree::class,10)->create();
         //factory(App\Attachment::class,10)->create();
         //factory(App\ProjectAnnouncement::class,10)->create();
         //factory(App\Project::class,10)->create();
         //factory(App\Proposal_Program::class,10)->create();
        // factory(App\Meeting_projectStudent::class,10)->create();
                 
    }
}
