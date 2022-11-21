<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;

class ShowPatient extends Component
{
    protected $patient_id;

    public function render()
    {
        $patient = Patient::findOrFail($this->patient_id);
        return view('livewire.patient.show-patient', compact('patient'));
    }

    public function mount($id)
    {
        $this->patient_id = $id;
    }
    
}
