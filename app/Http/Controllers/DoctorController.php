<?php
namespace App\Http\Controllers;


use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index(){
       
       
        return DB::table('doctors')
        ->join('specialties','doctors.specialty_id' , '=', 'specialties.id')
        ->get();
    }

    public function show(Doctor $doctor){
        
        return  $doctor->load(['specialty','review','department']);

    }

    public function search(){
         return Doctor::latest()
            ->filter(request(['name', 'specialty']))
            ->when(request('specialty') ?? false , fn($query,$name) => 
                $query->where('specialty_id','=', request('specialty')))
            ->with('specialty')
            ->with('review')
            ->with('department')
            ->get();
       
    }

     public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'age' => 'required|integer',
            'phone' => 'required',
            'proEmail' => 'required|email',
            'description' => 'required|min:10|max:255',
            'picture' => 'required|image|mimes:jpg,png,jpeg',
            'department_id' => 'required',
            'specialty_id' => 'required',
            'user_id' => 'required',
        ]);

        $imageName = $request->fname . $request->lname . '.' . $request->picture->extension();
        $request->picture->move(public_path('doc_img'), $imageName);
        $doc =  new Doctor();
        $doc->fname = $request->fname;
        $doc->lname = $request->lname;
        $doc->age = $request->age;
        $doc->phone = $request->phone;
        $doc->proEmail = $request->proEmail;
        $doc->description= $request->description;
        $doc->picture = ''.asset('/doc_img/'. $imageName );;
        $doc->department_id = $request->department_id;
        $doc->specialty_id = $request->specialty_id;
        $doc->user_id = $request->user_id;
        $doc->save();

        return response([ 'message' => 'doctor created succefully' , 'id' => $doc->id]);
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'age' => 'required|integer',
            'phone' => 'required',
            'proEmail' => 'required|email',
            'description' => 'required|min:10|max:255',
            'department_id' => 'required',
            'specialty_id' => 'required',
        ]);

        $doctor = Doctor::find($id);

        if($doctor) {
            $doctor->update([
                'proEmail' => $request->proEmail,
                'phone' => $request->phone,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'age' => $request->age,
                'phone' => $request->phone,
                'proEmail' => $request->proEmail,
                'description' => $request->description,
                'department_id' => $request->department_id,
                'specialty_id' => $request->specialty_id,
        
        ]);
            return response(['message' => 'the doctor updated successfully']);
        }
        return response(['error' => 'non doctor founded'] , 404);
    }
}
