<?php

namespace App\Http\Controllers;

use App\Models\Medical;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.medical.medical-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.medical.add-medical');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'medical_centre_name' =>  'required|string|max:255|unique:'.Medical::class,
            'medical_centre_id' => 'required|string|max:255|unique:'.Medical::class,
            'medical_centre_address' => 'required',
            'medical_centre_mobile' => 'required',
            'medical_centre_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $logo_path = null;
        if($request->hasFile('medical_centre_logo'))
        {
            $imageName = $request->medical_centre_id . '.' . $request->medical_centre_logo->extension();
            $path = 'public/images/';
            $imageName = strtr($imageName, '/', '-');
            move_uploaded_file($request->medical_centre_logo,$path.$imageName);
        }
        $medical_center = new Medical();
        $medical_center->medical_centre_name = $request->medical_centre_name;
        $medical_center->medical_centre_id = $request->medical_centre_id;
        $medical_center->medical_centre_address = $request->medical_centre_address;
        $medical_center->medical_centre_mobile = $request->medical_centre_mobile;
        $medical_center->medical_centre_logo = $path.$imageName;
        $medical_center->save();
        
        return redirect()->back()->with('status', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $medicals = User::find($id)->medicals;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medical = Medical::find($id);
        return view('admin.medical.medical-edit',compact('medical'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medical_center = Medical::find($id);
        $medical_center->medical_centre_name = $request->medical_centre_name;
        $medical_center->medical_centre_id = $request->medical_centre_id;
        $medical_center->medical_centre_address = $request->medical_centre_address;
        $medical_center->medical_centre_mobile = $request->medical_centre_mobile;
        // $medical_center->medical_centre_logo = $logo_path;
        $medical_center->save();

        return redirect()->back()->with('status', 'Successfully Updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
       public function destroy(string $id)
    {
        $medical_center = Medical::find($id);

        foreach ($medical_center->users as $user)
        {
            if ($user->user_type == 2) {
                $medical_center->users()->detach($user->id);
                $user->delete();
            } elseif($user->user_type == 1) {
                $medical_center->users()->detach($user->id);
            } 
        }

        $medical_center_patients = Patient::where('medical_centre_id',$medical_center->medical_centre_id)->get();
        foreach ($medical_center_patients as  $patient) {
            $file = base_path() . '/editpatient/public/decomfiles/'.$patient->patient_id.'.dcm';
            if (file_exists($file)) {
                unlink($file);
            }    
            $patient->delete();
        }
        if (file_exists($medical_center->medical_centre_logo)) {
            unlink($medical_center->medical_centre_logo);
        }
        $medical_center->delete();
        return redirect()->back()->with('status', 'Successfully Deleted!');
    }
}
