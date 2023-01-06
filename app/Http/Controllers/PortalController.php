<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function redirector($patientId, $action)
    {
        $patient = Patient::find($patientId);

        if($action == 'check-in')
        {
            return redirect()->route('station.checkin', ['patient_id' => $patientId]);
        }

        if($action == 'vital-sign')
        {
            return redirect()->route('station.vital-sign', ['patient_id' => $patientId]);
        }
    }
}
