<?php

namespace App;

use App\User;
use App\Tution;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable=['name'];
    public function tutions()
    {
        return $this->belongsToMany(Tution::class);
   }
   public function users()
   {
    return $this->belongsToMany(User::class);
   }
}
 