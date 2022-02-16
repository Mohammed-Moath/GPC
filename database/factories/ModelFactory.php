<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

/*$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
*/


// Seeding a table Users with data
$factory->define(App\User::class, function (Faker\Generator $faker) {
   
    return [

       /* 'FirstName' => $faker->firstName($gender = null|'male'|'female'),
        'SecondName' => $faker->firstNameFemale,
        'TirdName' => $faker->firstNameMale,
        'NickName' => $faker->lastName,
        'PhoneNumber' => $faker->ean8,*/
        'Email' => $faker->safeEmail,
        //'Gender' => $faker->null (random), male, female,
        'PresonalPicture' => $faker->imageUrl($width = 640, $height = 480),
        'UserName' => $faker->name,
        'Password' => $faker->password,  
        'remember_token' => str_random(10),
        'IsActive' => $faker->boolean,
        'user_roles_id' => $faker->numberBetween($min=2,$max=5),
        'created_at' => $faker->dateTime
    ];

});

// Saeeding a table Project_Supervisor with data
$factory->define(App\ProjectSupervisor::class, function (Faker\Generator $faker) {
   
    return [

        'FunctionalNumber' =>'123456789',        
        'scientific_degrees_id' =>$faker->numberBetween($min=1,$max=3),
        'programs_id' =>$faker->numberBetween($min=1,$max=12),
        'users_id' =>$faker->numberBetween($min=1,$max=10),
    ];

});

// Saeeding a table Proposal with data 
$factory->define(App\Proposal::class, function (Faker\Generator $faker) {
   
    return [

        'ProjectProposalTitle' => $faker->title,
        'descrdiption' => $faker->text,          
        'Outputs' =>$faker->title,
        'ImportanceProposal' =>$faker->title,
        'Tools' =>$faker->title,
        'NumberOfStudents' => $faker->randomDigit,          
        'users_id' =>$faker->numberBetween($min=1,$max=10),
        //'DateSubmission' =>$faker->dateTimeThisCentury($max = 'now', $timezone = date_default_timezone_get()),
        //'IsAccpet' =>$faker->boolean,
        //'FN_Supervisor' =>'123456789',
        //'IsSelected' =>$faker->boolean,

    ];

});


// Seeding a table project_groups with data
$factory->define(App\projectGroup::class, function (Faker\Generator $faker) {
   
    return [

        'GroupCode' => $faker->postcode,
        'branches_id' => $faker->numberBetween($min=1,$max=2),
        'proposals_id' => $faker->numberBetween($min=1,$max=10),
        'AcademicYear' =>'2017/2018',
        'Semester'=>'الأول',
        'GroupLader' =>'20131022215',

    ];

});

// Saeeding a table project_students with data
$factory->define(App\ProjectStudent::class, function (Faker\Generator $faker) {
   
    return [

        'AcdameicNumber' => '20131022215',
        'programs_id' =>$faker->numberBetween($min=1,$max=12),          
        'branches_id' =>$faker->numberBetween($min=1,$max=2), 
        'users_id' =>$faker->numberBetween($min=1,$max=10),
        'project_groups_id' =>$faker->numberBetween($min=1,$max=10),
    ];
}); 

// Saeeding a table Meeting with data
$factory->define(App\Meeting::class, function (Faker\Generator $faker) {
   
    return [

        'DataMeeting' => $faker->date,
        'StartTime' =>$faker->time,
        'TitleMeeting' => $faker->title,
        'ContentMeeting' =>$faker->text,         
        'EndTime' =>$faker->time,    
        'project_groups_id' =>$faker->numberBetween($min=1,$max=10),
               
    ];

});  

// Saeeding a table meeting_tasks with data
$factory->define(App\MeetingTask::class, function (Faker\Generator $faker) {
   
    return [

        'meetings_id' =>$faker->numberBetween($min=1,$max=10),
        'TaskName' =>$faker->title,
        'Notes' => $faker->text,
        'TaskStatu' =>$faker->boolean,          
               
    ];

});  

// Saeeding a table delivs with data
$factory->define(App\Deliv::class, function (Faker\Generator $faker) {
   
    return [

        'DeliveryDate' =>$faker->datetime,
        'Note' =>$faker->text,
        'type_delivs_id' => $faker->numberBetween($min=1,$max=5),
        'project_groups_id' => $faker->numberBetween($min=1,$max=10),
        'IsAccept' =>$faker->boolean,
               
    ];

});  

// Saeeding a table project_degrees with data
$factory->define(App\ProjectDegree::class, function (Faker\Generator $faker) {
   
    return [

        'Student_AN' =>$faker->bankRoutingNumber,
        'EvaluateInitialDiscussion' =>$faker->randomDigit,
        'DegreeRegularity' =>$faker->randomDigit,
        'DegreeSupervisor' =>$faker->randomDigit,
        'FinalDiscussion' =>$faker->randomDigit,
        'Aredisplayed' =>$faker->boolean,
               
    ];

});  

// Saeeding a table attachments with data
$factory->define(App\Attachment::class, function (Faker\Generator $faker) {
   
    return [

        'type_attachments_id' =>$faker->numberBetween($min=1,$max=12),
        'PathAttachments' =>$faker->imageUrl($width = 640, $height = 480),
        'project_announcements_id' =>$faker->numberBetween($min=1,$max=10),
    ];

});

// Saeeding a table project_announcements with data
$factory->define(App\ProjectAnnouncement::class, function (Faker\Generator $faker) {
   
    return [

        'TitleAnnouncement' =>$faker->title,
        'DescirptionAnnouncement' =>$faker->text,
        'DatePublication' =>$faker->datetime,
    ];

}); 

// Saeeding a table projects with data
$factory->define(App\Project::class, function (Faker\Generator $faker) {
   
    return [

        'ProjectName' =>$faker->realText($maxNbChars = 10),
        'SupervisorName' =>$faker->name,
        'laderName' =>$faker->name,
        'ProjectDescription' =>$faker->text,
        'PathProject_Document' =>$faker->url,
        'PathProject_Software' =>$faker->url,
        'project_calendars_id' =>$faker->numberBetween($min=1,$max=16),
        'IsVeiw' =>$faker->boolean,
        'NumberDownload' =>$faker->randomDigit,
    ];

}); 

// Saeeding a table proposals_programs with data
$factory->define(App\Proposal_Program::class, function (Faker\Generator $faker) {
   
    return [

        'proposal_id' =>$faker->numberBetween($min=1,$max=10),
        'program_id' =>$faker->numberBetween($min=1,$max=10),      
    ];

});    

// Saeeding a table meeting_project_students with data
$factory->define(App\Meeting_projectStudent::class, function (Faker\Generator $faker) {
   
    return [

        'meetings_id' =>$faker->numberBetween($min=1,$max=10),
        'Student_AN' =>$faker->numberBetween($min=1,$max=10),
        'Presanet' =>$faker->boolean,
        'Absent' =>$faker->boolean,

    ];

});       

  