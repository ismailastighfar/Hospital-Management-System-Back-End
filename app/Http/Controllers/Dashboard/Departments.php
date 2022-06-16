<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\department;


class Departments extends Controller
{
    public function index(){
        return view('department.departments', ['departments' => Department::all() ]);
    }

    public function create(){
        return view('department.create');
    }
}
