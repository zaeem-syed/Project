<?php

namespace App;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    Protected $fillable=[
        'rating',
        'review',
        'rated_user_id'
];
public function user()
{
    return $this->belongsTo(User::class);
}
}
