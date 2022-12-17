<?php

namespace App\Http\Livewire\Patient;

use App\Models\Allergy;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Medication;
use App\Models\Application;
use App\Models\MedicalProblem;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowPatient extends Component
{    
    public $patient_id;

    public $app;

    public function render()
    {
        $patient = Patient::with('medicalProblems', 'medications', 'prenatal', 'allergies')->findOrFail($this->patient_id);

        return view('livewire.patient.show-patient', compact('patient'));
    }

    public function mount($id)
    {
        $this->patient_id = $id;

        $this->app = Application::where('patient_id', $id)->latest()->first();
    }
}
