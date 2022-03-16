<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'content',
    ];

    public function auther(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
