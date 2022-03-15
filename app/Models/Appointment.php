<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Driver\PathExistsButIsNotDirectoryException;

class Appointment extends Model
{
    use HasFactory;


    protected $fillable = [
        'patients_id',
        'doctors_id',
        'date',
        'time',
        'details',
        'status'
    ];

    public function patient (){

        return $this->belongsTo(Patient::class , 'patients_id');
    }

    public function Doctor (){

        return $this->belongsTo(Patient::class , 'doctors_id');
    }

    public function prescription(){
        
        return $this->belongsTo(Prescription::class , 'appointments_id');
    }

    
}

