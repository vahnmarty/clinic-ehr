<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return $request->clinic_id 
            ? $this->clinicDashboard($request->clinic_id)
            : $this->dashboard();
        
    }

    public function dashboard()
    {
        $total_patients = Patient::count();
        $clinics = Clinic::get();
        return view('dashboard', compact('total_patients', 'clinics'));
    }

    public function clinicDashboard($clinic_id)
    {
        $clinic = Clinic::find($clinic_id);
        $clinics = Clinic::get();
        return view('clinic-dashboard', compact('clinics', 'clinic'));
    }
}
