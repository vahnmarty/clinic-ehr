<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Application;
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
        $clinic = Clinic::with('patients')->find($clinic_id);
        $clinics = Clinic::get();
        $checkins = Application::with('patient')->where('clinic_id', $clinic_id)->get();

        return view('clinic-dashboard', compact('clinics', 'clinic', 'checkins'));
    }
}
