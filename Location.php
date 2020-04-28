<?php

namespace App;

use App\City;
use App\User;
use App\Tution;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable=['name','city_id'];

    public function tutions()
    {
        return $this->belongsToMany(Tution::class);
   }
   public function users()
   {
    return $this->belongsToMany(User::class);

   }
   public function city()
   {
       return $this->belongsTo(City::class);
   }

}
