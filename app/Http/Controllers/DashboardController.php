<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_patients = Patient::count();

        return view('dashboard', compact('total_patients'));
    }
}
