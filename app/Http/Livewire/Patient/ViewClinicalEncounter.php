<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;
use App\Models\ClinicEncounter;

class ViewClinicalEncounter extends Component
{
    public $encounter;
    public $patient;
    
    public function render()
    {
        return view('livewire.patient.view-clinical-encounter');
    }

    public function mount($id)
    {
        $this->encounter = ClinicEncounter::with('patient')->findOrFail($id);
        $this->patient = $this->encounter->patient;
    }
}
