<?php

namespace App\Http\Livewire\Station;

use Livewire\Component;
use App\Enums\OrderStatus;
use App\Models\MedicalCode;
use App\Models\ClinicEncounter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Livewire\Station\SearchPatientTrait;
use App\Models\Application;

class ClinicalEncounter extends Component
{
    use SearchPatientTrait;
    use LivewireAlert;

    protected $listeners = ['selectPatient', 'confirmEncounter' => 'save'];

    public $vital_sign, $medications;

    public $chief_complaint, $illness_history, $physical_exam, $impression;

    protected $rules =[
        'chief_complaint' => 'required',
        'illness_history' => 'required',
        'physical_exam' => 'required',
        'impression' => 'required',
    ];
    
    public function render()
    {
        if(!$this->vital_sign){
            if($this->patient){
                $this->vital_sign = $this->patient->vitalSigns()->latest()->first();
            }
        }
        

        return view('livewire.station.clinical-encounter');
    }

    public function mount($patientId = null)
    {
        if($patientId){
            $this->selectPatient($patientId);
        }
    }
    
    public function prompt()
    {
        $this->alert('question', 'Confirm Sign Encounter?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Sign Encounter',
            'onConfirmed' => 'confirmEncounter',
        ]);
    }

    public function save()
    {
        $data = $this->validate();

        $patient = $this->patient;

        $encounter = new ClinicEncounter;
        $encounter->patient_id = $this->patient_id;
        $encounter->vital_sign_id = $this->vital_sign->id;
        $encounter->user_id = auth()->id();
        $encounter->fill($data);
        $encounter->save();

        foreach($patient->medicalCodings as $medicalCoding)
        {
            $medicalCoding->update([
                    'clinic_encounter_id' => $encounter->id,
                ]);
        }

        foreach($patient->planMedications as $medication)
        {
            $medication->update([
                'clinic_encounter_id' => $encounter->id, 
                'order_number' => $medication->generateOrderNumber(),
                'order_status' => OrderStatus::PENDING
            ]);
        }

        foreach($patient->planLaboratories as $laboratory)
        {
            $laboratory->update(['clinic_encounter_id' => $encounter->id]);
        }

        $app = Application::wherePatientId($this->patient_id)->latest()->first();
        $app->clinic_encounter_finished_at = now();
        $app->clinic_encounter_user_id = auth()->id();
        $app->save();

        $this->alert('success', 'Sign Encounter completed successfully!');

        $this->reset();
    }
    
}
