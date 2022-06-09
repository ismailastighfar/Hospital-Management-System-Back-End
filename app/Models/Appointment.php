<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Appointment extends Model
{
    use HasFactory;


    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date',
        'time',
        'details',
        'status'
    ];

    public function patient(){

        return $this->belongsTo(Patient::class);
    }

    public function doctor(){

        return $this->belongsTo(Doctor::class);
    }
   
    public function prescription(){
        
        return $this->belongsTo(Prescription::class);
    }

    

    
}

