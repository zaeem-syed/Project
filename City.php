<?php

namespace App;


use App\City;
use App\User;
use App\Tution;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    
    protected $fillable=['name'];

    public function tution()
    {
        return $this->hasMany(Tution::class);
  }
  public function user()
  {
      return $this->hasMany(User::class);
 }
 public function location()
 {
     return $this->hasMany(City::class);
 }
}
