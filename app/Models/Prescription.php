<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
      'appointment_id',
        'name_of_disease',
        'medicines',
        'usage_instruction',
        'note'
    ];

    public function appointment (){

        return $this->hasOne(Appointment::class );
    }
}
