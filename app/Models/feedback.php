<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    use HasFactory;
    protected $fillable = [ 'content', 'rating', 'patient_id' ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
