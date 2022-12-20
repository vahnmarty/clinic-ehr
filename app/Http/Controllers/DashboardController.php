<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Product;
use App\Models\Laboratory;
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
        $total_pharmacy = Product::count();
        $total_laboratory = Laboratory::count();
        $total_male = Patient::male()->count();
        $total_female = Patient::female()->count();
        $age_range = range(0, 6);
        $age_groups = collect();

        foreach($age_range as $age)
        {
            $group = $age;
            if($age <= 0){
                $group = '< 1'; 
            }elseif($age > 5){
                $group = '6+'; 
            }
            $age_groups->push([
                'group' => $group,
                'total' => Patient::whereDate('date_of_birth', '>=', now()->subYears($age))->count(),
                'male' => Patient::whereDate('date_of_birth', '>=', now()->subYears($age))->male()->count(),
                'female' => Patient::whereDate('date_of_birth', '>=', now()->subYears($age))->female()->count(),
            ]);
        }

        return view('dashboard', compact('total_patients', 'clinics', 'total_pharmacy', 'total_laboratory', 'age_groups', 'total_male', 'total_female'));
    }

    public function clinicDashboard($clinic_id)
    {
        $clinic = Clinic::with('patients')->find($clinic_id);
        $clinics = Clinic::get();
        $checkins = Application::with('patient')->where('clinic_id', $clinic_id)->get();

        return view('clinic-dashboard', compact('clinics', 'clinic', 'checkins'));
    }
}
