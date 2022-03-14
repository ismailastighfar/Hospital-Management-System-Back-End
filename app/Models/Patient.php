<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'users_id',
        'allergies',
        'sickness'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

    public function questions(){
        return $this->hasMany(Question::class, 'questions_id');
    }

    public function appointments (){

        return $this->hasMany(Appointment::class , 'appointments_id');
    }

}
