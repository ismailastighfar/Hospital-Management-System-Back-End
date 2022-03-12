<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'departments_id',
        'speciality'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'departments_id');
    }

    public function answers(){
        return $this->hasMany(Answer::class , 'answers_id');
    }
}
