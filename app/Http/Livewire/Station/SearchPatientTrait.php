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
        $this->patientId = $id;
        $this->patient = Patient::find($id);

        try {
            $this->fillFilamentForm();
        } catch (\Throwable $th) {
            throw $th;
        }

        try {
            $this->fillForm();
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
}
