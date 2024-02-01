<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
use App\Imports\PatientsImport;
use App\Models\Medical;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
// use DataTables;

class ListController extends Controller
{
   public function index ()
   {
        return view('admin.dashboard');
   }

    public function userlist(Request $request) 
    {
      if ($request->ajax()) {
            $data = User::select("*")->where('user_type',2)->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('id', function ($row) {
                    return view("admin.user-table.user-action",compact("row"));
                })
            ->addColumn('role', function ($row) {
                return view("admin.user-table.user-role",compact("row"));
            })
             ->addColumn('created_at', function ($row) {
                return view("admin.user-table.user-created",compact("row"));
            })
            ->addColumn('medical_center_id', function ($row) {
                return view("admin.user-table.medical-name",compact("row"));
            })
            ->make(true);
        }
    }

    public function medicalList(Request $request) 
    {
        if ($request->ajax()) {
            $data = Medical::select("*")->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('id', function ($row) {
                    return view("admin.medical-table.medical-action",compact("row"));
                })
            ->addColumn('medical_centre_logo', function ($row) {
                return view("admin.medical-table.medical-logo",compact("row"));
            })
             ->addColumn('created_at', function ($row) {
                return view("admin.medical-table.medical-created",compact("row"));
            })
            ->make(true);
        }
    }

    public function doctorlList(Request $request) 
    {

        if ($request->ajax()) {
            $data = User::select("*")->where('user_type',1)->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('id', function ($row) {
                    return view("admin.doctor-table.doctor-action",compact("row"));
                })
            ->addColumn('created_at', function ($row) {
                return view("admin.doctor-table.doctor-created",compact("row"));
            })
            ->addColumn('medical_center_id', function ($row) {
                return view("admin.doctor-table.doctor-medical-name",compact("row"));
            })
            ->make(true);
        }
    }

