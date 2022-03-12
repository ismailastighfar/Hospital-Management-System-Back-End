<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'doctors_id',
        'question_id',
        'content',
    ];
    public function question(){
        return $this->belongsTo(Question::class ,);
    }
    public function auther(){
        return $this->belongsTo(Doctor::class, 'doctors_id');
    }
}
