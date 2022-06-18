<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return DB::table('medicines')
        ->join('categories','medicines.categorie' , '=', 'categories.id')
        ->select('medicines.*', 'categories.name as categoryname')
        ->get();;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:255|unique:medicines,name',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

         Medicine::create($request->all());

         return response(['message' => 'medicine created succefully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Medicine::find($id);
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
        $medicine = Medicine::find($id);

        $attr = $request->validate([
            'quantity' => 'required',
            'price' => 'required',

        ]);

        $medicine = Medicine::find($id);

        $medicine->update($attr);

        return response([
            'message' => 'medicine updated succefully',
            'medicine' => $medicine
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Medicine::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name , $category)
    {
        return Medicine::where('name', 'like', '%'.$name.'%')->orwhere('category','like', '%'.$category.'%')->get();
    }
}
