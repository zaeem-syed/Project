<?php

namespace App;

use App\City;

use App\User;
use App\Grade;
use App\Tution;
use App\Subject;
use App\Location;
use Illuminate\Database\Eloquent\Model;



class Tution extends Model
{
    //
    protected $fillable = [
         'description','city_id','user_id','status'
    ];
    public function city()
   {
       return $this->belongsTo(City::class);
    }
    public function subject()
    {
        return $this->belongsToMany(Subject::class);
    }
    public function hasSubject($subjectid)
      {
          return in_array($subjectid,$this->subject->pluck('id')->toArray());

      }
      
      public function hasGrade($gradeid)
      {
          return in_array($gradeid,$this->grade->pluck('id')->toArray());
      }



      public function grade()
    {
        return $this->belongsToMany(Grade::class);
    }
    public function location()
    {
        return $this->belongsToMany(Location::class);
    }
    public function hasLocation($locationid)
      {
          return in_array($locationid,$this->location->pluck('id')->toArray());
      }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}
