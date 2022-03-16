<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'age',
        'phone',
        'proEmail',
        'description',
        'speciality',   
        'picture',
        'user_id',
        'department_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function appointments(){

        return $this->hasMany(Appointment::class );
    }
}
