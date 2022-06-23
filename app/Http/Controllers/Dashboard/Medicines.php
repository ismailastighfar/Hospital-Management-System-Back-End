<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Categorie;
use App\Models\Medicine;
use Illuminate\Support\Facades\DB;

class Medicines extends Controller
{
    public function index(){
        return view('medicines.medicines', ['medicines' => DB::table('medicines')
        ->join('categories','medicines.categorie' , '=', 'categories.id')
        ->select('medicines.*', 'categories.name as categoryname')
        ->get() ]);
    }

    public function create(){
        
        return view('medicines.create' , ["categories" => Categorie::all()]);
    }

    public function edit($id){
        return view('medicines.edit', ['medicine' =>  Medicine::find($id) ]);
    }
    public function update(Request $request, $id){
        $med = Medicine::find($id);
        $med->price = $request->price;
        $med->save(); 
        return redirect()->back()->with(['message' => 'saved']);
    }

    
}