    public function patientList(Request $request) 
    {
      
        if (Auth::user()->user_type == 1) {
            if ($request->ajax()) {
                $medical = Medical::find($request->medical_id);
                $data = Patient::select("*")->where('medical_centre_id', $medical->medical_centre_id)->get();
                if($request->filled('from_date'))
                { 
                    $data = $data->where('created_at',$request->from_date);
                }
                if($request->filled('to_date'))
                {
                    $data = $data = $data->where('updated_at',$request->to_date);
                }
                return DataTables::of($data)->addIndexColumn()
                ->addColumn('id', function ($row) {
                        return view("doctor.doctor-table.medical-patient-action",compact("row"));
                    })
                ->addColumn('created_at', function ($row) {
                    return view("user.patient-table.created-on",compact("row"));
                })
                ->addColumn('updated_at', function ($row) {
                    return view("user.patient-table.updated-on",compact("row"));
                })
                ->make(true);
            }
        } else {
            if ($request->ajax()) {
                $medical_center_id = Auth::user()->medicals[0]->medical_centre_id;
                $data = Patient::select("*")->where('medical_centre_id',$medical_center_id)->get();

                if($request->filled('from_date'))
                { 
                    $data = $data->where('created_at',$request->from_date);
                }
                if($request->filled('to_date'))
                {
                    $data = $data = $data->where('updated_at',$request->to_date);
                }
                // return response()->json($data);
                return DataTables::of($data)->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return view("user.patient-table.patient-checkbox",compact("row"));
                })
                ->addColumn('id', function ($row) {
                        return view("user.patient-table.patient-action",compact("row"));
                    })
                ->addColumn('created_at', function ($row) {
                    return view("user.patient-table.created-on",compact("row"));
                })
                ->addColumn('updated_at', function ($row) {
                    return view("user.patient-table.updated-on",compact("row"));
                })
                ->make(true);
            }
        }
        
        return view('user.patient-list');
    }

    public function uploadPatients(Request $request)
    {
        Excel::import(new PatientsImport, $request->file);

        Patient::where('created_at', null)
        ->chunkById(200, function ($patients){
            foreach($patients as $patient){
                $patient->created_at = date("Y/m/d");
                $patient->save();
            }
        });
        return redirect()->back()->with('status', 'Successfully Created!');
    }

    public function exportPatients() 
    {
        return Excel::download(new PatientsExport, 'patients.csv');
    }

    public function uploadDicom(Request $request)
    {
        $data = $request->validate([
            'images' => 'required|array'
        ]);

        $images = [];

        foreach ($data['images'] as $image) {
            $fileName = $image->getClientOriginalName();
            $name = explode('.', $fileName)[0];

            $patient = Patient::where('patient_id',$name)->get();
            if ($patient->toArray() == null) {
                return redirect()->back()->with('status', 'Image did not uploaded, first upload the patient = '.$name);
            }
            $get_patient = Patient::find($patient[0]->id);
            $get_patient->dicomfile_name = $fileName;
            $get_patient->save();

            $path = base_path() . '/editpatient/public/decomfiles/';
            move_uploaded_file($image,$path.$fileName);
        }
        return redirect()->back()->with('status', 'Successfully Created!');
    }

    public function edit(string $id)
    {
        if (Auth::user()->user_type == 1) {
            $patient = Patient::find($id);
            // dd($patient);
            return view('doctor.edit-medical-patient',compact('patient'));
        }
        $patient = Patient::find($id);
        return view('user.edit-patient',compact('patient'));
    }

    function update(Request $request, $id)
    {
        if (Auth::user()->user_type == 1) {
            $patient = Patient::find($request->id);
            if ($request->remarks == 'other') {
                $patient->doctor_remarks = $request->remarks2;
            } else {
                $patient->doctor_remarks = $request->remarks;
            }
            $patient->doctor_status = $request->doc_status;
            $patient->updated_at = date("Y/m/d");
            $patient->save();
            $next = Patient::where('medical_centre_id',$patient->medical_centre_id)->where('id', '>', $request->id)->min('id');
            if ($next != null) {
                return redirect("editpatient/$next");
            }

            return redirect()->back();
        }
        elseif(Auth::user()->user_type == 2)
        {
            $patient = Patient::find($id);
            $patient->patient_id = $request->patient_id;
            $patient->patient_name = $request->patient_name;
            $patient->patient_passport = $request->patient_passport;
            $patient->patient_dob = $request->patient_dob;
            $patient->save();
            return redirect()->back()->with('status', 'Successfully Updated!');
        }

        return redirect()->back();
    }

    
    function delete(Request $request)
    {
        if ($request->has('checkbox')) {
            // dd($request->checkbox);
            foreach ($request->checkbox as $key => $value) {
                if ($value != 'on') {
                    $patient = Patient::find($value);
                    $file = base_path() . '/editpatient/public/decomfiles/'.$patient->patient_id.'.dcm';
                    if (file_exists($file)) {
                        unlink($file);
                    }
                    $patient->delete();
                }
            }
        }
        return redirect()->back()->with('status', 'Successfully Deleted!');
    }

    public function nextMedical($id)
    {
        $medical = Medical::find($id);
        $patient = Patient::where('medical_centre_id',$medical->medical_centre_id)->first();
       
        $id = $patient->id;
        return redirect("editpatient/$id");
    }

    public function doctorHome()
    {
        $medicalList = Auth::user();
        $medicalList = $medicalList->medicals;
        return view('doctor.home',compact('medicalList'));
    }

    public function medicalPatientList($id)
    {
        return view('doctor.medical-patient-list',compact('id'));
    }

    public function editAdmin($id)  {
        if (Auth::user()->user_type == 0) {
            return view('admin.update-profile',compact('id'));
        }
        if (Auth::user()->user_type == 1) {
            return view('doctor.update-doctorprofile',compact('id'));
        }
        if (Auth::user()->user_type == 2) {
            return view('user.update-userprofile',compact('id'));
        }
    }


    public function updateUserProfile(Request $request, $id)  {
        $user = User::find(Auth::user()->id);
        if (Auth::user()->user_type == 0) {
            $user->name = $request->name;
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect()->back()->with('status', 'Successfully Updated!');
        }
        if (Auth::user()->user_type == 1) {
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect()->back()->with('status', 'Successfully Updated!');
        }
        if (Auth::user()->user_type == 2) {
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect()->back()->with('status', 'Successfully Updated!');
        }

        return redirect()->back();
    }

}
