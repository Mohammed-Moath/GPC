<?php

namespace App;
 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $table="users";
    //public $timestamps = false;

    use Notifiable;

  /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
  protected $fillable = [
      'Name',
      'username',
      'Gender',
      'password',
      'PhoneNumber',
      'Email',
      'PresonalPicture',
      'Roles',
      'IsActive',
  ];

  /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
  protected $hidden = [
      'password', 'remember_token',
  ];

  // Associations between Table Users and Table User_Roles
  public function UserRoles(){
    return $this->belongsTo('App\UserRole','Roles');
  }
  public function hasRole($title){
    $user_role = $this->UserRoles();
    if(!is_null($user_role)){
        $user_role = $user_role->UserRoleEn;
    }
     return ($user_role===$title)?ture:false;
  }


  // Associations between Table Project_Supervisor and Table Users
  public function ProjectSupervisor(){
    return $this->hasOne('App\ProjectSupervisor','users_id');
  }

  // Associations between Table Project_Studens and Table Users
  public function ProjectStudent(){
    return $this->hasOne('App\ProjectStudent','users_id');
  }

  //Associations between Table Users and Table Proposer
  public function Proposals(){
    return $this->hasMany('App\Proposal');
  }
}
