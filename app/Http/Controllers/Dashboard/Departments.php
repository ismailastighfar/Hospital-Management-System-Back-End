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

    public function edit($id){
        return view('department.edit', ['department' =>  Department::find($id) ]);
    }
    public function update(Request $request ,$id){
        $departemnt = Department::find($id);
        $departemnt->dept_name = $request->dept_name;
        $departemnt->dept_details = $request->dept_details;
        $departemnt->save();
        return redirect()->back()->with([ 'message' => 'saved']);
    }


    public function create(){
        return view('department.create');
    }
}
