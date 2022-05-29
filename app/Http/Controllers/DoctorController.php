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
        
        return   DB::table('doctors')
        ->where('doctors.id' , '=' , $doctor->id)
        ->join('specialties','doctors.specialty_id' , '=', 'specialties.id')
        ->join('departments','doctors.department_id' , '=', 'departments.id')
        ->get();

    }

    public function search(){
         return Doctor::latest()->filter(request(['name' , 'specialty']))       ->get();
       
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
            'user_id' => 'required',
        ]);

        $imageName = $request->fname . $request->lname . '.' . $request->picture->extension();
        $request->picture->move(public_path('doc_img'), $imageName);

        Doctor::create($request->all());

        return response([ 'message' => 'doctor created succefully']);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'phone' => 'integer',
            'proEmail' => 'email',
        ]);

        $doctor = Doctor::find($id);

        if($doctor) {
            $doctor->update([
                'proEmail' => $request->proEmail,
                'phone' => $request->phone,
        
        ]);
            return response(['message' => 'the doctor updated successfully']);
        }
        return response(['error' => 'non doctor founded'] , 404);
    }
}
