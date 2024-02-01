<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.doctor.doctor-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctor.add-doctor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:'.User::class],
            'mobile' => ['required'],
            'doctor_name' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $doctor = new User();
        $doctor->name = $request->name;
        $doctor->doctor_name = $request->doctor_name;
        $doctor->mobile = $request->mobile;
        $doctor->user_type = 1;
        $doctor->password = Hash::make($request->password);
        $doctor->save();

        $doctor->medicals()->attach($request->medical_center_id);

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
        $doctor = User::find($id);
        $doctor_medicals[]= [];
        foreach ($doctor->medicals as $item) {
            $doctor_medicals[] = $item->id;
        }
        return view('admin.doctor.edit-doctor',compact('doctor','doctor_medicals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
// dd($request->all());
        $doctor = User::find($id);
$arr [] = null;
        $doctor->name = $request->name;
        $doctor->doctor_name = $request->doctor_name;
        $doctor->mobile = $request->mobile;
        $doctor->user_type = 1;
        if ($request->password != null) {
            $doctor->password = Hash::make($request->password);
        }
        $doctor->save();

        foreach ($doctor->medicals as $item) {
            $arr[] = $item->id;
        }
        if (($arr != $request->medical_center_id) && ($arr != null)) {
            $doctor->medicals()->detach($arr);
            $doctor->medicals()->attach($request->medical_center_id);
        }

        return redirect()->back()->with('status', 'Successfully Created!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = User::find($id);
        $arr[] = null;
        foreach ($doctor->medicals as $item) {
            $arr[] = $item->id;
        }
        if ($arr != null) {
            $doctor->medicals()->detach($arr);
        }
        $doctor->delete();
        return redirect()->back()->with('status', 'Successfully Deleted!');
    }
}
