<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	protected $table="user_roles";
  protected $fillable = [
      'UserRoleEn', 'UserRoleAr'];
	
    // Associations between Table UserRole and Table Users
    public function users(){
      return $this->hasMany('App\User');
    }

    
}
 