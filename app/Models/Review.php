<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [ 'review', 'rating', 'patient_id', 'doctor_id' ];

    public function patinet(){
        return $this->belongsTo(Patinet::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
