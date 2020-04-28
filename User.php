<?php

namespace App;

use App\City;
use App\User;
use App\Grade;
use App\Rating;
use App\Review;
use App\Tution;
use App\Subject;
use App\Location;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','experince','city_id','Insta1','Insta2','degree1',
        'degree2','year1','year2','status','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function city()
      {
          return $this->belongsTo(City::class);
      }
      public function subject()
      {
          return $this->belongsToMany(Subject::class);
      }
      public function grade()
      {
        return $this->belongsToMany(Grade::class);
      }
      public function location()
      {
          return $this->belongsToMany(Location::class);
      }
      public function tution()
      {
          return$this->hasMany(User::class);
      }
      public function hasSubject($subjectid)
      {
          return in_array($subjectid,$this->subject->pluck('id')->toArray());

      }
      public function hasgrade($gradeid)
      {
          return in_array($gradeid,$this->grade->pluck('id')->toArray());

      }
      public function hasLocation($locationid)
      {
          return in_array($locationid,$this->location->pluck('id')->toArray());
      }
      public function Ratings()
      {
          return $this->hasMany(Rating::class,'rated_user_id');
      }
}
