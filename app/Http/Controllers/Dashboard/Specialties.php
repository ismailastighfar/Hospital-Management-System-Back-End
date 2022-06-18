<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\specialty;
class Specialties extends Controller
{
    public function index(){
        return view('specialty.specialties', ['specialties' => Specialty::all() ]);
    }

    public function create(){
        return view('specialty.create');
    }



}
