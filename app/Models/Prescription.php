<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
        'appointment_id',
=======
        'appointments_id',
>>>>>>> 59d062eae7085e05f4ac327549f1fedcbbfe8212
        'name_of_disease',
        'medicines',
        'usage_instruction',
        'note'
    ];

    public function appointment (){

<<<<<<< HEAD
        return $this->hasOne(Appointment::class );
=======
        return $this->hasOne(Appointment::class , 'appointments_id');
>>>>>>> 59d062eae7085e05f4ac327549f1fedcbbfe8212
    }
}
