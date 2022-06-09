<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'fullname',
        'age',
        'cne',
        'address',
        'phone',
        'dateOfBirth',
        'avatar',
        'user_id',
        'allergies',
        'sickness'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function appointments (){

        return $this->hasMany(Appointment::class);
    }

    public function feedback(){
        return $this->hasOne(feedback::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

}
