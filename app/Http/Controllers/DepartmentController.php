<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Department::all()->load('doctors');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
           'dept_name' => 'required',
           'dept_details' => 'required'
       ]);

       $data = [
        'dept_name'    => $request->dept_name,
        'dept_details' => $request->dept_details,
    ];

      Department::create($data);

      return response([
          'message' => 'success'
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return $department->load('doctors');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dept_name' => 'required',
            'dept_details' => 'required'
        ]);

        $dept = Department::find($id);

        if ($dept) {

           $dept->dept_name = $request->dept_name;
           $dept->dept_details = $request->dept_details;   
           $dept->save();

           return response([
               'message' => 'updated successfully',
               'department' => $dept
           ]);
           
           return response('error' , 404);

       }
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return Department::destroy($id);
    }
}

