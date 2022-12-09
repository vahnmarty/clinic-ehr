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

        if(!empty($this->needsUuid)){
            return $this->redirectWithUuid();
        }

        try {
            $this->fillFilamentForm();
        } catch (\Throwable $th) {
        }

        try {
            $this->fillForm();
        } catch (\Throwable $th) {
        }
        
    }
}
