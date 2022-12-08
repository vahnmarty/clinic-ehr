<?php

namespace App\Http\Livewire\Station;
use App\Models\Patient;

/**
 *  
 */
trait SearchPatientTrait
{
    public $patient_id, $patient;

    public function selectPatient($id)
    {
        $this->patient_id = $id;
        $this->patient = Patient::find($id);
        
        $this->fillFilamentForm();
    }
    

    public function getListeners()
    {
        return $this->listeners + [
            'selectPatient'
        ];
    }
}
