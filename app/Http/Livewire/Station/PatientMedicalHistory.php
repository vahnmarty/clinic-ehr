<?php

namespace App\Http\Livewire\Station;

use Livewire\Component;

class PatientMedicalHistory extends Component
{
    public $patient_id;
    
    public function render()
    {
        return view('livewire.station.patient-medical-history');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
    }
}
