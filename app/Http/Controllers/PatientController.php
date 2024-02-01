<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.patient-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.add-patient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $patient = new Patient();
        $patient->patient_id = $request->patient_id;
        $patient->patient_name = $request->patient_name;
        $patient->patient_passport = $request->patient_passport;
        $patient->patient_dob = $request->patient_dob;
        $patient->medical_centre_id = $user->medicals[0]->medical_centre_id; 
        if($request->hasFile('dicomfile_name')){
            $fileName = $request->dicomfile_name->getClientOriginalName();
            $path = base_path() . '/editpatient/public/decomfiles/';
            move_uploaded_file($request->dicomfile_name,$path.$fileName);
            $patient->dicomfile_name = $fileName;
         }
        $patient->created_at = date("Y/m/d");
        $patient->save();

        return redirect()->back()->with('status', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::find($id);
        // dd($patient);
        return view('user.edit-patient',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::find($id);
        $file = base_path() . '/editpatient/public/decomfiles/'.$patient->patient_id.'.dcm';
        if (file_exists($file)) {
            unlink($file);
        }
        $patient->delete();
        return redirect()->back()->with('status', 'Successfully Deleted!');
    }
}
