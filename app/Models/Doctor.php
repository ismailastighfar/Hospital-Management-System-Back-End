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
        'specialty_id',   
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
     
    public function specialty(){
        return $this->belongsTo(Specialty::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }
    

    public function scopeFilter($query , array $filters){

    

    $query->when($filters['name'] ?? false , fn($query,$name) =>
        $query
        ->where('fname', 'like' , '%' . $name . '%')
        ->orwhere('lname' , 'like' ,  '%' . $name . '%'),
    ); 

}
      
}

